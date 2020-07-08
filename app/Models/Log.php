<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Log extends Authenticatable
{
    use SearchableTrait;

    protected $table = 'activity_log';

    /**
     * 搜索规则
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'description' => 10,
        ]
    ];
}
