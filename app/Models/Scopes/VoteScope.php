<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use App\Enums\CoreTransactionTypeEnum;
use App\Enums\TransactionTypeGroupEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

final class VoteScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where(function ($query): void {
            $query->where('type_group', TransactionTypeGroupEnum::CORE);
            $query->where('type', CoreTransactionTypeEnum::VOTE);
            $query->orWhere(function ($query): void {
                $query->where('type_group', TransactionTypeGroupEnum::MAGISTRATE);
                $query->where('type', 2);
            });
        });
    }
}
