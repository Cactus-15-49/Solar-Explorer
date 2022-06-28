<x-grid.generic :title="trans('general.transaction.transfers')" icon="wallet">
    @if ($model->recipientsCount() === 1)
        <x-number>{{ $model->recipientsCount() }}</x-number> Transfer
    @else
    <x-number>{{ $model->recipientsCount() }}</x-number> Transfers
    @endif
</x-grid.generic>
