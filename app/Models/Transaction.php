<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public const TYPE_INCOME = 'income';
    public const TYPE_EXPENSE = 'expense';
    
    public const TYPES = [
        self::TYPE_INCOME,
        self::TYPE_EXPENSE,
    ];

    protected $fillable = [
        'user_id',
        'company_id',
        'account_id',
        'budget_id',
        'amount',
        'currency',
        'type', // expense/income
        'date',
        'is_recurring'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'date',
        'is_recurring' => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }


    public function setTypeattribute($value)
    {
        if(!in_array($value, self::TYPES)) {
            throw new \InvalidArgumentException("Недопустимый тип транзакции: $value");
        }
        $this->attributes['type'] = $value;
    }

    public function getFormattedAmountAttribute()
    {
        $sign = $this->type === 'income' ? '+' : '-';
        return $sign . number_format($this->amount, 2) . ' ' . $this->currency;
    }
}
