<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cash extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'administrator_id',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the administrator that owns the cash
     */
    public function administrator(): BelongsTo
    {
        return $this->belongsTo(Administrator::class);
    }

    /**
     * Get funds related to this cash
     */
    public function funds(): BelongsToMany
    {
        return $this->belongsToMany(Fund::class, 'cash_fund')
            ->withPivot('date', 'month', 'penalty')
            ->withTimestamps();
    }
}
