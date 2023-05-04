<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

class DepartmentApiController extends Controller
{
    /**
     * Returns all departments for registration
     *
     * @return Collection
     */
    public function __invoke(): Collection
    {
        return Department::all();
    }
}
