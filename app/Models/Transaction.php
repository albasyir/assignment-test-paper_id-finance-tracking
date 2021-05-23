<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'amount', 'account_id'];

    protected $hidden = ['laravel_through_key'];

    public function account()
    {
        $this->belongsTo(Account::class);
    }

    public function scopeGroupByMonth(Builder $query)
    {
        return $query
            ->addSelect(DB::raw("DATE_FORMAT(transactions.created_at, '%m-%Y') period"))
            ->addSelect(DB::raw("concat('[', group_concat(distinct transactions.account_id), ']') as accounts"))
            ->groupBy('period')
            ->addSelect(DB::raw("sum(transactions.amount) as amount"));
    }

    public function scopeGroupByDay(Builder $query)
    {
        return $query
            ->addSelect(DB::raw("DATE_FORMAT(transactions.created_at, '%d-%m-%Y') period"))
            ->addSelect(DB::raw("concat('[', group_concat(distinct transactions.account_id), ']') as accounts"))
            ->groupBy('period')
            ->addSelect(DB::raw("sum(transactions.amount) as amount"));
    }
}
