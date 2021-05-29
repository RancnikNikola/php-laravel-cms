<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function permissions() {
        return $this->hasMany(Permission::class);
    }

    public function hasAccess(array $permissions) : bool {
        foreach($permissions as $permission) {
            if($this->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

    // was protected
    public function hasPermission(string $permission) {
        $permissions = json_decode($this->permissions, true);
        return $permissions[$permission] ?? false;
    }

    protected function hasPermissionRole($permission) {

        return (bool) $this->permissions->where('name', $permission->name)->count();
      }
}


