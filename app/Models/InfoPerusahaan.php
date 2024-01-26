<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPerusahaan extends Model
{
    use HasFactory;

    protected $table = 'info_perusahaans';

    protected $guarded = ['id'];
}
