<?php

/*
 * Proxy yang boleh mengirim header X-Forwarded-* (docs/AGENTS.md bagian 12).
 * Isi 127.0.0.1 saat memakai cloudflared di komputer yang sama, atau rentang
 * IP Cloudflare/"*" di produksi selama origin tidak bisa diakses langsung.
 */
return [
    'proxies' => env('TRUSTED_PROXIES'),
];
