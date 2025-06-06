<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'image'];

    protected $dates = ['date'];

    public function comments()
    {
        return $this->hasMany('\App\Models\Comment');
    }
}
