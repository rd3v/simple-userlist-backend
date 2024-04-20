<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function upload($id, Request $request) {

        $user = User::find($id);
        $imageName = time().'.'.$request->profile_pic->extension();

        $path = public_path('img');
        if (!empty($user->profile_pic) && file_exists($path.'/'.$user->profile_pic)) {
            unlink($path.'/'.$user->profile_pic);
        }
        $user->profile_pic = $imageName;
        $user->save();

        $request->profile_pic->move(public_path('img'), $imageName);

        return response()->json(['status' => true, 'message' => 'Profile Pic Updated!']);
    }
}
