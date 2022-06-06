<?php

declare(strict_types=1);

namespace App\ViewModels\Concerns\Transaction;

use App\Facades\Wallets;
use App\ViewModels\WalletViewModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait InteractsWithVotes
{
    public function count(): ?int
    {
        if (! $this->isLegacyBusinessUpdate()) {
            return null;
        }

        return count($this->transaction->asset["votes"]);
    }

    public function voted(): ?WalletViewModel
    {
        if (! $this->isVote() && ! $this->isLegacyBusinessUpdate()) {
            return null;
        }

        $votes = $this->transaction->asset["votes"];

        if (isset($votes[0])) {
            $publicKey = collect(Arr::get($this->transaction->asset ?? [], 'votes'))
                ->filter(fn ($vote) => Str::startsWith($vote, '+'))
                ->first();

            if (strlen($publicKey) === 67) {
                return new WalletViewModel(Wallets::findByPublicKey(substr($publicKey, 1)));
            }

            return new WalletViewModel(Wallets::findByUsername(substr($publicKey, 1)));
        }

        return new WalletViewModel(Wallets::findByUsername(array_key_first($votes)));
    }

    public function unvoted(): ?WalletViewModel
    {
        if (! $this->isUnvote()) {
            return null;
        }

        $publicKey = collect(Arr::get($this->transaction->asset ?? [], 'votes'))
            ->filter(fn ($vote) => Str::startsWith($vote, '-'))
            ->first();

        if (strlen($publicKey) === 67) {
            return new WalletViewModel(Wallets::findByPublicKey(substr($publicKey, 1)));
        }

        return new WalletViewModel(Wallets::findByUsername(substr($publicKey, 1)));
    }
}
