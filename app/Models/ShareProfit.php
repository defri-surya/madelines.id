<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareProfit extends Model
{
    use HasFactory;

    protected $table = 'share_profits';

    protected $guarded = ['id'];
}
