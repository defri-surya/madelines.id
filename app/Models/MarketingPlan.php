<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingPlan extends Model
{
    use HasFactory;

    protected $table = 'marketing_plans';

    protected $guarded = ['id'];
}
