<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;
use Symfony\Component\HttpFoundation\Session\SessionBagProxy;

class SettingsController extends Controller
{




    public function showProfile()
    {
        return view('user_settings.profile');
    }

    // Check Entered Password
    public function isPasswordValid($enteredPassword, $id)
    {
        $userinfo = DB::select('SELECT * FROM user WHERE ID = ?', [$id])[0];
        $userPassword = $userinfo->Password;
        return $enteredPassword === $userPassword;
    }

    // Update session variables instead of having to log in again
    public function updateSessionData($s)
    {
        session()->regenerate();
        session(['userid' => $s->ID]);
        session(['user' =>  $s->Username]);
        session(['Name' =>  $s->FullName]);
        session(['pfp' =>  $s->Picture]);
        $type =  $s->Type == 'owner'  ? "Owner" : "Pharmacist";
        session(['user_type' =>  $type]);
        return redirect()->route('showProfile');
    }

    // Delete user's image
    public function deleteImg()
    {

        DB::update('UPDATE user set Picture = ? where ID = ?', [null, session('userid')]);
        $user = DB::select('SELECT * from user where ID = ?', [session('userid')])[0];
        $this->updateSessionData($user);
        return back()->with('msg', 'Image Deleted Succefully !');
    }

    // Update User profile 
    public function update($column, $value, $id)
    {
        DB::update("update user set $column =? where ID = ? ", [$value, $id]);

        $user = DB::select('SELECT * from user where ID = ? ', [$id])[0];
        return $this->updateSessionData($user);
    }

    // Handle Username Update
    public function updateUsername($id, $newUsernameVal, $password)
    {

        // Check if username is taken 
        $userExists = DB::select('SELECT * FROM user WHERE (Username = ? AND ID <> ? ) ', [$newUsernameVal, $id]);

        if ($userExists) {
            return back()->with('error', 'Username Already Exists')
                ->with("visibleSection", 'username');
        } else {
            if ($this->isPasswordValid($password, $id)) {
                return $this->update("Username", $newUsernameVal, $id);
            } else {
                return back()->with('error', 'Wrong Password !')
                    ->with("visibleSection", 'username');
            }
        }
    }


    public function handleImage($userId, $image)
    {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'bmp'];
        if ($image == null) {
            return 0;
        }
        $file_extension = $image->getClientOriginalExtension();

        // Check if File format is allowed or not
        if (in_array($file_extension, $allowedExtensions)) {
            $fileName = "$userId" . "_" . time() . '.' . $file_extension;


            $path = "imgs/AppData/staff/";
            // Check if path doesn't exist we create it
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }

            $files = glob($path . $userId . "_*"); // Search for the files that match our pattern
            if (!empty($files)) {
                foreach ($files as $file) {
                    unlink($file);     // Delete Any Existing images associated with this user
                }
            }

            // move the image to the destined path
            $image->move($path, $fileName);

            // Update the image path in Database
            DB::update('UPDATE user set Picture = ? where ID = ?', [$fileName, $userId]);
        } else {
            return back()->with('error', 'Supported Image Formats: JPG, JPEG, PNG, WebP, BMP ')
                ->with('visibleSection', 'personal')
                ->withInput();
        }
    }


    public function updatePersonal($id, $image, $newName, $pass)
    {
        $Matchs = $this->isPasswordValid($pass, $id);
        if ($Matchs) {
            $this->handleImage($id, $image);
            return $this->update("FullName", $newName, $id);
        } else {
            return back()->with('error', "Wrong Password")
                ->with("visibleSection", 'personal')
                ->withInput();
        }
    }


    public function handleProfileUpdate(Request $req)
    {

        $updateType = $req->type;
        $userId = session('userid');
        $pass     = $req->pass;

        if ($updateType == 'personal') {

            $image = $req->pfpimg;
            $Fullname = $req->fname;
            return $this->updatePersonal($userId, $image, $Fullname, $pass);
        } elseif ($updateType == 'username') {

            $username = $req->usern;
            return $this->updateUsername($userId, $username, $pass);
        } else {
            $newPass = $req->newPass;
            $confirmPass = $req->confirmNewPass;

            if ($newPass !== $confirmPass) {
                return back()->with('error', 'Passwords Don\'t Match')
                    ->with("visibleSection", 'password');
            }

            $Matchs = $this->isPasswordValid($pass, $userId);
            if ($Matchs) {
                return $this->update("Password", $newPass, $userId);
            } else {
                return back()->with('error', "Wrong Password");
            }
        }
    }
}
