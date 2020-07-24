<?php

namespace App\Models\Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /*
    |--------------------------------------------------------------------------
    | 用户
    |--------------------------------------------------------------------------
    |
    | 表名在这里配置：config.auth.table_name
    |
    */

    use Notifiable;

    /**
     * 用于记录本Model的变动日志，此组件提供：spatie/laravel-activitylog
     *
     */
    use LogsActivity;

    /**
     * RBAC相关功能，此组件提供：spatie/laravel-permission
     *
     */
    use HasRoles;

    /**
     * 哪些字段发生变化需要记录日志，详见这个组件的文档：spatie/laravel-activitylog
     *
     * @var array
     */
    protected static $logAttributes = ['*'];

    /**
     * 忽略这些字段的变化，不必记录日志，详见这个组件的文档：spatie/laravel-activitylog
     *
     * @var array
     */
    protected static $logAttributesToIgnore = [];

    /**
     * 哪些事件需要记录日志，默认created,updated,deleted，详见这个组件的文档：spatie/laravel-activitylog
     *
     * @var array
     */
    protected static $recordEvents = ['created', 'updated', 'deleted'];

    /**
     * 只记录变化的字段，详见这个组件的文档：spatie/laravel-activitylog
     *
     * @var bool
     */
    protected static $logOnlyDirty = true;

    /**
     * 是否记录空日志，详见这个组件的文档：spatie/laravel-activitylog
     *
     * @var bool
     */
    protected static $submitEmptyLogs = false;

    /**
     * 允许批量填充的字段
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
     * User constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        if (!isset($this->table)) {
            $this->setTable(config('auth.table_name'));
        }

        parent::__construct($attributes);
    }

    /**
     * 用户头像
     *
     * @return string
     */
    public function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }

    /**
     * 用户的个人描述
     *
     * @return string
     */
    public function adminlte_desc()
    {
        return 'That\'s a nice guy';
    }

    /**
     * 用户个人页面
     *
     * @return string
     */
    public function adminlte_profile_url()
    {
        return '/';
    }
}
