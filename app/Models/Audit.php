<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Models\Audit as AuditingModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Audit extends AuditingModel
{
    use HasFactory;

    protected $table = 'audits';

    protected $fillable = [
        'user_id',
        'event',
        'auditable_type',
        'auditable_id',
        'old_values',
        'new_values',
        'url',
        'ip_address',
        'user_agent',
        'tags',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
