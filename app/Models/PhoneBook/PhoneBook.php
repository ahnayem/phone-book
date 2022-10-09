<?php

namespace App\Models\PhoneBook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class PhoneBook extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'photo',
        'favourite',
        'user_id'
    ];
}
