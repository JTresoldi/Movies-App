<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovieListItem extends Model
{
    protected $fillable = ['movie_list_id', 'movie_id'];

    public function list(): BelongsTo
    {
        return $this->belongsTo(MovieList::class);
    }
}
