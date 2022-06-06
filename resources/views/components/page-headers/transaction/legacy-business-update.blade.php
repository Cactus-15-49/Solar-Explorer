@php ($voteCount = count($transaction->votes()))
<x-general.entity-header-item
    :title="trans('pages.transaction.transaction_type')"
    :icon="$voteCount > 0 ? 'app-transactions.vote' : 'app-transactions.unvote'"
    :wrapper-class="$wrapperClass ?? ''"
>
    <x-slot name="text">
        @if ($voteCount > 0)
            Vote
        @else
            Cancel Vote
        @endif
    </x-slot>
</x-general.entity-header-item>

<x-general.entity-header-item
    title="Voting For"
    icon="app-rank"
>
    <x-slot name="text">
        @if ($voteCount === 1)
            {{ $voteCount }} Delegate
        @else
            {{ $voteCount }} Delegates
        @endif
    </x-slot>
</x-general.entity-header-item>

<x-general.entity-header-item
    :title="trans('pages.transaction.fee')"
    icon="app-monitor"
>
    <x-slot name="text">
        <x-general.amount-fiat-tooltip
            :amount="$transaction->fee()"
            :fiat="$transaction->feeFiat()"
        />
    </x-slot>
</x-general.entity-header-item>

<x-general.entity-header-item
    :title="trans('pages.transaction.confirmations')"
    icon="app-confirmations"
>
    <x-slot name="text">
        <x-number>{{ $transaction->confirmations() }}</x-number>
    </x-slot>
</x-general.entity-header-item>
