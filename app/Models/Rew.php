<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rew extends Model
{
    use HasFactory;

    protected $table = 'rews';

    protected $fillable = [
        'score',
        'user_id',
        'text',
        'item'
    ];
}
