<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deposit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'administrator_id',
        'plenary_meeting',
        'jacket_day',
        'graduation_ceremony',
        'secretariat_maintenance',
        'work_program',
        'other'
    ];

    protected $dates = ['deleted_at'];

    protected $appends = ['total_amount'];

    // Define default relationships to always load
    protected $with = [];

    /**
     * Get the administrator that owns the deposit
     */
    public function administrator(): BelongsTo
    {
        return $this->belongsTo(Administrator::class);
    }

    /**
     * Get funds related to this deposit
     */
    public function funds(): BelongsToMany
    {
        return $this->belongsToMany(Fund::class, 'deposit_fund')
            ->withPivot('date', 'amount')
            ->withTimestamps();
    }

    /**
     * Get deposit penalties for this deposit
     */
    public function depositPenalties(): HasMany
    {
        return $this->hasMany(DepositPenalty::class);
    }

    /**
     * Get the total amount from pivot funds
     */
    public function getTotalAmountAttribute(): int
    {
        return $this->funds->sum('pivot.amount');
    }

    /**
     * Scope to load all necessary relationships
     */
    public function scopeWithFullData($query)
    {
        return $query->with([
            'administrator.division',
            'funds' => function ($query) {
                $query->withPivot('date', 'amount');
            }
        ])->withCount('funds');
    }

    /**
     * Scope to load deposit penalties with relationships
     */
    public function scopeWithPenalties($query)
    {
        return $query->with([
            'depositPenalties',
            'administrator.division'
        ]);
    }
}
