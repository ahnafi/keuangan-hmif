<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DivisionCashAccess extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'division_id'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the division that owns the division cash access
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Get division cashes for this division cash access
     */
    public function divisionCashes(): HasMany
    {
        return $this->hasMany(DivisionCash::class);
    }
}
