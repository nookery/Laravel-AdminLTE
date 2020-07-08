<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable;
    use LogsActivity;
    use SearchableTrait;

    /**
     * 哪些字段发生变化需要记录日志
     *
     * @var array
     */
    protected static $logAttributes = ['*'];

    /**
     * 忽略这些字段的变化，不必记录日志
     *
     * @var array
     */
    protected static $logAttributesToIgnore = ['updated_at'];

    /**
     * 哪些事件需要记录日志，默认created,updated,deleted
     *
     * @var array
     */
    protected static $recordEvents = ['created', 'updated', 'deleted'];

    /**
     * 只记录变化的字段
     *
     * @var bool
     */
    protected static $logOnlyDirty = true;

    /**
     * 是否记录空日志
     *
     * @var bool
     */
    protected static $submitEmptyLogs = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
            'name' => 10,
            'email' => 10,
        ]
    ];
}
