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
    public function index()
    {
        $data = $this->itemService->getAllItems();

        return view("dashboard.barang", compact("data"));
    }
    public function store(Request $request)
    {
        $path = $this->imageService->storeImage($request->file('image'), 'items');
        $data = $request->all();
        $data["image"] = $path;
        $result = $this->itemService->store($data);
        if (!$result) {
            return back()->withErrors([
                'message' => 'Data gagal disimpan'
            ]);
        }
        return back()->withSuccess([
            'message' => 'Data berhasil disimpan'
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }
}
