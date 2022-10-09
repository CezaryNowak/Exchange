<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdatedCurrency extends Model
{
    use HasFactory;
    protected $table = 'updatedCurrency';
    protected $fillable = [
        'number',
        'tableAfe'
    ];


}
