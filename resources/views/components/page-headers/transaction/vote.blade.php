<x-general.entity-header-item
    :title="trans('pages.transaction.transaction_type')"
    icon="app-transactions.vote"
    :wrapper-class="$wrapperClass ?? ''"
>
    <x-slot name="text">
        Vote
    </x-slot>
</x-general.entity-header-item>

<x-general.entity-header-item
    title="Voting For"
    icon="app-rank"
>
    <x-slot name="text">
        1 Delegate
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
