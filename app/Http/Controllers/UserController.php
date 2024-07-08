<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class UserController extends Controller
{
    public function login(Request $req)
    {
        $s = DB::select('select * from user where Username = ? and Password = ?', [$req->usern, $req->pass]);
        if ($s) {
            $s = $s[0];
            session()->regenerate();
            session(['userid' => $s->ID]);
            session(['user' =>  $s->Username]);
            session(['Name' =>  $s->FullName]);
            session(['pfp' =>  $s->Picture]);
            

            $type =  $s->Type == 'owner'  ? "Owner" : "Pharmacist";
            session(['user_type' =>  $type]);
            return redirect()->route('home');
        } else {
            return redirect()->route('slogin_param', ['param' => $req->usern]);
        }
    }

    public function showAllStaff()
    {
        $owners = DB::select('SELECT * from user where Type = "owner" ');
        $pharmacists = DB::select('SELECT * from user where Type = "pharmacist"');
        return view('user_settings.staff', ['owners' => $owners, 'pharmacists' => $pharmacists]);
    }


    public function handleRegister(Request $req)
    {
        $password = $req->password;
        $cpassword = $req->cpassword;
        $name = $req->name;
        $username = $req->username;

        if ($password !== $cpassword) {
            return back()->with('msg', 'Passwords don\'t match');
        }

        if (strlen($password) < 8) {
            return back()->with('msg', "Please make sure your password is more than 8 charaters long");
        }

        $isdupliacte = DB::select('SELECT * from user where Username = ?', [$username]);

        if ($isdupliacte) {
            return back()->with('msg', 'Please choose a unique Username');
        }

        DB::insert('INSERT into user (Username ,Password ,Fullname ,Type) values(?,?,?,?)', [$username, $password, $name, "pharmacist"]);

        return to_route('showAllStaff');
    }

    public function staffSearch(Request $req)
    {
        $choice = $req->choice;
        $name = $req->pharmacistName;
        if ($choice == 'username') {
            $pharmacists = DB::select("SELECT * from user where Username = ? ", [$name]);
        } else {
            $pharmacists = DB::select("SELECT * from user where FullName like ? and Type ='pharmacist' ", ["%$name%"]);
        }
        return back()->with('searchresult', 1)->with('pharmacists', $pharmacists);
    }


    public function staffDelete(Request $req)
    {
        $pharmID = $req->id;
        DB::delete("DELETE from user where ID = ?", [$pharmID]);
        return back();
    }
}
