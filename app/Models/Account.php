<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'balance',
        'is_active',
        'company_id',
    ];

    /* при работе с временем в касты закинуть
     * 'created_at' => 'datetime',
     * 'update_at' => 'datetime',
     */

    protected $casts = [
        'balance' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
