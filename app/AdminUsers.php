<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUsers extends Model {
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'username', 'email', 'name', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
