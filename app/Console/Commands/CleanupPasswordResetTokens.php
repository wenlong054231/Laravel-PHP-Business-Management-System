<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use DB;

class CleanupPasswordResetTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tokens:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove expired password reset tokens from the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        // Delete tokens that have expired (created_at + 60 minutes)
        DB::table('password_reset_tokens')
        ->where('created_at', '<', Carbon::now()->subMinutes(60))
        ->delete();

        $this->info('Expired password reset tokens have been removed.');
    }
}
