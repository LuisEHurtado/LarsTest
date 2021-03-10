<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logs;

class LogsController extends Controller
{
    public function Get(){
        return response()->json(["data"=>Logs::with('user')->get()],200);
    }
}
