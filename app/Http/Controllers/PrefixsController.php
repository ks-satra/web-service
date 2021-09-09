<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrefixsController extends Controller
{
    public function getAll() {
        $prefixs = DB::table("prefixs")->get();
        return $prefixs;
    }
}
