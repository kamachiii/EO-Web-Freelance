<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Membuat akun admin dari ADMIN_EMAIL dan ADMIN_PASSWORD di .env.
     * Dilewati bila salah satu belum diisi.
     */
    public function run(): void
    {
        $email = config('admin.email');
        $password = config('admin.password');

        if (blank($email) || blank($password)) {
            $this->command?->warn('ADMIN_EMAIL dan ADMIN_PASSWORD belum diisi; akun admin dilewati.');

            return;
        }

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => config('admin.name'),
                'password' => $password,
                'is_admin' => true,
            ],
        );

        if (! $user->is_admin) {
            $user->forceFill(['is_admin' => true])->save();
        }

        $this->command?->info(
            $user->wasRecentlyCreated
                ? 'Akun admin dibuat: '.$email
                : 'Akun admin sudah ada: '.$email
        );
    }
}
