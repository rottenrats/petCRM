<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     *  @var list<string>
    */

    protected $fillable = [
        'name',
        'inn',
        'type',
        'legal_address',
        'actual_address',
        'phone',
        'email',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}