<?php

namespace App\Repositories\Auth;

use App\Models\Auth\ActivityLog;
use Prettus\Repository\Eloquent\BaseRepository;

class ActivityLogRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return ActivityLog::class;
    }
}
