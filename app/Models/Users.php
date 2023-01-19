<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Users extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'full_name', 'username', 'email', 'password'
    ];

    protected $hidden = [
        'password',
    ];

    public function create_user($new_user)
    {
        $user = new Users();
        $user->full_name = $new_user->full_name;
        $user->username = $new_user->username;
        $user->email = $new_user->email;
        $user->password = Hash::make($new_user->password);
        $user->save();
        return $user;
    }


    public function table_name()
    {
        return $this->table;
    }
}
