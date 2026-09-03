<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
class GenerateBilling extends Command {
    protected $signature = 'billing:generate';
    protected $description = 'Generate tagihan bulanan otomatis';
    public function handle(): int { $this->info('Billing Command: OK'); return 0; }
}
