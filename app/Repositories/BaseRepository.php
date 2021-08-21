<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface BaseRepository
{
    public function all();

    public function find($id);

    public function findBy($column, $value);

    public function recent($limit);

    public function store(Request $request);

    public function update(Request $request, $id);
    
    public function destroy($id);
}
