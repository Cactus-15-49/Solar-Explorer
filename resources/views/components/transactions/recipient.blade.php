@php($iconType = $transaction->iconType())

<div>
    <div>
        @if ($transaction->isTransfer() || $transaction->isUnknown())
            <x-general.identity :model="$transaction->recipient()" />
        @elseif ($transaction->isVoteCombination())
            <x-general.identity :model="$transaction->voted()">
                <x-slot name="icon">
                    <x-transactions.icon icon-type="vote" />
                </x-slot>

                <x-slot name="prefix">
                    <span class="pr-2 mr-2 font-semibold border-r text-theme-secondary-900 border-theme-secondary-300 dark:text-theme-secondary-200 dark:border-theme-secondary-800">
                        Vote
                    </span>
                </x-slot>
            </x-general.identity>
        @elseif ($transaction->isLegacyBusinessUpdate())
            @php($count = $transaction->count())
            @if ($count === 1)
                <x-general.identity :model="$transaction->voted()">
                    <x-slot name="icon">
                        <x-transactions.icon icon-type="vote" />
                    </x-slot>
                    <x-slot name="prefix">
                        <span class="pr-2 mr-2 font-semibold border-r text-theme-secondary-900 border-theme-secondary-300 dark:text-theme-secondary-200 dark:border-theme-secondary-800">
                            Vote
                        </span>
                    </x-slot>
                </x-general.identity>
            @else
                <div class="flex flex-row-reverse items-center md:flex-row">
                    @if ($count === 0)
                        <x-transactions.icon icon-type="unvote" />
                    @else
                        <x-transactions.icon icon-type="vote" />
                    @endif
                    <div class="mr-4 font-semibold md:mr-0 md:ml-4 text-theme-secondary-900 dark:text-theme-secondary-200">
                        @if ($count === 0)
                            Cancel Vote
                        @else
                            <span class="pr-2 mr-2 font-semibold border-r text-theme-secondary-900 border-theme-secondary-300 dark:text-theme-secondary-200 dark:border-theme-secondary-800">Vote</span><span class="text-theme-secondary-600">{{ $count }} Delegates</span>
                        @endif
                    </div>
                </div>
            @endif
        @elseif ($transaction->isVote())
            <x-general.identity :model="$transaction->voted()">
                <x-slot name="icon">
                    <x-transactions.icon icon-type="vote" />
                </x-slot>

                <x-slot name="prefix">
                    <span class="pr-2 mr-2 font-semibold border-r text-theme-secondary-900 border-theme-secondary-300 dark:text-theme-secondary-200 dark:border-theme-secondary-800">
                        Vote
                    </span>
                </x-slot>
            </x-general.identity>
        @elseif ($transaction->isUnvote())
                <div class="flex flex-row-reverse items-center md:flex-row">
                    <x-transactions.icon icon-type="unvote" />
                    <div class="mr-4 font-semibold md:mr-0 md:ml-4 text-theme-secondary-900 dark:text-theme-secondary-200">
                        Cancel Vote
                    </div>
                </div>
        @else
            <div class="flex flex-row-reverse items-center md:flex-row">
                <x-transactions.icon :icon-type="$iconType" />

                <div class="mr-4 font-semibold md:mr-0 md:ml-4 text-theme-secondary-900 dark:text-theme-secondary-200">
                    @lang('general.transaction.types.'.$transaction->typeName())

                    @if ($transaction->isMultiPayment())
                        <span class="ml-1 text-theme-secondary-600">{{ $transaction->recipientsCount() }}</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
