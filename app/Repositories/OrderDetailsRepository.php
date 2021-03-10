<?php
namespace App\Repositories;
use App\Models\OrderDetails;
use App\Repositories\BaseRepository;

class OrderDetailsRepository extends BaseRepository
{
    public function GetModel()
    {
        return new OrderDetails();
    }
}
