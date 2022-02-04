<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table= 'users';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'mobile',
        'gender',
        'password',
        'date_of_birth',
        'user_zipcode',
        'company_name',
        'address',
        'company_zipcode',
        'website',
        'category_id',
        'skill_id',
        'user_info'

    ];
}
