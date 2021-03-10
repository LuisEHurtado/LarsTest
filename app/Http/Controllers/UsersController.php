<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function Get(){
        return response()->json(["data"=>User::all()],200);
    }
}
