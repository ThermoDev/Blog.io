<?php

namespace App\Interfaces;

interface ActivityRepositoryInterface
{
    public function getAllActivities();
    public function getActivityById($logId);
    public function getLastActivity();
    public function getAllActivitiesByLatestWithPaginate($paginateNumber);
}
