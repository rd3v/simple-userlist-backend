<?php

namespace App\Http\Controllers;

class MyController extends Controller {

    public function validateRequest($request, $mode = 0 /* 0 -> insert, 1 -> update*/) {

        if($mode === 0) {
            $name = 'required|max:255';
            $email = 'required|email|unique:users';
            $password = 'required';
        } else if($mode === 1) {
            $name = 'required|max:255';
            $email = 'required|email';
            $password = '';
        }

        $validated = $request->validate([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ],[
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email harus sesuai aturan',
            'email.unique' => 'Email sudah terpakai!',
            'password.required' => 'Password wajib diisi',
        ]);
    }
}