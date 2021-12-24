<?php

namespace App\Services;

use App\Contracts\MenuRepository;
use App\Validators\MenuValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuService extends Service
{
    /**
     * @var MenuRepository
     */
    private $repository;
    /**
     * @var MenuValidator
     */
    private $validator;

    public function __construct(MenuRepository $repository, MenuValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function search()
    {
        return $this->repository->searchTree();
    }

    public function searchPage()
    {
        return $this->repository->with('children')->paginate();
    }

    public function searchItem($id)
    {
        return $this->repository->find($id);
    }

    public function updateItem(Request $request, $id)
    {
        $menu = $this->repository->find($id);

        $attributes = $request->except('icon');
        if (!Str::startsWith($request['icon'], 'layui-icon ')) {
            $attributes['icon'] = Str::start($request['icon'], 'layui-icon ');
        } else {
            $attributes['icon'] = $request['icon'];
        }

        $attributes['updater_id'] = auth()->user()->id;

        if ($request['type'] == 0) {
            $attributes['p_id'] = 0;
        }

        $this->repository->update($attributes, $menu['id']);

        return true;
    }

    public function updateSort($id, $sort)
    {
        $this->repository->update(['sort' => $sort], $id);

        return true;
    }

    public function addItem(Request $request)
    {
        $attributes = $request->except(['icon']);

        if ($request['type'] == 0) {
            $attributes['icon'] = "layui-icon " . $request['icon'];
            $attributes['p_id'] = 0;
        }

        $userId = auth()->user()->id;

        $attributes['creator_id'] = $userId;
        $attributes['updater_id'] = $userId;

        $this->repository->create($attributes);

        return true;
    }

    public function removeItem($id)
    {
        return $this->repository->delete($id);
    }
}