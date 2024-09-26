<?php

namespace App\Http\Interfaces;

interface PostInterface
{
    public function index();

    public function show($id);

    public function store($request);

    public function update($request, $id);

    public function delete($id);

    public function search($request);
}
