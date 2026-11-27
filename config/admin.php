<?php

/*
 * Akun admin panel (Fase 3). Isi lewat .env, jangan commit kredensial.
 * Dipakai oleh Database\Seeders\AdminUserSeeder.
 */
return [
    'name' => env('ADMIN_NAME', 'Admin MR Global'),
    'email' => env('ADMIN_EMAIL'),
    'password' => env('ADMIN_PASSWORD'),
];
