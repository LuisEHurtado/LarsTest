<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductsServices;

class ProductsController extends Controller
{
    protected $ProductsServices;

    public function __construct(ProductsServices $Service)
    {
        $this->ProductsServices = $Service;
    }

    public function Get(Request $request){
        return $this->ProductsServices->GetAll($request);
    }
    public function GetId(Request $request){
        return $this->ProductsServices->GetId($request);
    }
    
    public function Create(Request $request){
        return $this->ProductsServices->Create($request);
    }
    public function Update(Request $request){
        return $this->ProductsServices->Update($request);
    }

    public function Destroy(Request $request){
        return $this->ProductsServices->Destroy($request);
    }
}
