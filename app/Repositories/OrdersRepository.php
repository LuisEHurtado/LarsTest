<?php
namespace App\Repositories;
use App\Models\Orders;
use App\Repositories\BaseRepository;

class OrdersRepository extends BaseRepository
{
    public function GetModel()
    {
        return new Orders();
    }
}
