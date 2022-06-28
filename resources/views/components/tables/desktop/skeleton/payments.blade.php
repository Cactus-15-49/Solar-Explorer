<x-table-skeleton
    device="desktop"
    :items="[
        'general.transaction.transfer' => [
            'type' => 'address',
            'lastOn' => 'md',
        ],
        'general.transaction.amount'  => [
            'type' => 'number',
            'responsive' => true,
            'breakpoint' => 'md',
        ],
    ]"
/>
