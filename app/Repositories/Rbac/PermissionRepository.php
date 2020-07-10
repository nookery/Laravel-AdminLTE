<?php

namespace App\Repositories\Rbac;

use App\Models\Rbac\Permission;
use Prettus\Repository\Eloquent\BaseRepository;

class PermissionRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Permission::class;
    }
}
