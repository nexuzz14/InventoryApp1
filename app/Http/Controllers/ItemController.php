<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Models\Item;
use App\Services\ImageService;
use App\Services\ItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
class ItemController extends Controller
{
    protected $itemService;
    protected $imageService;

    public function __construct(ItemService $itemService, ImageService $imageService)
    {
        $this->itemService = $itemService;
        $this->imageService = $imageService;
    }
    // public function barangIndex()
    // {
    //     $data = $this->itemService->getAllItems();
    //     $manualItems = $data['manualItems'];
    //     return view('dashboard.barang', compact('manualItems'));
    // }


    // public function pembelianIndex()
    // {
    //     $data = $this->itemService->getAllItems();
    //     $purchasingItems = $data['purchasingItems']; // Ambil data purchasing dari hasil metode
    //     return view('dashboard.pembelian', compact('purchasingItems'));
    // }



    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                "name" => "required|string|max:255",
                "category_id" => "required|integer|exists:categories,id",
                "unit_id" => "required|integer|exists:units,id",
                "quantity" => "required|integer|min:1",
                "description" => "nullable|string|max:500",
                "price" => "required|numeric|min:0",
                "uniq_id" => "required|string|unique:items,uniq_id", // Validasi uniq_id
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();

            if (isset($errors['uniq_id'])) {
                return response()->json([
                    'message' => 'ID unik sudah digunakan. Silakan gunakan ID lain.',
                    'errors' => $errors['uniq_id']
                ], 422);
            }

            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $errors
            ], 422);
        }

        $result = $this->itemService->store($data);

        if (!$result) {
            return response()->json([
                "message"=>"barang gagal ditambahkan"
            ],422);
        }
        return response()->json([
            "message"=>"barang berhasil ditambahkan"
        ],201);
    }
    public function getLocalData(Request $request){
        $id=$request->id;
        $result = $this->itemService->getLocalData($id);
        if($result){
            return response()->json(
                $result
            ,200);
        }
        return null;
    }
    public function update(Request $request){
        $data = $request->all();
        try {
            $data = $request->validate([
                "id" => "integer|required",
                "name" => "required|string|max:255",
                "category_id" => "required|integer|exists:categories,id",
                "unit_id" => "required|integer|exists:units,id",
                "quantity" => "required|integer|min:1",
                "description" => "nullable|string|max:500",
                "price" => "required|numeric|min:0",
                "uniq_id" => "required|string|unique:items,uniq_id," . $request->id,
                "locations" => "array"
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();

            if (isset($errors['uniq_id'])) {
                return response()->json([
                    'message' => 'ID unik sudah digunakan. Silakan gunakan ID lain.',
                    'errors' => $errors['uniq_id']
                ], 422);
            }

            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $errors
            ], 422);
        }

        if($data['locations']){
            $totalQtyGudang = collect($data['locations'])->sum("quantity");
            if($totalQtyGudang > $request['quantity']){
                return response()->json([
                    "message"=>"Total barang di gudang melebihi quantity barang"
                ], 500);
            }
        }
        $result =  $this->itemService->update($data);
        if($result){
            return response()->json([
                "message"=>"berhasil mengubah data barang"
            ], 200);
        }

        return response()->json([
            "message"=>"gagal mengubah data, data tidak ditemukan"
        ],500);
    }
    public function updateLocation(Request $request){
        $id = $request->id;
        $data = $request->locations;
        $result =  $this->itemService->updateLocation($id, $data);
        if($result){
            return response()->json([
               "message"=>$result
            ], 200);
        }

        return response()->json([
            "message"=>"Gagal Menambahkan"
        ], 422);
    }
    public function destroy($id)
    {
        $result = $this->itemService->delete($id);
        if (!$result) {
            return response()->json([
                'message' => 'Data gagal dihapus'
            ], 500);
        }
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
    // public function update(Request $request)
    // {
    //     if ($request->hasFile('image') || $request->image != null) {
    //         $path = $this->imageService->storeImage($request->file('image'), 'items');
    //         $data = $request->all();
    //         $data["image"] = $path;
    //         $result = $this->itemService->updateItem($request->id, $data);
    //     } else {
    //         $data = $request->except('image');
    //         $result = $this->itemService->updateItem($request->id, $data);
    //     }
    //     if (!$result) {
    //         return back()->withErrors([
    //             'message' => 'Data gagal diperbarui'
    //         ]);
    //     }
    //     return back()->withSuccess([
    //         'message' => 'Data berhasil diperbarui'
    //     ]);
    // }

    public function getAllData(){
        $result=$this->itemService->getAllData();
        return response()->json([
            "status"=>"success",
            "data"=>$result
        ],200);
    }
    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Item $item)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Item $item)
    // {
    //     //
    // }
}
