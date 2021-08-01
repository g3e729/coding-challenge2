<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_VIEW = 'can:view';
    const ROLE_CREATE = 'can:create';
    const ROLE_EDIT = 'can:edit';
    const ROLE_DELETE = 'can:delete';

    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public static function getRoles($method = null)
    {
        $roles = [
            'GET'   => self::ROLE_VIEW,
            'POST'  => self::ROLE_CREATE,
            'PATCH' => self::ROLE_EDIT,
            'DELETE' => self::ROLE_DELETE,
        ];

        if (is_null($method)) {
            return $roles;
        }

        return $roles[$method];
    }
}
