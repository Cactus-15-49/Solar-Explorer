<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Scopes\OrderByBalanceScope;
use App\Models\Wallet;
use App\ViewModels\ViewModelFactory;
use ARKEcosystem\Foundation\UserInterface\Http\Livewire\Concerns\HasPagination;
use Illuminate\View\View;
use Livewire\Component;

final class WalletVoterTable extends Component
{
    use HasPagination;

    public string $publicKey;

    public string $username;

    /** @var mixed */
    protected $listeners = ['currencyChanged' => '$refresh'];

    public function mount(string $publicKey, string $username): void
    {
        $this->publicKey = $publicKey;
        $this->username  = $username;
    }

    public function render(): View
    {
$q = Wallet::whereNotNull('attributes->votes->' . $this->username);
        return view('livewire.wallet-voter-table', [
            'wallets' => ViewModelFactory::paginate($q->withScope(OrderByBalanceScope::class)->paginate()),
        ]);
    }
}
