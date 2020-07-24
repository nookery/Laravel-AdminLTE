<?php

namespace App\Repositories\Auth;

use App\Models\Auth\ActivityLog;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Repository\Traits\CacheableRepository;

class ActivityLogRepository extends BaseRepository implements CacheableInterface
{
    use CacheableRepository;

    /**
     * 可以搜索的字段，请求示例：http://prettus.local/users?search=John%20Doe
     * 此组件提供这个功能：andersao/l5-repository
     *
     * @var array
     */
    protected $fieldSearchable = [
        'description' => 'like',
    ];

    /**
     * boot
     */
    public function boot()
    {
        try {
            $this->pushCriteria(app(RequestCriteria::class));
        } catch (RepositoryException $e) {
        }
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ActivityLog::class;
    }
}
