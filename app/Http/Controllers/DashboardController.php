<?php

namespace App\Http\Controllers;

use App\Repositories\DashboardRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class DashboardController extends AppBaseController
{
    /** @var  DashboardRepository */
    private $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data['dashboardData'] = $this->dashboardRepository->getDashboardAssociatedData();
        $data['registerCandidatesData'] = $this->dashboardRepository->getRegisteredCandidatesData();
        $data['registerEmployersData'] = $this->dashboardRepository->getRegisteredEmployersData();
        $data['recentJobsData'] = $this->dashboardRepository->getRecentJobsData();

        return view('dashboard.index', compact('data'));
    }

    /**
     * @return Factory|View
     */
    public function employerDashboard()
    {
        $data = $this->dashboardRepository->getEmployerDashboardData();
        $data['recentJobs'] = $this->dashboardRepository->getEmployerRecentJobsData();
        $data['recentFollowers'] = $this->dashboardRepository->getEmployerRecentFollowerData();

        return view('employer.dashboard.index')->with($data);
    }
}
