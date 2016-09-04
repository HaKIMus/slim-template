<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    protected $table = 'user';

    /**
     * @see If you want to add user, or something else, don't forget type
     * here your columns.
     */
    protected $fillable = [
        'email',
        'password',
        'etc',
    ];
}