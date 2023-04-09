<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    const PERMISSIONS = [
        'category_create',
        'category_access',
        'category_show',
        'category_edit',
        'category_delete',

        'role_create',
        'role_access',
        'role_show',
        'role_edit',
        'role_delete',

        'label_create',
        'label_access',
        'label_show',
        'label_edit',
        'label_delete',

        'ticket_create',
        'ticket_access',
        'ticket_show',
        'ticket_edit',
        'ticket_delete',

        'permission_create',
        'permission_access',
        'permission_show',
        'permission_edit',
        'permission_delete',

        'role_create',
        'role_access',
        'role_show',
        'role_edit',
        'role_delete',
    ];

    protected $fillable = [
        'id', 'title'
    ];

    /**
     * The roles that belong to the Permission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'permission_roles', 'permission_id', 'role_id');
    }
}
