<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    use HasFactory;

    // Specify the table if different from the default (pluralized model name)
    protected $table = 'users';

    // Specify the fillable fields to allow mass assignment
    protected $fillable = [
        'name',
        'email',
        'password', // If you're managing passwords
        // Add other fields as necessary
    ];

    // Optionally define any relationships
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }
}
