<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanupDemoAccounts extends Command
{
    protected $signature = 'demo:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove contas de demonstração criadas há mais de 45 minutos e todos os seus dados vinculados.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expirationTime = now()->subMinutes(45);
        
        $usersToDelete = \App\Models\User::where('email', 'like', 'demo_%@sandbox.aemek.com')
                                         ->where('created_at', '<', $expirationTime)
                                         ->get();
        
        $count = $usersToDelete->count();

        foreach ($usersToDelete as $user) {
            
            $user->delete();
        }

        $this->info("Limpeza concluída! {$count} contas de demonstração removidas.");
    }
}
