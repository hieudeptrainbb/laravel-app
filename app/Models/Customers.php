<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'customers';

    protected $fillable = [
        'name', 'username', 'phone_number', 'password',
    ];
}
