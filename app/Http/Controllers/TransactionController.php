<?php

namespace App\Http\Controllers;

use App\Services\RequestItemService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionService;
    protected $requestItemService;
    public function __construct(TransactionService $transactionService, RequestItemService $requestItemService)
    {
        $this->requestItemService = $requestItemService;
        $this->transactionService = $transactionService;
    }

    public function storeRequest(Request $request)
    {
        $data = $request->all();
        $result = $this->requestItemService->storeRequest($data);
    }
}
