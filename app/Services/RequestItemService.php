<?php

namespace App\Services;

use App\Models\ItemsRequestDetail;
use App\Models\RequestItem;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RequestItemService
{

    public function getAllRequest()
    {
        return DB::table('request_items')
            ->select(
                'request_items.id',
                'request_items.code as kode',
                'request_items.created_at as tanggal',
                'users.name as namaStaf',
                'clients.name as namaClient',
                'request_items.status as status'
            )
            ->join('users', 'request_items.staff_id', '=', 'users.id')
            ->join('clients', 'request_items.client_id', '=', 'clients.id')
            ->get();
    }
    public function getDetailRequest($id)
    {
        $requestItem = RequestItem::with([
            'requestDetails.item.category', // Relasi ke kategori item
            'requestDetails.item.unit', // Relasi ke unit item
            'client',
            'user'
        ])->find($id);
        if ($requestItem) {
            $data = [
                'id_permintaan' => $requestItem->id,
                'staff_id' => $requestItem->id,
                'client_id' => $requestItem->id,
                'status' => $requestItem->status,
                'total_diminta' => $requestItem->requestDetails->sum('quantity'),
                'total_real' => $requestItem->requestDetails->sum('quantity_accepted'),
                'updated_at' => $requestItem->updated_at->format("Y-m-d"),
                'barang' => $requestItem->requestDetails->map(function ($detail) {
                    return [
                        'id_list_permintaan' => $detail->id,
                        'id_barang' => $detail->item->id ?? null,
                        'nama_barang' => $detail->item->name ?? '',
                        'quantity_awal' => $detail->quantity,
                        'quantity_diterima' => $detail->quantity_accepted,
                        'uniq_id' => $detail->item->uniq_id ?? '',
                        'category' => $detail->item->category->name ?? '',
                        'unit' => $detail->item->unit->name ?? '',
                        'barang_tersedia' => $detail->item->quantity_gudang ?? '0.00',
                        'price' => $detail->item->price ?? '0.00',
                    ];
                }),
            ];

            return $data;
        }

        return "data tidak ditemukan";
    }
    public function updateRequestDetail($id, $data)
    {
        try {
            ItemsRequestDetail::find($id)->update($data);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getTopItems()
    {
        $topItems = DB::table('item_request_details')
            ->join('items', 'items.id', '=', 'item_request_details.item_id') // Join tabel items
            ->select('item_request_details.item_id', 'items.name', DB::raw('SUM(item_request_details.quantity) as total_quantity'))
            ->groupBy('item_request_details.item_id', 'items.name')
            ->orderBy('total_quantity', 'desc')
            ->get();

        return $topItems;
    }

    public function deleteRequest($id)
    {
        $data = RequestItem::find($id);
        if ($data) {
            $data->delete();
            return true;
        }
        return false;
    }

    public function storeRequest($data)
    {
        $staff_id = $data['staff_id'];
        $request_items = RequestItem::create([
            'staff_id' => $staff_id,
            'status' => 'pending',
            'client_id' => $data['client_id'],
        ]);

        $result = DB::table('items_request_details')->insert(
            array_map(
                function ($item) use ($request_items) {
                    return [
                        'request_id' => $request_items->id,
                        'item_id' => $item['item_id'],
                        'quantity' => $item['quantity'],
                        'quantity_accepted' => $item['quantity'],
                    ];
                },
                $data['items']
            )
        );

        return $result;
    }
}
