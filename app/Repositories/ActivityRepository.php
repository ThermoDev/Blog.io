<?php

namespace App\Repositories;

use App\Interfaces\ActivityRepositoryInterface;
use Spatie\Activitylog\Models\Activity;

class ActivityRepository implements ActivityRepositoryInterface
{
    public function getAllActivities()
    {
        return Activity::latest()->all();
    }

    public function getActivityById($logId)
    {
        return Activity::findOrFail($logId);
    }

    public function getLastActivity()
    {
        return Activity::last();
    }

    public function getAllActivitiesByLatestWithPaginate($paginateNumber)
    {
        return Activity::latest()->paginate($paginateNumber);
    }
}
