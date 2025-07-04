<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Administrator extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'division_id'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the division that owns the administrator
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Get deposits for this administrator
     */
    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }

    /**
     * Get cashes for this administrator
     */
    public function cashes(): HasMany
    {
        return $this->hasMany(Cash::class);
    }

    /**
     * Get division cashes for this administrator
     */
    public function divisionCashes(): HasMany
    {
        return $this->hasMany(DivisionCash::class);
    }
}
