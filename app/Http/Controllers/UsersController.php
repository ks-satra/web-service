<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function getAll() {
        $users = DB::table("users")
            ->select("users.*", "prefixs.prefix_name")
            ->join("prefixs", "users.prefix_id", "=", "prefixs.id")
            ->get();
        return $users;
    }
    public function get($id) {
        $user = DB::table("users")
            ->select("users.*", "prefixs.prefix_name")
            ->join("prefixs", "users.prefix_id", "=", "prefixs.id")
            ->where("users.id", "=", $id)
            ->get();
        if( $user->isEmpty() ) return null;
        return $user[0];
    }
    public function add(Request $request) {
        $request->validate(
            [
                'name'=>'required',
                'email'=>'required|unique:users'
            ],
            [
                'name.required'=>'กรุณาป้อนชื่อ',
                'email.required'=>'กรุณาป้อนอีเมล',
                'email.unique'=>'มีอีเมลนี้ในระบบฐานข้อมูลแล้ว'
            ]
        );
        $data["prefix_id"] = $request["prefix_id"];
        $data["name"] = $request["name"];
        $data["lname"] = $request["lname"];
        $data["email"] = $request["email"];
        $data["password"] = $request["password"];
        $data["created_at"] = Carbon::now();
        $data["updated_at"] = $request->updated_at;
        DB::table("users")->insert($data);
        return array(
            "status"=>"OK"
        );
    }
    public function del($id) {
        $user = DB::table("users")
            ->where("id", "=", $id)
            ->get();
        if( $user->isEmpty() ) {
            return array(
                "status"=>"NO",
                "message"=>"ไม่พบข้อมูล"
            );
        }
        DB::table("users")
            ->where("id", "=", $id)
            ->delete();
        return array(
            "status"=>"OK"
        );
    }
    public function edit(Request $request, $id) {
        $user = DB::table("users")
            ->where("id", "=", $id)
            ->get();
        if( $user->isEmpty() ) {
            return array(
                "status"=>"NO",
                "message"=>"ไม่พบข้อมูล"
            );
        }
        $request->validate(
            [
                'name'=>'required',
                'email'=>'required'
            ],
            [
                'name.required'=>'กรุณาป้อนชื่อ',
                'email.required'=>'กรุณาป้อนอีเมล',
            ]
        );
        $data["prefix_id"] = $request["prefix_id"];
        $data["name"] = $request["name"];
        $data["lname"] = $request["lname"];
        $data["email"] = $request["email"];
        $data["password"] = $request["password"];
        $data["updated_at"] = Carbon::now();
        DB::table('users')
            ->where('id', "=", $id)
            ->update($data);
        return array(
            "status"=>"OK"
        );
    }
}
