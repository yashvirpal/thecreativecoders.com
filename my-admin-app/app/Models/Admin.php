<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'permissions',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'permissions' => 'array',
    ];

    // Check role
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    // Check single permission
    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions ?? []);
    }

    // Check multiple permissions
    public function hasAnyPermission(array $permissions): bool
    {
        return !empty(array_intersect($permissions, $this->permissions ?? []));
    }
}

