<?php 

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository {

	public function list() {

		$users = User::orderBy('id', 'desc')->get();

		return 'wew';
	}

	public function create(array $attributes) {

		DB::beginTransaction();

        try {

            $user = new User;
            $user->name = data_get($attributes, 'name', '');
            $user->email = data_get($attributes, 'email', '');
            $user->password = Hash::make(data_get($attributes, 'password', ''));
            
            if(!$user->save()) {
                return ['status' => false, 'message' => 'Terjadi kesalahan!'];
            }

            DB::commit();

            return ['status' => true, 'message' => 'User berhasil ditambahkan', 'data' => $user];

        } catch(\Throwable $e) {
            DB::rollBack();

            return ['status' => false, 'message' => $e->getMessage()];
        }
	}

	public function update($id, array $attributes) {

		$user = User::find($id);

        if($user === null) {
            return ['status' => false, 'message' => 'User tidak ditemukan!'];
        }

        DB::beginTransaction();
        try {

            $user = [
                'name' => data_get($attributes, 'name', ''),
                'email' => data_get($attributes, 'email', '')
            ];

            if(data_get($attributes, 'password', null)) {
                $user['password'] = Hash::make(data_get($attributes, 'password', ''));
            }

            User::where('id', $id)->update($user);

            DB::commit();
            return ['status' => true, 'message' => 'User berhasil diupdate!'];

        } catch(\Throwable $e) {
            DB::rollBack();            
            return ['status' => false, 'message' => $e->getMessage()];
        }
	}

	public function delete($id) {

        $user = User::find($id);

        if($user === null) {
            return ['status' => false, 'message' => 'User tidak ditemukan!'];
        }

        DB::beginTransaction();

        try {
            
            if (!$user->delete()) {
                return ['status' => false, 'message' => 'Gagal menghapus data'];
            }

            DB::commit();

            return ['status' => true, 'message' => 'User berhasil dihapus.'];

        } catch(\Throwable $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
	}

}