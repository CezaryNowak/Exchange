<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watched extends Model {

    protected $table = 'watched';
    protected $fillable = [
        'user_id',
        'currency_id',
    ];

    use HasFactory;
}
