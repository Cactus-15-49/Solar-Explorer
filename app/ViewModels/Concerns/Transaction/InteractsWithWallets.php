<?php

declare(strict_types=1);

namespace App\ViewModels\Concerns\Transaction;

use App\DTO\MemoryWallet;

trait InteractsWithWallets
{
    public function sender(): ?MemoryWallet
    {
        return MemoryWallet::fromPublicKey($this->transaction->sender_public_key);
    }

    public function recipient(): ?MemoryWallet
    {
        if (is_null($this->transaction->recipient_id)) {
            if (is_null($this->transaction->asset) && is_null($this->transaction->asset['transfers'])) {
                return $this->sender();
            }
            return MemoryWallet::fromAddress($this->transaction->asset['transfers'][0]['recipientId']);
        }

        return MemoryWallet::fromAddress($this->transaction->recipient_id);
    }
}
