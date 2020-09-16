<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class income extends Model
{
    use HasFactory;

    protected $fillable = ['income_reason','income_amount','remaining_amount'];

}
