<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountMoneyTypeController extends Controller
{
    public function getAll() {
        $accounts_money_type = DB::table("accounts_money_type")->get();
        return $accounts_money_type;
    }
}
