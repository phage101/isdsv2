<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

$to = $argv[1] ?? 'dace.phage@gmail.com';
try {
    Mail::raw('Test mail from ISDS app at ' . date('Y-m-d H:i:s'), function ($m) use ($to) {
        $m->to($to)->subject('ISDS test mail');
    });
    echo "Mail send attempted to $to\n";
} catch (\Exception $e) {
    echo 'Mail failed: ' . $e->getMessage() . PHP_EOL;
}
