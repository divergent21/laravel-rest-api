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
        'title',
        'content',
        'photo',
        'is_published',
        'author_id'
    ];

    public function user () {
        return $this->belongsTo(User::class, 'id', 'author_id');
    }

    public function scopePublished (Builder $query) {
        $query->where('is_published', true);
    }
}
