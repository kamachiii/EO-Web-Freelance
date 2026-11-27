<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

#[Fillable([
    'name',
    'label',
    'period',
    'starts_at',
    'ends_at',
    'description',
    'hero_subheadline',
    'spotlight_title',
    'spotlight_description',
    'cta_label',
    'whatsapp_message',
    'featured_service_ids',
    'priority',
    'sort_order',
    'is_active',
])]
class SeasonalSegment extends Model
{
    /**
     * Segmen yang boleh ditampilkan ke pengunjung.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    /**
     * Satu musim yang sedang berjalan pada tanggal tertentu.
     * Prioritas terbesar menang, lalu tanggal mulai terbaru, lalu id terbaru.
     */
    public function scopeCurrent(Builder $query, ?CarbonInterface $date = null): Builder
    {
        $today = ($date ?? now())->toDateString();

        return $query
            ->where('is_active', true)
            ->where(function (Builder $query) use ($today): void {
                $query->whereNull('starts_at')
                    ->orWhereDate('starts_at', '<=', $today);
            })
            ->where(function (Builder $query) use ($today): void {
                $query->whereNull('ends_at')
                    ->orWhereDate('ends_at', '>=', $today);
            })
            ->orderByDesc('priority')
            ->orderByDesc('starts_at')
            ->orderByDesc('id');
    }

    /**
     * Segmen yang beririsan dengan rentang tanggal tertentu.
     */
    public function scopeOverlapping(Builder $query, CarbonInterface $start, CarbonInterface $end): Builder
    {
        return $query->where(function (Builder $query) use ($start, $end): void {
            $query->where(function (Builder $query) use ($start, $end): void {
                $query->whereNotNull('starts_at')
                    ->whereDate('starts_at', '<=', $end)
                    ->where(function (Builder $query) use ($start): void {
                        $query->whereNull('ends_at')
                            ->orWhereDate('ends_at', '>=', $start);
                    });
            })->orWhere(function (Builder $query) use ($start, $end): void {
                $query->whereNull('starts_at')
                    ->whereNotNull('ends_at')
                    ->whereDate('ends_at', '>=', $start)
                    ->whereDate('ends_at', '<=', $end);
            });
        });
    }

    /**
     * Status untuk badge admin.
     */
    public function status(): string
    {
        if (! $this->is_active) {
            return 'inactive';
        }

        $today = now()->toDateString();

        if ($this->starts_at && $this->starts_at->toDateString() > $today) {
            return 'scheduled';
        }

        if ($this->ends_at && $this->ends_at->toDateString() < $today) {
            return 'finished';
        }

        return 'active';
    }

    public function statusLabel(): string
    {
        return match ($this->status()) {
            'scheduled' => 'Terjadwal',
            'finished' => 'Selesai',
            'active' => 'Aktif',
            default => 'Nonaktif',
        };
    }

    public function statusColor(): string
    {
        return match ($this->status()) {
            'scheduled' => 'info',
            'finished' => 'gray',
            'active' => 'success',
            default => 'gray',
        };
    }

    /**
     * Label tanggal yang dipakai di tabel dan kalender.
     */
    public function dateRangeLabel(): ?string
    {
        if ($this->starts_at && $this->ends_at) {
            return $this->starts_at->translatedFormat('d M Y').' – '.$this->ends_at->translatedFormat('d M Y');
        }

        if ($this->starts_at) {
            return 'Mulai '.$this->starts_at->translatedFormat('d M Y');
        }

        if ($this->ends_at) {
            return 'Sampai '.$this->ends_at->translatedFormat('d M Y');
        }

        return null;
    }

    public function periodLabel(): string
    {
        return $this->dateRangeLabel() ?? $this->period ?? 'Tanpa tanggal';
    }

    /**
     * Judul band sorotan. Fallback ke label publik.
     */
    public function spotlightTitle(): string
    {
        return $this->spotlight_title ?: $this->label;
    }

    /**
     * Deskripsi band sorotan. Fallback ke deskripsi internal.
     */
    public function spotlightDescription(): ?string
    {
        return $this->spotlight_description ?: $this->description;
    }

    /**
     * Label tombol utama. Fallback ke teks bawaan situs.
     */
    public function ctaLabel(): string
    {
        return $this->cta_label ?: 'Konsultasi Gratis Sekarang';
    }

    /**
     * Program unggulan sesuai urutan ID di JSON. Hanya layanan aktif yang dipakai.
     *
     * @return Collection<int, Service>
     */
    public function featuredServices(): Collection
    {
        $ids = collect($this->featured_service_ids ?? [])
            ->map(fn (mixed $id): int => (int) $id)
            ->filter()
            ->unique()
            ->take(3)
            ->values();

        if ($ids->isEmpty()) {
            return collect();
        }

        $services = Service::active()
            ->whereIn('id', $ids)
            ->get()
            ->keyBy('id');

        return $ids
            ->map(fn (int $id): ?Service => $services->get($id))
            ->filter()
            ->values();
    }

    /**
     * Isi label periode otomatis dari tanggal supaya data lama tetap rapi.
     */
    protected static function booted(): void
    {
        static::saving(function (SeasonalSegment $segment): void {
            if (blank($segment->period)) {
                $segment->period = $segment->dateRangeLabel() ?? $segment->label ?? $segment->name;
            }
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'starts_at' => 'date',
            'ends_at' => 'date',
            'is_active' => 'boolean',
            'priority' => 'integer',
            'featured_service_ids' => 'array',
        ];
    }
}
