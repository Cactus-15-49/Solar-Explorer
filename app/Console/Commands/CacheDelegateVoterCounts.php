<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Wallet;
use App\Services\Cache\WalletCache;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

final class CacheDelegateVoterCounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'explorer:cache-delegate-voter-counts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache the voter count for each delegate.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $walletCache = new WalletCache();

        $results = Wallet::query()
            ->selectRaw('delegate, count(delegate) as total')
            ->crossJoin(DB::raw('lateral jsonb_each_text(attributes->\'votes\') json(delegate)'))
            ->groupBy('delegate')
            ->pluck('total', 'delegate');
        $results->each(fn ($total, $delegate) => $walletCache->setVoterCount($delegate, $total));
    }
}
