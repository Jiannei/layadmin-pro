<?php

namespace App\Services;

use App\Contracts\RoleRepository;
use Illuminate\Http\Request;

class RoleService extends Service
{
    public function __construct(private RoleRepository $repository)
    {
    }

    public function searchPage()
    {
        return $this->repository->paginate(\request('limit'));
    }

    public function createItem(Request $request)
    {
        $attributes = $request->all();
        $attributes['builtin'] = false;

        return $this->repository->create($attributes);
    }

    public function searchItem($id)
    {
        return $this->repository->find($id);
    }

    public function updateItem(Request $request, $id)
    {
        $attributes = $request->all();
        $attributes['builtin'] = false;

        return $this->repository->update($attributes, $id);
    }

    public function deleteItem($id)
    {
        return $this->repository->delete($id);
    }
}