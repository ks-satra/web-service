<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AccountsMoneyController extends Controller
{
    public function getAll() {
        $accounts_money = DB::table("accounts_money")->get();
        return $accounts_money;
        // dd("ddd");
    }
    public function get($id) {
        $accounts_money = DB::table("accounts_money")
            ->where("accounts_money.id", "=", $id)
            ->get();
        if( $accounts_money->isEmpty() ) return null;
        return $accounts_money[0];
    }
    public function add(Request $request) {
        $request->validate(
            [
                'account_money_no'=>'required',
                'account_money_type_id'=>'required',
                'account_id'=>'required',
                'account_money_name'=>'required'
            ],
            [
                'account_money_no.required'=>'กรุณาป้อนรหัสอ้างอิง',
                'account_money_type_id.required'=>'กรุณาป้อนช่องทาง',
                'account_id.required'=>'กรุณาป้อนบัญชีกระเป๋าเงินอิเล็กทรีอนิกส',
                'account_money_name.required'=>'กรุณาป้อนจำนวนเงิน'
            ]
        );
        $data["account_money_no"] = $request["account_money_no"];
        $data["account_money_type_id"] = $request["account_money_type_id"];
        $data["account_id"] = $request["account_id"];
        $data["account_money_name"] = $request["account_money_name"];
        $data["created_at"] = Carbon::now();
        $data["updated_at"] = $request->updated_at;
        DB::table("accounts_money")->insert($data);
        return array(
            "status"=>"OK"
        );
    }
    public function del($id) {
        $accounts_money = DB::table("accounts_money")
            ->where("id", "=", $id)
            ->get();
        if( $accounts_money->isEmpty() ) {
            return array(
                "status"=>"NO",
                "message"=>"ไม่พบข้อมูล"
            );
        }
        DB::table("accounts_money")
            ->where("id", "=", $id)
            ->delete();
        return array(
            "status"=>"OK"
        );
    }
    public function edit(Request $request, $id) {
        $accounts_money = DB::table("accounts_money")
            ->where("id", "=", $id)
            ->get();
        if( $accounts_money->isEmpty() ) {
            return array(
                "status"=>"NO",
                "message"=>"ไม่พบข้อมูล"
            );
        }
        $request->validate(
            [
                'account_money_no'=>'required',
                'account_money_type_id'=>'required',
                'account_id'=>'required',
                'account_money_name'=>'required'
            ],
            [
                'account_money_no.required'=>'กรุณาป้อนรหัสอ้างอิง',
                'account_money_type_id.required'=>'กรุณาป้อนช่องทาง',
                'account_id.required'=>'กรุณาป้อนบัญชีกระเป๋าเงินอิเล็กทรีอนิกส',
                'account_money_name.required'=>'กรุณาป้อนจำนวนเงิน'
            ]
        );
        $data["account_money_no"] = $request["account_money_no"];
        $data["account_money_type_id"] = $request["account_money_type_id"];
        $data["account_id"] = $request["account_id"];
        $data["account_money_name"] = $request["account_money_name"];
        $data["updated_at"] = Carbon::now();
        DB::table('accounts_money')
            ->where('id', "=", $id)
            ->update($data);
        return array(
            "status"=>"OK"
        );
    }
}
