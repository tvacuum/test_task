<?php

namespace App\Models;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timebreak extends Model
{
    use HasFactory;

    protected $table = 'timebreaks';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'day_id',
        'workplace_id',
        'time_leave',
        'time_comeback'
    ];
}
