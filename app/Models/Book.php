<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
        'author_id',
        'description',
        'rating',
        'cover'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, CategoryBook::class);
    }

    public function authors(): HasOne
    {
        return $this->HasOne(Author::class, 'id', 'author_id');
    }
}
