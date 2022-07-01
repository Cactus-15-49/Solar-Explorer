<?php

declare(strict_types=1);

namespace App\ViewModels\Concerns\Wallet;

use App\Services\Cache\WalletCache;
use App\Services\ExchangeRate;
use App\Services\Timestamp;
use Illuminate\Support\Arr;
use Mattiasgeniar\Percentage\Percentage;

trait CanVote
{
    public function isVoting(): bool
    {
        return count(Arr::get($this->wallet, 'attributes.votes')) > 0;
    }

    public function vote()
    {
        if (is_null($this->wallet->public_key)) {
            return null;
        }

        $vote = Arr::get($this->wallet, 'attributes.votes');

        $sortedVotes = array();
        foreach ($vote as $key => $row) {
            $sortedVotes[] = array('username' => $key, 'percent' => $row);
        }
        $username  = array_column($sortedVotes, 'username');
        $percent = array_column($sortedVotes, 'percent');
        array_multisort($percent, SORT_DESC, SORT_NUMERIC, $username, SORT_ASC, SORT_NATURAL, $sortedVotes);
        $vote = array();
        foreach ($sortedVotes as $sortedVote) {
            $vote[$sortedVote['username']] = $sortedVote['percent'];
        }

        if (is_null($vote)) {
            return null;
        }

        if (count($vote) === 0) {
            return null;
        }

        $cache = new WalletCache();

        $ret = array();
        $keys = array_keys($vote);

        for ($i = 0; $i < count($keys); $i++) {
            $public_key = $cache->getPublicKeyByUsername(array_keys($vote)[$i]);

            if (is_null($public_key)) {
                return null;
            }

            $delegate = $cache->getVote($public_key);

            if (is_null($delegate)) {
                return null;
            }

            $ret[] = new static($delegate);
        }

        return $ret;
    }

    public function voteBreakdown($type, $address)
    {
        if (is_null($this->wallet->public_key)) {
            return null;
        }

        $cache = new WalletCache();

        $vote = $cache->getUsernameByAddress($address);

        if (is_null($vote)) {
            return null;
        }

        $public_key = $cache->getPublicKeyByUsername($vote);

        if (is_null($public_key)) {
            return null;
        }

        $delegate = $cache->getVote($public_key);

        if (is_null($delegate)) {
            return null;
        }

        if ((float) $delegate->attributes['delegate']['voteBalance'] === 0.0) {
            return null;
        }

        $votes = Arr::get($this->wallet, 'attributes.votes');
        $sortedVotes = array();
        foreach ($votes as $key => $row) {
            $sortedVotes[] = array('username' => $key, 'percent' => $row);
        }
        $username  = array_column($sortedVotes, 'username');
        $percent = array_column($sortedVotes, 'percent');
        array_multisort($percent, SORT_DESC, SORT_NUMERIC, $username, SORT_ASC, SORT_NATURAL, $sortedVotes);
        $votes = array();
        foreach ($sortedVotes as $sortedVote) {
            $votes[$sortedVote['username']] = $sortedVote['percent'];
        }

        $balance = $remainder = $this->wallet->balance->toNumber();
        $weight = array();

        foreach ($votes as $votedDelegate => $percent) {
            $weight[$votedDelegate] = ~~($balance * $percent / 100);
        }

        foreach ($weight as $countedWeight) {
            $remainder -= $countedWeight;
        }

        $keys = array_keys($weight);
        for ($i = 0; $i < $remainder; $i++) {
            $weight[$keys[$i]]++;
        }

        if ($type === "percentage") {
            return Percentage::calculate($weight[$delegate->attributes['delegate']['username']], (float) $delegate->attributes['delegate']['voteBalance']);
        } else if ($type === "fiat") {
            return ExchangeRate::convert($weight[$delegate->attributes['delegate']['username']] / 1e8, Timestamp::now()->unix());
        }

        return $weight[$delegate->attributes['delegate']['username']] / 1e8;
    }
}
