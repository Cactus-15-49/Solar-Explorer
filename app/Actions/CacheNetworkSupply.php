<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Wallet;
use App\Services\Cache\NetworkCache;

final class CacheNetworkSupply
{
    public static function execute(): string
    {
        return (new NetworkCache())->setSupply(function (): string {
            return Wallet::where('balance', '>', 0)->sum('balance');
        });
    }
}
