<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AccountsController extends Controller
{
    public function getAll() {
        $accounts = DB::table("accounts")->get();
        return $accounts;
    }
    public function get($id) {
        $account = DB::table("accounts")
            ->where("accounts.id", "=", $id)
            ->get();
        if( $account->isEmpty() ) return null;
        return $account[0];
    }
    public function add(Request $request) {
        $request->validate(
            [
                'account_no'=>'required',
                'account_name'=>'required'
            ],
            [
                'account_no.required'=>'กรุณาป้อนเลขที่บัญชี',
                // 'account_no.unique'=>'มีเลขที่บัญชีนี้ในระบบฐานข้อมูลแล้ว',
                'account_name.required'=>'กรุณาป้อนชื่อบัญชี'
            ]
        );
        $data["account_no"] = $request["account_no"];
        $data["account_name"] = $request["account_name"];
        $data["created_at"] = Carbon::now();
        $data["updated_at"] = $request->updated_at;
        DB::table("accounts")->insert($data);
        return array(
            "status"=>"OK"
        );
    }
    public function del($id) {
        $account = DB::table("accounts")
            ->where("id", "=", $id)
            ->get();
        if( $account->isEmpty() ) {
            return array(
                "status"=>"NO",
                "message"=>"ไม่พบข้อมูล"
            );
        }
        DB::table("accounts")
            ->where("id", "=", $id)
            ->delete();
        return array(
            "status"=>"OK"
        );
    }
    public function edit(Request $request, $id) {
        $account = DB::table("accounts")
            ->where("id", "=", $id)
            ->get();
        if( $account->isEmpty() ) {
            return array(
                "status"=>"NO",
                "message"=>"ไม่พบข้อมูล"
            );
        }
        $request->validate(
            [
                'account_no'=>'required|unique:accounts',
                'account_name'=>'required'
            ],
            [
                'account_no.required'=>'กรุณาป้อนเลขที่บัญชี',
                'account_no.unique'=>'มีเลขที่บัญชีนี้ในระบบฐานข้อมูลแล้ว',
                'account_name.required'=>'กรุณาป้อนชื่อบัญชี'
            ]
        );
        $data["account_no"] = $request["account_no"];
        $data["account_name"] = $request["account_name"];
        $data["updated_at"] = Carbon::now();
        DB::table('accounts')
            ->where('id', "=", $id)
            ->update($data);
        return array(
            "status"=>"OK"
        );
    }
}
