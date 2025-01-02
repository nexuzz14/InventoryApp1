<?php

namespace App\Services;

use App\Models\RequestItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\ItemService;
use App\Services\RequestItemService;

class TransactionService
{
    protected $itemService;
    protected $requestItemService;

  
    public function __construct(ItemService $ItemService, RequestItemService $requestItemService)
    {
        $this->requestItemService = $requestItemService;
        $this->itemService = $ItemService;
    }
    public function storeTransaction($data)
    {
        $buyPrice = 0;
        $totalQty = 0;

        $request_tabel = RequestItem::with('requestDetails.item.locations')->find($data['request_id']);
        $requestDetails = $request_tabel->requestDetails;
        foreach ($data['data'] as $itemsSelected) {

            $item = $requestDetails->find($itemsSelected['details_id']);
            if(!$item){
                return "id list barang pada permintaan tidak sah";
            }
            $item->quantity_accepted = $itemsSelected['quantity'];
            $item->save();
            if ($item && $item->quantity_accepted > 0) {

                if ($itemsSelected['location']) {
                    $sessionTotalBuy = 0;
                    foreach ($itemsSelected['location'] as $dataLocation) {
                        if ($dataLocation['quantity'] > 0) {
                            $gudang = $item->item->locations->find($dataLocation['location_id']);
                            if ($gudang) {
                                $newQuantity = max(0, $gudang->pivot->quantity - $dataLocation['quantity']);
                                $shortage = max(0, $dataLocation['quantity'] - $gudang->pivot->quantity);
                                $totalQty += $shortage;
                                $sessionTotalBuy += $shortage;
                                $buyPrice += ($shortage * $item->item->price);
                                $item->item->locations()->updateExistingPivot($dataLocation['location_id'], ['quantity' => $newQuantity]);
                            }
                        }
                    }
                    if ($sessionTotalBuy > 0 && $itemsSelected['suppliers']) {
                        foreach ($itemsSelected['suppliers'] as $supplier) {
                            $item->suppliers()->attach($supplier['supplier_id'], ['quantity' => $supplier['quantity']]);
                        }
                    }
                    $item->quantity_buy = $sessionTotalBuy;
                    $item->save();
                }
            }
        }

        $request_tabel->status = "selesai";
        $request_tabel->save();

        if ($totalQty > 0) {

            $totalApprovedItems = $requestDetails->count();
            $transaction = Transaction::create([
                'staff_id' => $request_tabel['staff_id'],
                'request_id' => $data['request_id'],
                'total_qty' => $totalQty,
                'total_price' => $buyPrice,
                'total_appoved_items' => $totalApprovedItems,
                'status' => 'unpaid',
            ]);
            return "Berhasil, pembelian ditambahkan";
        }

        return "berhasil, stok gudang telah dikurangi";

    }


    public function new($data)
    {
        DB::beginTransaction();
    
        try {
            $request = $this->requestItemService->storeRequest($data);
            $details = RequestItem::with('requestDetails.item')->find($request->id);
            $details->status = 'selesai';
            $details->save();
            Log::debug($details);
            $subTotal = 0;
            $totalQty = 0;
    
            foreach ($details->requestDetails as $detail) {
                $itemData = collect($data['items'])->firstWhere('item_id', $detail->item_id);
            
                if ($itemData) {
                    foreach ($itemData['suppliers'] as $supplier) {
                        $detail->suppliers()->attach($supplier['supplier_id'], ['quantity' => $supplier['quantity']]);
                    }
                    $detail->quantity_buy = $detail->quantity;
                    $subTotal += ($detail->quantity * $detail->item->price);
                    $totalQty += $detail->quantity;
                    $detail->save();
                } else {
                    Log::warning("Item ID {$detail->item_id} tidak ditemukan dalam data yang dikirim.");
                }
            }
            
    
            $totalApprovedItems = $details->count();
    
            $transaction = Transaction::create([
                'staff_id' => $request['staff_id'],
                'request_id' => $request->id,
                'total_qty' => $totalQty,
                'total_price' => $subTotal,
                'total_appoved_items' => $totalApprovedItems,
                'status' => 'unpaid',
            ]);
    
            DB::commit();
    
            return $transaction;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;

        }
    }
    
