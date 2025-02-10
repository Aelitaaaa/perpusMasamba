<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users'; 

    protected $primaryKey = 'UserID'; 

    protected $fillable = [
        'namalengkap', 'Email', 'Password', 'role', 'Alamat'
    ];

    protected $hidden = [
        'Password'
    ];

    
    public function getAuthPassword()
    {
        return $this->Password;
    }
}
