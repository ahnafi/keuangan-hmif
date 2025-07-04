<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepositPenalty extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'deposit_id',
        'date',
        'detail',
        'amount'
    ];

    protected $dates = ['deleted_at', 'date'];

    protected $casts = [
        'date' => 'date',
        'amount' => 'integer'
    ];

    /**
     * Get the deposit that owns the deposit penalty
     */
    public function deposit(): BelongsTo
    {
        return $this->belongsTo(Deposit::class);
    }
}
