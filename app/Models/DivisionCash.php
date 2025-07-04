<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DivisionCash extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'administrator_id',
        'division_cash_access_id',
        'date',
        'work_program',
        'type',
        'source',
        'amount'
    ];

    protected $dates = ['deleted_at', 'date'];

    protected $casts = [
        'date' => 'date',
        'amount' => 'integer'
    ];

    /**
     * Get the administrator that owns the division cash
     */
    public function administrator(): BelongsTo
    {
        return $this->belongsTo(Administrator::class);
    }

    /**
     * Get the division cash access that owns the division cash
     */
    public function divisionCashAccess(): BelongsTo
    {
        return $this->belongsTo(DivisionCashAccess::class);
    }
}
