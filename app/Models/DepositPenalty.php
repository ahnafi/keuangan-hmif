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
     * Get human-readable penalty detail description
     */
    public function getDetailDescriptionAttribute(): string
    {
        $descriptions = [
            'plenary_meeting' => 'Tidak mengikuti rapat pleno / Terlambat mengikuti rapat pleno',
            'jacket_day' => 'Tidak menggunakan jahim ketika jahim day',
            'graduation_ceremony' => 'Tidak mengikuti wisuda offline',
            'secretariat_maintenance' => 'Tidak mengikuti piket pesek',
            'work_program' => 'Tidak bertanggung jawab dalam menjalankan proker',
            'other' => 'Lainnya'
        ];

        return $descriptions[$this->detail] ?? $this->detail;
    }

    /**
     * Get the deposit that owns the deposit penalty
     */
    public function deposit(): BelongsTo
    {
        return $this->belongsTo(Deposit::class);
    }
}
