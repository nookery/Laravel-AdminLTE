<?php

namespace App\Models\Rbac;

use Nicolaslopezj\Searchable\SearchableTrait;

class Permission extends \Spatie\Permission\Models\Permission
{
    /*
    |--------------------------------------------------------------------------
    | 权限，RBAC系统的一部分
    |--------------------------------------------------------------------------
    |
    | 对应的表由此组件创建：spatie/laravel-permission
    | 表名在这里配置：config/permission.table_names
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
            'name' => 10,
            'guard_name' => 20
        ]
    ];
}