    public function getDetailTransaction($id)
    {
        $transaction = Transaction::with([
            'requestItem.client',
            'requestItem.requestDetails.item',
            'requestItem.requestDetails.suppliers'
        ])->find($id);
        if ($transaction) {
            $data = [
                'created_at' => $transaction->created_at,
                'total_price' => $transaction->total_price,
                'dibayarkan' => $transaction->dibayarkan,
                'status' => $transaction->status,
                'perminataan' => [
                    'code' => $transaction->requestItem->code ?? null,
                    'client_name' => $transaction->requestItem->client->name ?? null,
                    'list_barang' => $transaction->requestItem->requestDetails->map(function ($detail) {
                        return [
                            'quantity_buy' => $detail->quantity_buy,
                            'item_name' => $detail->item->name ?? null,
                            'item_code' => $detail->item->uniq_id ?? null,
                            'item_price' => $detail->item->price ?? null,
                            'suppliers' => $detail->suppliers->map(function ($supplier) {
                                return $supplier->name ?? null; // Ambil nama supplier
                            }),
                        ];
                    }),
                ],
            ];

            return $data;
        }
    }

    public function pay($id)
    {
        $transaction = Transaction::with('requestItem.requestDetails.item')->find($id);

        if ($transaction) {
            // Update dibayarkan menjadi total_price
            $transaction->dibayarkan = $transaction->total_price;
            Log::debug($transaction->requestItem);

            // Loop untuk memperbarui quantity item
            foreach ($transaction->requestItem->requestDetails as $req) {
                $req->item->quantity += $req->quantity_buy;
                $req->item->save();
            }

            $transaction->status = "paid";
            $transaction->save();
            return true;
        }

        return false;
    }



    public function getAllTransaction()
    {
        // Ambil data transaksi dengan relasi suppliers
        $transactions = Transaction::with('requestItem.client')->get();

        // Transformasi data
        Log::debug($transactions);
        $data = $transactions->map(function ($transaction) {
            return [
                'id' => $transaction->id,
                'created_at' => $transaction->created_at,
                'request_item_code' => $transaction->requestItem->code ?? null,
                'client_name' => $transaction->requestItem->client->name ?? null,
                'quantity' => $transaction->total_qty,
            ];
        });


        return $data;
    }

    public function delete($id)
    {
        $data = Transaction::find($id);
        if ($data) {
            $data->delete();
            return true;
        }
        return false;
    }



    // public function getAllTransaction()
    // {
    //     return Transaction::with([
    //         'requestItem' => function ($query) {
    //             $query->select("id", "nama_pemohon");
    //         },
    //         'staff' => function ($query) {
    //             $query->select("id", "name");
    //         },
    //         'requestItem.requestDetails' => function ($query) {
    //             $query->select("id", "item_id", 'request_id', 'quantity', 'status')->where('status', 'accepted');
    //         },
    //         'requestItem.requestDetails.item' => function ($query) {
    //             $query->select("id", "name", "unit_id", "price");
    //         },
    //         'requestItem.requestDetails.item.unit' => function ($query) {
    //             $query->select("id", "name");
    //         }
    //     ]);
    // }


    public function transactionPay($id, $nominal)
    {
        $data = Transaction::find($id);

        if ($data) {
            if (($data->dibayarkan + $nominal) > $data->total_price) {
                $data->dibayarkan = $data['total_price'];
            } else {
                $data->dibayarkan += $nominal;
            }
            $data->status = ($data->dibayarkan >= $data->total_price) ? 'paid' : 'bon';
            $data->save();
            return true;
        }
        return false;
    }


    public function detailOwnInvoice($id)
    {
        return Transaction::with([
            'requestItem' => function ($query) use ($id) {
                $query->select("id", "nama_pemohon");
            },
            'requestItem.requestDetails' => function ($query) {
                $query->select("id", "item_id", 'request_id', 'quantity', 'status')->where('status', 'accepted');
            },
            'requestItem.requestDetails.item' => function ($query) {
                $query->select("id", "name", "price");
            }
        ])->find($id);
    }

    public function listOwnInvoice($id)
    {
        return Transaction::with([
            'requestItem' => function ($query) use ($id) {
                $query->select("id", "nama_pemohon");
            }
        ])->where('staff_id', $id)->select('id', 'total_price', 'total_qty', 'status', 'created_at', 'request_id')->get();
    }
}
