<?php
    use App\Facades\Wallets;
?>
@if (count($transaction->votes()) > 0)
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
                        @foreach ($transaction->votes() as $delegate => $percent)
                            @php ($wallet = Wallets::findByUsername($delegate))
                            <x-ark-tables.row>
                                <x-ark-tables.cell>
                                    <div class="flex items-center space-x-4">
                                        <x-general.avatar :identifier="$wallet['address']" no-shrink />

                                        <div class="flex items-center space-x-3 max-w-full">
                                            <a href="{{ route('wallet', $wallet['address']) }}" class="font-semibold link">
                                                {{ $delegate }}
                                            </a>
                                            <span class="min-w-0 font-semibold text-theme-secondary-500 dark:text-theme-secondary-700">
                                                <x-truncate-dynamic>{{ $wallet['address'] }}</x-truncate-dynamic>
                                            </span>
                                        </div>

                                    </div>
                                </x-ark-tables.cell>
                                <x-ark-tables.cell>
                                    <div class="flex flex-grow justify-end items-center space-x-4">
                                        <span>{{ number_format($percent, 2) }}%</span>
                                    </div>
                                </x-ark-tables.cell>
                            </x-ark-tables.row>
                        @endforeach
                    </tbody>
                </x-ark-tables.table>

                <div class="divide-y md:hidden table-list-mobile">
                    @foreach ($transaction->votes() as $delegate => $percent)
                        @php ($wallet = Wallets::findByUsername($delegate))
                        <div class="table-list-mobile-row">
                            <div>
                                Delegate

                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('wallet', $wallet['address']) }}" class="font-semibold link">
                                        {{ $delegate }}
                                    </a>

                                    <x-general.avatar :identifier="$wallet['address']" />
                                </div>
                            </div>

                            <div>
                                Vote %

                                <span>{{ number_format($percent, 2) }}%</span>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </x-ark-container>
    </div>
@endif