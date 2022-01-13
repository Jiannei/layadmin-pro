<?php

namespace App\Services;

use App\Contracts\ScheduleRepository;

class ScheduleService extends Service
{
    public function __construct(private ScheduleRepository $repository)
    {

    }

    public function searchPage()
    {
        return $this->repository->paginate(request('limit'));
    }

    public function searchItem($id)
    {
        return $this->repository->find($id);
    }

    public function addItem($request)
    {
        $attributes = $request->except('active', 'environments', 'on_one_server', 'in_background', 'in_maintenance_mode', 'output_append', 'output_email_on_failure');

        $active = $request->get('active') === 'on';
        $onOneServer = $request->get('on_one_server') === 'on';
        $inBackground = $request->get('in_background') === 'on';
        $inMaintenanceMode = $request->get('in_maintenance_mode') === 'on';
        $outputAppend = $request->get('output_append') === 'on';
        $outputEmailOnFailure = $request->get('output_email_on_failure') === 'on';
        $environments = explode(',', $request->get('environments', ''));

        return $this->repository->create(array_merge($attributes, [
            'active' => $active,
            'on_one_server' => $onOneServer,
            'in_background' => $inBackground,
            'in_maintenance_mode' => $inMaintenanceMode,
            'output_append' => $outputAppend,
            'output_email_on_failure' => $outputEmailOnFailure,
            'environments' => $environments,
        ]));
    }

    public function updateItem($request, $id)
    {
        $attributes = $request->except('active', 'environments', 'on_one_server', 'in_background', 'in_maintenance_mode', 'output_append', 'output_email_on_failure');

        $active = $request->get('active') === 'on';
        $onOneServer = $request->get('on_one_server') === 'on';
        $inBackground = $request->get('in_background') === 'on';
        $inMaintenanceMode = $request->get('in_maintenance_mode') === 'on';
        $outputAppend = $request->get('output_append') === 'on';
        $outputEmailOnFailure = $request->get('output_email_on_failure') === 'on';
        $environments = explode(',', $request->get('environments', ''));

        return $this->repository->update(array_merge($attributes, [
            'active' => $active,
            'on_one_server' => $onOneServer,
            'in_background' => $inBackground,
            'in_maintenance_mode' => $inMaintenanceMode,
            'output_append' => $outputAppend,
            'output_email_on_failure' => $outputEmailOnFailure,
            'environments' => $environments,
        ]), $id);
    }

    public function deleteItem($id)
    {
        return $this->repository->delete($id);
    }
}