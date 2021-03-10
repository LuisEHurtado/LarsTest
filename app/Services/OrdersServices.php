<?php

namespace App\Services;
use App\Repositories\OrdersRepository;
use App\Models\Orders;
use App\Models\User;
use App\Models\OrderDetails;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

use DB;
use Auth;

class OrdersServices{
    protected $OrdersRepository;

    public function __construct(OrdersRepository $Repository)
    {
        $this->OrdersRepository = $Repository;
    }

    public function GetAll($request)
    {
        if(Auth::user()->is_admin === 1){
            $query= $this->OrdersRepository->GetModel()->with('user')->get();
        }else{
            $query= $this->OrdersRepository->GetModel()->with('user')->where('user_id',Auth::user()->id)->get();
        }
        return response()->json(["data"=>$query],200);
    } 
    public function GetId($request)
    {
        $query=$this->OrdersRepository->getModel()->with('user','details.products')
        ->where('id',$request->id)->first();
        return response()->json(["data"=>$query],200);
    } 
    

    public function Create($request)
    {
        try {
            DB::beginTransaction();
            $Order=$this->OrdersRepository->create($request->all());
            $user= User::where('id',$request->user_id)->first();
            $details= json_decode($request->orders);
            foreach($details as $key){
                OrderDetails::create([
                    'quantity'=>$key->quantity,
                    'sales_price'=>$key->sales_price,
                    'orders_id'=>$Order->id,
                    'products_id'=>$key->id,
                ]);
            }
            $this->SendMail($user);
            DB::commit();
            return response()->json(["message"=>"Registro procesado exitosamente"],200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["server_error"=>$e->getMessage(),
            "error_line"=>$e->getLine(),
            "error_message"=>"Ha ocurrido un error, por favor intente de nuevo."],500);
        }
    } //Store

    public function Update($request)
    {
        try {
            DB::beginTransaction();
            $Order=$this->OrdersRepository->getModel()->where('id',$request->id)->first();
            if(!$Order){
                return response()->json(["error_message"=>"No existe ningun registro con estos datos"],500);    
            }
            $this->OrdersRepository->update($Order, $request->all());
            DB::commit();
            return response()->json(["message"=>"Registro actualizado exitosamente"],200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["server_error"=>$e->getMessage(),
            "error_line"=>$e->getLine(),
            "error_message"=>"Ha ocurrido un error, por favor intente de nuevo."],500);
        }
    } //Update

    public function Destroy($request)
    {
        try {
            DB::beginTransaction();
            $Order=$this->OrdersRepository->getModel()->where('id',$request->id)->first();
            if(!$Order){
                return response()->json(["error_message"=>"No existe ningun registro con estos datos"],500);    
            }
            $this->OrdersRepository->destroy($Order);
            DB::commit();
            return response()->json(["message"=>"Registro eliminado exitosamente."],200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["server_error"=>$e->getMessage(),
            "error_line"=>$e->getLine(),
            "error_message"=>"Ha ocurrido un error, por favor intente de nuevo."],500);
        }
    } //Destroy

    public function GetPDF($request){
        try {
            $mytime = \Carbon\Carbon::now();
            ini_set("max_execution_time",0);
            $query=$this->OrdersRepository->getModel()->with('user','details.products')
            ->where('id',$request->order_id)->first();

                $view =  \View::make('orders.report.index', ['data'=>$query])->render();
                  $pdf = \App::make('dompdf.wrapper');
                  $pdf->loadHTML($view);
                  $pdf->setPaper('letter', 'landscape');
                  return $pdf->stream('Ordern'.'.pdf');
                  
        } catch (\Exception $e) {
          //return response()->json(["error"=>$e->getMessage()],500);
        }

    }
    public function SendMail($data)
    {
        Mail::to($data['email'])->send(new OrderMail($data));
    }
}
