<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'phone',
        'email',
        'website',
        'address',
        'description',
        'logo',
        'favicon',
        'meta',
    ];
}
