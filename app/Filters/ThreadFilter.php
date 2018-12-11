<?php
/**
 * Created by PhpStorm.
 * User: murat
 * Date: 09.12.18
 * Time: 23:09
 */

namespace App\Filters;


use App\User;

class ThreadFilter extends Filter
{
    protected $filters = ['by', 'popular'];

    public function by($value)
    {
        $user = User::where('name', $value)->firstOrFail();
        return $this->builder->where('user_id', $user->id);
    }

    public function popular()
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count', 'desc');
    }
}