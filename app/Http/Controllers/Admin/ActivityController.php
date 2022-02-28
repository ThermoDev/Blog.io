<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Interfaces\ActivityRepositoryInterface;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function __construct(ActivityRepositoryInterface $activityRepository)
    {
        $this->middleware(['auth']);
        $this->activityRepository = $activityRepository;
    }

    public function index()
    {
        if (!auth()->user()->admin) {
            activity()->causedBy(auth()->user())->log("A user attempted to access the admin panel");
            return redirect()->route('home')->with('msg', 'Unauthorized access... Nice try!');
        }
        $activities = $this->activityRepository->getAllActivitiesByLatestWithPaginate(20);

        return view('admin.activity', [
            'activities' => $activities,
        ]);
    }
}
