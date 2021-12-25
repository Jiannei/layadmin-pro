<?php

namespace App\Services;

use App\Contracts\ActivityRepository;
use Illuminate\Support\Facades\Artisan;

class LogService extends Service
{
    private $repository;

    public function __construct(ActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function searchPage()
    {
        return $this->repository->with(['causer','subject'])->orderBy('created_at','desc')->paginate();
    }

    public function clean($name)
    {
        Artisan::call("activitylog:clean $name");
    }
}