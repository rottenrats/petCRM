<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';

    public const ROLES = [
        self::ROLE_ADMIN,
        self::ROLE_USER
    ];

    protected $fillable = [
        'company_id',
        'email',
        'role',
        'token',
        'expires_at',
        'used_at'
    ];

    public function setRoleAttribute($value)
    {
        if (!in_array($value, self::ROLES)) {
            throw new \InvalidArgumentException("Недопустимая роль: $value");
        }

        $this->attributes['role'] = $value;
    }

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
    ];

    /*
    public function company() {
        return $this->belongsTo(Company::class);
    }
    */

}
