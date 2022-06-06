<div class="pb-8 -mt-2 w-full bg-white content-container dark:bg-theme-secondary-900">
    <div class="flex py-4 px-8 w-full rounded-xl border border-theme-secondary-300 dark:border-theme-secondary-800">
        <div class="flex flex-col justify-between space-y-6 w-full sm:flex-row sm:space-y-0">
            <div class="flex justify-start" style="width: 100%">
                <x-general.entity-header-item
                    :title="trans('pages.wallet.voting_for')"
                    icon="app-transactions.vote"
                    voteFor="true"
                >
                    <x-slot name="text">
                        @foreach ($vote as $delegate)
                            <span style="display: inline-block; white-space: nowrap"><a href="/wallets/{{ $delegate->address() }}" class="leading-tight link">
                                <span class="truncate">{{ $delegate->username() }}</span>
                            </a>&nbsp;<span class="text-sm text-theme-secondary-500 dark:text-theme-secondary-700" style="margin: 0 6px 0 2px">({{ number_format($wallet->votesAttribute()[$delegate->username()], 2) }}%)</span></span>
                        @endforeach
                    </x-slot>
                </x-general.entity-header-item>
            </div>
        </div>
    </div>
</div>
