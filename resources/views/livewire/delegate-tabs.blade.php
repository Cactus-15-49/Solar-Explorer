<div class="justify-between hidden md:flex">
    <div class="flex w-9/12 lg:w-10/12 tabs">
        <div
            class="tab-item transition-default"
            :class="{ 'tab-item-current': status === 'active' && component !== 'monitor' }"
            wire:click="$emit('filterByDelegateStatus', 'active');"
            @click="component = 'table'; status = 'active'"
        >
            <span>@lang('pages.delegates.active')</span>

            @if ($countActive)
                <span class="info-badge">{{ $countActive }}</span>
            @endif
        </div>

        <div
            class="tab-item transition-default"
            :class="{ 'tab-item-current': status === 'standby' && component !== 'monitor' }"
            wire:click="$emit('filterByDelegateStatus', 'standby');"
            @click="component = 'table'; status = 'standby'"
        >
            <span>@lang('pages.delegates.standby')</span>

            <span class="info-badge">{{ $countStandby }}</span>
        </div>

        <div
            class="tab-item transition-default"
            :class="{ 'tab-item-current': status === 'resigned' && component !== 'monitor' }"
            wire:click="$emit('filterByDelegateStatus', 'resigned');"
            @click="component = 'table'; status = 'resigned'"
        >
            <span>@lang('pages.delegates.resigned')</span>

            <span class="info-badge">{{ $countResigned }}</span>
        </div>
    </div>

    <div class="w-3/12 lg:w-2/12 text-center tabs md:ml-6">
        <div
            class="tab-item transition-default"
            :class="{ 'tab-item-current': component === 'monitor' }"
            @click="component === 'monitor' ? component = 'table' : component = 'monitor'"
        >
            <div class="flex justify-center space-x-2">
                <x-ark-icon name="app-monitor" class="text-theme-secondary-700"/>
                <span>@lang('pages.delegates.monitor')</span>
            </div>
        </div>
    </div>
</div>

<div class="md:hidden">
    <x-ark-dropdown
        wrapper-class="relative w-full p-2 mb-8 border rounded-lg border-theme-secondary-300 dark:border-theme-secondary-800"
        button-class="w-full font-semibold text-left text-theme-secondary-900 dark:text-theme-secondary-200"
        dropdown-classes="left-0 w-full z-20"
        :init-alpine="false"
    >
        <x-slot name="button">
            <div class="flex items-center space-x-4">
                <x-ark-icon name="menu-open" size="sm" />

                <div x-show="status === 'active' && component !== 'monitor'">
                    @lang('pages.delegates.active')
                    @if($countActive)<span class="info-badge">{{ $countActive }}</span>@endif
                </div>

                <div x-show="status === 'standby' && component !== 'monitor'">
                    @lang('pages.delegates.standby')
                    <span class="info-badge">{{ $countStandby }}</span>
                </div>

                <div x-show="status === 'resigned' && component !== 'monitor'">
                    @lang('pages.delegates.resigned')
                    <span class="info-badge">{{ $countResigned }}</span>
                </div>

                <div x-show="component === 'monitor'">
                    @lang('pages.delegates.monitor')
                </div>
            </div>
        </x-slot>

        <div class="p-4">
            <a wire:click="$emit('filterByDelegateStatus', 'active');" @click="component = 'table'; status = 'active'" class="dropdown-entry">
                <span>@lang('pages.delegates.active')</span>

                @if ($countActive)
                    <span class="info-badge">{{ $countActive }}</span>
                @endif
            </a>

            <a wire:click="$emit('filterByDelegateStatus', 'standby');" @click="component = 'table'; status = 'standby'" class="dropdown-entry">
                <span>@lang('pages.delegates.standby')</span>

                <span class="info-badge">{{ $countStandby }}</span>
            </a>

            <a wire:click="$emit('filterByDelegateStatus', 'resigned');" @click="component = 'table'; status = 'resigned'" class="dropdown-entry">
                <span>@lang('pages.delegates.resigned')</span>

                <span class="info-badge">{{ $countResigned }}</span>
            </a>

            <a @click="component === 'monitor' ? component = 'list' : component = 'monitor'"
                class="dropdown-entry">
                <span>@lang('pages.delegates.monitor')</span>
            </a>
        </div>
    </x-ark-dropdown>
</div>