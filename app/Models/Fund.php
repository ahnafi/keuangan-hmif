<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fund extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get transactions for this fund
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get cashes related to this fund
     */
    public function cashes(): BelongsToMany
    {
        return $this->belongsToMany(Cash::class, 'cash_fund')
            ->withPivot('date', 'month', 'penalty')
            ->withTimestamps();
    }

    /**
     * Get deposits related to this fund
     */
    public function deposits(): BelongsToMany
    {
        return $this->belongsToMany(Deposit::class, 'deposit_fund')
            ->withPivot('date', 'amount')
            ->withTimestamps();
    }
}
