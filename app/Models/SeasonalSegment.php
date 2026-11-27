<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'label', 'period', 'starts_at', 'ends_at', 'description', 'sort_order', 'is_active'])]
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

        if ($this->starts_at?->isFuture()) {
            return 'scheduled';
        }

        if ($this->ends_at?->isPast()) {
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
        ];
    }
}
