<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'route', 'icon', 'order', 'roles', 'count', 'parent_id',
    ];

    // Sub-menu relationship
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menu_role', 'menu_id', 'role_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    // Parent menu
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // Check role
    public function hasAccess($user)
    {
        if (! $this->roles) {
            return true;
        }
        $roles = explode(',', $this->roles);

        return $user->hasAnyRole($roles);
    }
}
