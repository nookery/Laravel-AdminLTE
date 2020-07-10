<?php

namespace App\Models\Auth;

use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Activity
{
    /*
    |--------------------------------------------------------------------------
    | 活动日志
    |--------------------------------------------------------------------------
    |
    | 对应的表由此组件创建：spatie/laravel-activitylog
    | 表名在这里配置：config/activitylog.table_name
    |
    */

    /**
     * 用于模糊搜索，此组件提供：nicolaslopezj/searchable
     *
     */
    use SearchableTrait;

    /**
     * 搜索规则，用于此组件：nicolaslopezj/searchable
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
