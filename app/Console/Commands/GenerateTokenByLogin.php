<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\ProjectUser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GenerateTokenByLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-token {login} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates token for user {login} {password}';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $login = $this->argument('login');
        $password = $this->argument('password');
        $user = ProjectUser::whereLogin($login)->first();

        if ($user && Hash::check($password, $user->password)) {
            $tokenExpiresAt = Carbon::now()->addMinutes((int) config('tokens.lifetime'));
            $user->createToken('testtoken', [], $tokenExpiresAt);
            $this->info('Token successfully created for user - ' . $user->name);
        } else {
            $this->error('User not found or password wrong!');
        }
    }
}
