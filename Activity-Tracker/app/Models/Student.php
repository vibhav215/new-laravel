<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public function getAll()
    {
        return [
            array(
                'std_id' => 1001,
                'name' => 'Awnish',
                'email' => 'Awnish@gmail.com',
                'password' => password_hash('1234', PASSWORD_BCRYPT),
                'mobile' => '+91-8299502081',
                'class' => 'MBA',
                'marks' => 100,
                'hasBack' => true,
            ),
        ];
    }
}