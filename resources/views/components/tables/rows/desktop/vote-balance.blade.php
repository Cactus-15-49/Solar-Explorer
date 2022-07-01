@php($address = substr($_SERVER["REQUEST_URI"], 9, 34))
<x-general.amount-fiat-tooltip :amount='$model->voteBreakdown("balance", $address)' :fiat='$model->voteBreakdown("fiat", $address)' />
