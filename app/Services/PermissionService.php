<?php

namespace App\Services;

use App\Contracts\PermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PermissionService extends Service
{
    public function __construct(private PermissionRepository $repository)
    {
    }

    public function searchPage()
    {
        return $this->repository->paginate(\request('limit'));
    }

    public function createItem(Request $request)
    {
        $attributes = $request->except('password');

        $attributes['password'] = Hash::make($request->get('password'));

        return $this->repository->create($attributes);
    }

    public function searchItem($id)
    {
        return $this->repository->find($id);
    }

    public function updateItem(Request $request, $id)
    {
        $attributes = $request->except('password');

        $attributes['password'] = Hash::make($request->get('password'));

        return $this->repository->update($attributes, $id);
    }

    public function deleteItem($id)
    {
        return $this->repository->delete($id);
    }
}