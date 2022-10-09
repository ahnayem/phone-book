<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class PhoneBook extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'phone',
        'email',
        'photo',
        'favourite',
        'user_id'
    ];
}
