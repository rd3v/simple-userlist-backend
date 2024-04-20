<?php 

namespace App\Repositories;

abstract class BaseRepository {

	abstract public function create(array $attributes);

	abstract public function update($id, array $attributes);

	abstract public function delete($id, array $attributes);

}