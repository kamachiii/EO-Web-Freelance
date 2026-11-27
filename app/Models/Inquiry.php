<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Permintaan dari form Kontak. Hanya disimpan seperlunya dan tidak pernah
 * ditampilkan ke publik (docs/AGENTS.md bagian 11).
 */
#[Fillable(['name', 'whatsapp', 'email', 'service_id', 'message', 'status'])]
class Inquiry extends Model
{
    public const STATUS_NEW = 'new';

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
