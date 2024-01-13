<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateJWTSecretKey extends Command
{
    protected $signature = 'jwt:secret';

    protected $description = 'App JWT Secret Key Generator';

    public function handle(): void
    {
        $key = Str::random(32);
        $this->info('JWT Secret Key: ' . $key);

        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'JWT_SECRET=' . env('JWT_SECRET', ''),
                'JWT_SECRET=' . $key,
                file_get_contents($path)
            ));
        }

        $this->info("JWT Secret Key set successfully.");
    }
}
