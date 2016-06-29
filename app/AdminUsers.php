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

    /**
     * Update users
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    function updateKeyRand($condition = array(),$insertData = array()){
        if(is_array($condition) && count($condition) > 0)
            $this->db->where($condition);
        $this->db->update("users",$insertData);
    }
}
