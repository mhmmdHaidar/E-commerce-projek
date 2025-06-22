<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'bank_name',
        'account_number',
        'account_name',
        'is_active',
    ];

    // Relasi ke transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
