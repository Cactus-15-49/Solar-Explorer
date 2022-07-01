<x-grid.sender :model="$transaction" />

@if ($transaction->recipientsCount() === 1)
    <x-grid.recipient :model="$transaction" />
@else
    <x-grid.recipient-count :model="$transaction" />
@endif
<x-grid.block-id :model="$transaction" />

<x-grid.timestamp :model="$transaction" />

<x-grid.vendor-field :model="$transaction" />

<x-grid.nonce :model="$transaction" />
