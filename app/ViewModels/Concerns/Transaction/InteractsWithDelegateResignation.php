<?php

declare(strict_types=1);

namespace App\ViewModels\Concerns\Transaction;

use Illuminate\Support\Arr;

trait InteractsWithDelegateResignation
{
    public function resignationType()
    {
        if (! $this->isDelegateResignation()) {
            return null;
        }

        return Arr::get($this->transaction, 'asset.resignationType');
    }
}
