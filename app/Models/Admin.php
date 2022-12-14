<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';
    public $timestamps = 'true';
    // every thing is fillable
    protected $guarded = [];

   /* protected $fillable = [
        'name',
        'email',
        'password',
        'created_at',
        'updated_at',
    ];*/

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function setPasswordAttribute($password){
        $this -> attributes['password'] = bcrypt($password);
    }

}
