<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\User;
use App\Repositories\UserRepository;

class AuthController extends MyController
{
    public function index() {

        $users = User::orderBy('id', 'desc')->get();
        
        return response()->json($users);
    }

    public function show($id) {
        $user = User::find($id);
        return response()->json($user);
    }

    public function store(Request $request, UserRepository $repository) {
        
        $this->validateRequest($request, 0);

        $created = $repository->create($request->only([
            'name', 'email', 'password'
        ]));

        return response()->json($created);
    }

    public function update($id, Request $request, UserRepository $repository) {

        $this->validateRequest($request, 1);
        
        $updated = $repository->update($id, $request->only([
            'name', 'email', 'password'
        ]));

        return response()->json($updated);

    }

    public function destroy($id, UserRepository $repository) {

        $destroyed = $repository->delete($id);

        return response()->json($destroyed);
    }

}
