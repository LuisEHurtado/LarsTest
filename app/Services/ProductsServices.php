<?php

namespace App\Services;
use App\Repositories\ProductsRepository;
use App\Models\Products;
use Illuminate\Support\Str;
use DB;

class ProductsServices{
    protected $ProductsRepository;

    public function __construct(ProductsRepository $Repository)
    {
        $this->ProductsRepository = $Repository;
    }

    public function GetAll($request)
    {
        $data=[];
        $query=$this->ProductsRepository->GetModel()->query();
          if ($request->search_product !=null) {
            $query->where('code', 'like', '%' . $request->search_product . '%')
                ->orWhere('name', 'like', '%' . $request->search_product . '%')->get();
          }
          $query = $query->get();
          foreach($query as $key){
              $data[]=[
                'id'=>$key->id,
                'code'=>$key->code,
                'name'=>$key->name,
                'buy_price'=>$key->buy_price,
                'sales_price'=>$key->sales_price,
                'description'=>$key->description,
                'quantity'=>1,
              ];
          }
          
        return response()->json(["data"=>$data],200);
    } 
    public function GetId($request)
    {
        $query=$this->ProductsRepository->getModel()->where('id',$request->id)->first();
        return response()->json(["data"=>$query],200);
    } 
    

    public function Create($request)
    {
        try {
            DB::beginTransaction();
            $this->ProductsRepository->create($request->all());
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
            $Product=$this->ProductsRepository->getModel()->where('id',$request->id)->first();
            if(!$Product){
                return response()->json(["error_message"=>"No existe ningun registro con estos datos"],500);    
            }
            $this->ProductsRepository->update($Product, $request->all());
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
            $Product=$this->ProductsRepository->getModel()->where('id',$request->id)->first();
            if(!$Product){
                return response()->json(["error_message"=>"No existe ningun registro con estos datos"],500);    
            }
            $this->ProductsRepository->destroy($Product);
            DB::commit();
            return response()->json(["message"=>"Registro eliminado exitosamente."],200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["server_error"=>$e->getMessage(),
            "error_line"=>$e->getLine(),
            "error_message"=>"Ha ocurrido un error, por favor intente de nuevo."],500);
        }
    } //Destroy
    
}
