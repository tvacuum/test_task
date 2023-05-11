<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryBook extends Model
{
    use HasFactory;

    protected $table = 'category_book';

    public $timestamps = false;

    public $fillable = [
        'category_id',
        'book_id'
    ];
}
