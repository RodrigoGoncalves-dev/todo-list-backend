<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    const UPDATED_AT = null;

    /**
     * @var string[]
     */
    protected $fillable = [
        'email', 'token'
    ];
}
