<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public static function booted() {
        static::created(function($user) {
            $userTenant = Tenant::create(['id' => $user->domain]);
            $userTenant->domains()->create(['domain' => $user->domain . '.' . env('APP_CENTRAL_DOMAIN')]);
        });
    }
}
