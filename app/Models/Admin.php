<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'password',
        'email'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected function casts() : array {
        return [
            'email_verifiey_at' => 'datetime',
            'password' => 'hashed'

        ];
    }

}
