<?php
namespace App\Repositories;
use App\Models\Products;
use App\Repositories\BaseRepository;

class ProductsRepository extends BaseRepository
{
    public function GetModel()
    {
        return new Products();
    }
}
