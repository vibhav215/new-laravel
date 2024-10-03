<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function getAll()
    {
        return [
            array(
                'post_id' => 1,
                'title' => 'What is HTML',
                'author' => 'Rahul Sir',
                'time' => '20-April-2024',
            ),
            array(
                'post_id' => 2,
                'title' => 'What is PHP',
                'author' => 'Awnish Master',
                'time' => '26-April-2024',
            ),
        ];
    }
}