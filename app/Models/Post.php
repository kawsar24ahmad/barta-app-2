<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'slug',
        'author_id'
    ];


    public function author() {
        return $this->belongsTo(User::class);
    }

}
