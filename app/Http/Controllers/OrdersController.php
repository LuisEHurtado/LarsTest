<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrdersServices;

class OrdersController extends Controller
{
    protected $OrdersServices;

    public function __construct(OrdersServices $Service)
    {
        $this->OrdersServices = $Service;
    }

    public function Get(Request $request){
        return $this->OrdersServices->GetAll($request);
    }
    public function GetId(Request $request){
        return $this->OrdersServices->GetId($request);
    }
    
    public function Create(Request $request){
        return $this->OrdersServices->Create($request);
    }
    public function Update(Request $request){
        return $this->OrdersServices->Update($request);
    }

    public function Destroy(Request $request){
        return $this->OrdersServices->Destroy($request);
    }
    public function GetPDF(Request $request){
        return $this->OrdersServices->GetPDF($request);
    }
}
