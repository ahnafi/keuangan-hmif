<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get administrators for this division
     */
    public function administrators(): HasMany
    {
        return $this->hasMany(Administrator::class);
    }

    /**
     * Get division cash accesses for this division
     */
    public function divisionCashAccesses(): HasMany
    {
        return $this->hasMany(DivisionCashAccess::class);
    }
}
