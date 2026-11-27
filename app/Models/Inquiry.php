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

    public const STATUS_CONTACTED = 'contacted';

    public const STATUS_CLOSED = 'closed';

    public const STATUSES = [
        self::STATUS_NEW => 'Baru',
        self::STATUS_CONTACTED => 'Sudah dihubungi',
        self::STATUS_CLOSED => 'Selesai',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Warna badge status di panel admin.
     */
    public static function statusColor(string $status): string
    {
        return match ($status) {
            self::STATUS_NEW => 'warning',
            self::STATUS_CONTACTED => 'info',
            self::STATUS_CLOSED => 'success',
            default => 'gray',
        };
    }
}
