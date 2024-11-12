<?php
namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\IpoDetails\IpoDetails;
use App\Models\ClientDetail\ClientDetail;
use App\Models\IpoAssignments\IpoAssignments;
use App\Repositories\IpoAssignments\EloquentIpoAssignmentsRepository;

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
            ->whereDate('closing_date', '>= ', date('Y-m-d'))
            ->get();

        $tomorrowIpos = IpoDetails::with(['assignments', 'assignments.client'])
            ->whereDate('closing_date', '>= ', date('Y-m-d', strtotime('+1 day')))
            ->get();

        $dayAfterIpos = IpoDetails::with(['assignments', 'assignments.client'])
            ->whereDate('closing_date', '>= ', date('Y-m-d', strtotime('+2 day')))
            ->get();

        $thirdDay = IpoDetails::with(['assignments', 'assignments.client'])
            ->whereDate('closing_date', '>= ', date('Y-m-d', strtotime('+3 day')))
            ->get();

        $fourDay = IpoDetails::with(['assignments', 'assignments.client'])
            ->whereDate('closing_date', '>= ', date('Y-m-d', strtotime('+4 day')))
            ->get();

        $clients = ClientDetail::get();

        $assignedIpos   = IpoAssignments::where('status', 1)->get();
        $repository     = new EloquentIpoAssignmentsRepository();
        $allotedList    = $repository->getAllotedList();
        $filterList     = [];

        foreach($allotedList as $alloted)
        {
            $filterList[$alloted->ipo->ipo_name][] = $alloted;
        }

        $completedIpos = IpoDetails::with(['assignments', 'assignments.client'])
            ->whereDate('listing_date', '<= ', date('Y-m-d'))
            ->get();
        // dd($completedIpos);
        return view('backend.dashboard.index')->with([
            'todayIpos'     => $todayIpos,
            'tomorrowIpos'  => $tomorrowIpos,
            'dayAfterIpos'  => $dayAfterIpos,
            'clients'       => $clients,
            'assignedIpos'  => $assignedIpos,
            'filterList'    => $filterList,
            'thirdDay'      => $thirdDay,
            'fourDay'       => $fourDay,
            'completedIpos' => $completedIpos
        ]);
    }
}