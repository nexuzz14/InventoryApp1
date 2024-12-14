<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Models\Item;
use App\Services\ImageService;
use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $itemService;
    protected $imageService;
    
    public function __construct(ItemService $itemService, ImageService $imageService)
    {
        $this->itemService = $itemService;
        $this->imageService = $imageService;
    }
    public function barangIndex()
    {
        $data = $this->itemService->getAllItems();
        $manualItems = $data['manualItems'];
        return view('dashboard.barang', compact('manualItems'));
    }


    public function pembelianIndex()
    {
        $data = $this->itemService->getAllItems();
        $purchasingItems = $data['purchasingItems']; // Ambil data purchasing dari hasil metode
        return view('dashboard.pembelian', compact('purchasingItems'));
    }



    public function store(Request $request)
    {
        $data = $request->all();
        $result = $this->itemService->store($data);
        if (!$result) {
            return response()->json([
                "message"=>"barang gagal ditambahkan"
            ]);
        }
        return response()->json([
            "message"=>"barang berhasil ditambahkan"
        ]);
    }
    public function destroy($id)
    {
        $result = $this->itemService->deleteItem($id);
        if (!$result) {
            return back()->withErrors([
                'message' => 'Data gagal dihapus'
            ]);
        }
        return back()->withSuccess([
            'message' => 'Data berhasil dihapus'
        ]);
    }
    public function update(Request $request)
    {
        if ($request->hasFile('image') || $request->image != null) {
            $path = $this->imageService->storeImage($request->file('image'), 'items');
            $data = $request->all();
            $data["image"] = $path;
            $result = $this->itemService->updateItem($request->id, $data);
        } else {
            $data = $request->except('image');
            $result = $this->itemService->updateItem($request->id, $data);
        }
        if (!$result) {
            return back()->withErrors([
                'message' => 'Data gagal diperbarui'
            ]);
        }
        return back()->withSuccess([
            'message' => 'Data berhasil diperbarui'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }
}
