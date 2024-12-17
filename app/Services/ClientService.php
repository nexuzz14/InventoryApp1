<?php

namespace App\Services;

use App\Models\client;
use Illuminate\Support\Facades\Crypt;

class ClientService
{
    public function getAllClient()
    {
        return Client::all();
    }

    public function getTotalClient(): int
    {
        return Client::count();
    }

    public function store(array $data)
    {
        return Client::create($data);
    }

    public function getClient($id)
    {
        return Client::find($id);
    }

    public function update($id, $data)
    {
        $Client = Client::find($id);
        $Client->update($data);
        return $Client;
    }

    public function delete($id)
    {
        return Client::find($id)->delete();
    }
}
