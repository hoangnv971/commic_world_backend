<?php

namespace Core\Repositories;

use Core\Repositories\Contracts\DashboardRepositoryContract;
use Core\Models\Dashboard;

class DashboardRepository implements DashboardRepositoryContract
{
    protected $model;

    public function __construct(Dashboard $model)
    {
        $this->model = $model;
    }

}
