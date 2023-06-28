<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'photo'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function scopePublished (Builder $query) {
        $query->where('is_published', true);
    }
}
