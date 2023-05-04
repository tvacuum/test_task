<?php

namespace App\Http\Controllers\Api;

use App\Models\DepartmentPosition;
use App\Http\Controllers\Controller;
use App\Http\Requests\Position\GetPositionsByDepIdRequest;
use Illuminate\Support\Collection;

class PositionApiController extends Controller
{
    /**
     * Method returns all Department's positions by department_id
     *
     * @param GetPositionsByDepIdRequest $request
     * @return Collection
     */
    public function __invoke(GetPositionsByDepIdRequest $request): Collection
    {
        return DepartmentPosition::select(['positions.id', 'positions.name'])
            ->where([
                'department_id' => $request->department_id
            ])
            ->join('positions', 'department_positions.position_id', '=', 'positions.id')
            ->get();
    }
}
