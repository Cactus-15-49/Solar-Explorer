<div class="bg-white border-t border-theme-secondary-300 dark:border-theme-secondary-800 dark:bg-theme-secondary-900">
    <x-ark-container>
        <div class="w-full">
            <div class="flex relative justify-between items-end">
                <h3>Votes</h3>
            </div>

            <x-ark-tables.table class="hidden md:block">
                <thead>
                    <tr>
                        <x-tables.headers.desktop.text name="Delegate" />
                        <x-tables.headers.desktop.text class="text-right" name="Vote %" />
                    </tr>
                </thead>
                <tbody>
                    <x-ark-tables.row>
                        <x-ark-tables.cell>
                            <div class="flex items-center space-x-4">
                                <x-general.avatar :identifier="$transaction->voted()->address()" no-shrink />

                                <div class="flex items-center space-x-3 max-w-full">
                                    <a href="{{ route('wallet', $transaction->voted()->address()) }}" class="font-semibold link">
                                        {{ $transaction->voted()->username() }}
                                    </a>
                                    <span class="min-w-0 font-semibold text-theme-secondary-500 dark:text-theme-secondary-700">
                                        <x-truncate-dynamic>{{ $transaction->voted()->address() }}</x-truncate-dynamic>
                                    </span>
                                </div>

                            </div>
                        </x-ark-tables.cell>
                        <x-ark-tables.cell>
                            <div class="flex flex-grow justify-end items-center space-x-4">
                                <span>100.00%</span>
                            </div>
                        </x-ark-tables.cell>
                    </x-ark-tables.row>
                </tbody>
            </x-ark-tables.table>

            <div class="divide-y md:hidden table-list-mobile">
                <div class="table-list-mobile-row">
                    <div>
                        Delegate

                        <div class="flex items-center space-x-3">
                            <a href="{{ route('wallet', $transaction->voted()->address()) }}" class="font-semibold link">
                                {{ $transaction->voted()->username() }}
                            </a>

                            <x-general.avatar :identifier="$transaction->voted()->address()" />
                        </div>
                    </div>

                    <div>
                        Vote %

                        <span>100.00%</span>
                    </div>
                </div>
            </div>

        </div>
    </x-ark-container>
</div>
