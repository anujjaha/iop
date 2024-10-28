<?php
namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\IpoDetails\IpoDetails;
use App\Models\ClientDetail\ClientDetail;
use App\Models\IpoAssignments\IpoAssignments;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $todayIpos = IpoDetails::with(['assignments', 'assignments.client'])
            ->whereDate('closing_date', date('Y-m-d', strtotime('+1 day')))
            ->get();

        $tomorrowIpos = IpoDetails::with(['assignments', 'assignments.client'])
            ->whereDate('closing_date', date('Y-m-d', strtotime('+2 day')))
            ->get();

        $dayAfterIpos = IpoDetails::with(['assignments', 'assignments.client'])
            ->whereDate('closing_date', date('Y-m-d', strtotime('+3 day')))
            ->get();

        $clients = ClientDetail::get();

        $assignedIpos = IpoAssignments::where('status', 1)->get();

        return view('backend.dashboard.index')->with([
            'todayIpos'     => $todayIpos,
            'tomorrowIpos'  => $tomorrowIpos,
            'dayAfterIpos'  => $dayAfterIpos,
            'clients'       => $clients,
            'assignedIpos'  => $assignedIpos,
        ]);
    }
}