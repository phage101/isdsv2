<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Auth\User;

$id = $argv[1] ?? 3;
$user = User::find($id);
if ($user) {
    echo $user->id . ' => ' . $user->email . PHP_EOL;
} else {
    echo "User $id not found\n";
}
