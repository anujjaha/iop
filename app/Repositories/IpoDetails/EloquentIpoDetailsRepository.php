<?php 

namespace App\Repositories\IpoDetails;

/**
 * Class EloquentIpoDetailsRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */
use Carbon\Carbon;
use App\Models\IpoDetails\IpoDetails;
use App\Repositories\DbRepository;
use App\Models\Fees\Fees;
use App\Exceptions\GeneralException;
use App\Models\ClientDetail\ClientDetail;
use App\Models\Simplan\Simplan;
use App\Models\PaidInterest\PaidInterest;

class EloquentIpoDetailsRepository extends DbRepository
{
    /**
     * IpoDetails Model
     *
     * @var Object
     */
    public $model;

    /**
     * IpoDetails Title
     *
     * @var string
     */
    public $moduleTitle = 'IpoDetails';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'        => 'Id',
		'ipo_name'        => 'Ipo_name',
		'opening_date'        => 'P&L',
		'closing_date'        => 'Dates',
		'listing_date'        => 'Listing',
		'gmp_latest'        => 'Gmp',
		'lot_size'        => 'Lot Size',
		'block_amt'        => 'Blocked',
		'refund_date'        => 'Refund_date',
		'listed_price'        => 'Listed',
		'ipo_type'        => 'Ipo Type',
		'notes'        => 'Notes',
"actions"         => "Actions"
    ];

    /**
     * Table Columns
     *
     * @var array
     */
    public $tableColumns = [
        'id' =>   [
                    'data'          => 'id',
                    'name'          => 'id',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'ipo_name' =>   [
                    'data'          => 'ipo_name',
                    'name'          => 'ipo_name',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'opening_date' =>   [
                    'data'          => 'opening_date',
                    'name'          => 'opening_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'closing_date' =>   [
                    'data'          => 'closing_date',
                    'name'          => 'closing_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'listing_date' =>   [
                    'data'          => 'listing_date',
                    'name'          => 'listing_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'gmp_latest' =>   [
                    'data'          => 'gmp_latest',
                    'name'          => 'gmp_latest',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'lot_size' =>   [
                    'data'          => 'lot_size',
                    'name'          => 'lot_size',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'block_amt' =>   [
                    'data'          => 'block_amt',
                    'name'          => 'block_amt',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'refund_date' =>   [
                    'data'          => 'refund_date',
                    'name'          => 'refund_date',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'listed_price' =>   [
                    'data'          => 'listed_price',
                    'name'          => 'listed_price',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'ipo_type' =>   [
                    'data'          => 'ipo_type',
                    'name'          => 'ipo_type',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'notes' =>   [
                    'data'          => 'notes',
                    'name'          => 'notes',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'actions' => [
                'data'          => 'actions',
                'name'          => 'actions',
                'searchable'    => false,
                'sortable'      => false
            ]
    ];

    /**
     * Is Admin
     *
     * @var boolean
     */
    protected $isAdmin = false;

    /**
     * Admin Route Prefix
     *
     * @var string
     */
    public $adminRoutePrefix = 'admin';

    /**
     * Client Route Prefix
     *
     * @var string
     */
    public $clientRoutePrefix = 'frontend';

    /**
     * Admin View Prefix
     *
     * @var string
     */
    public $adminViewPrefix = 'backend';

    /**
     * Client View Prefix
     *
     * @var string
     */
    public $clientViewPrefix = 'frontend';

    /**
     * Module Routes
     *
     * @var array
     */
    public $moduleRoutes = [
        'listRoute'     => 'ipodetails.index',
        'createRoute'   => 'ipodetails.create',
        'storeRoute'    => 'ipodetails.store',
        'editRoute'     => 'ipodetails.edit',
        'updateRoute'   => 'ipodetails.update',
        'deleteRoute'   => 'ipodetails.destroy',
        'showRoute'     => 'ipodetails.show',
        'dataRoute'     => 'ipodetails.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'ipodetails.index',
        'createView'    => 'ipodetails.create',
        'editView'      => 'ipodetails.edit',
        'deleteView'    => 'ipodetails.destroy',
        'showView'    => 'ipodetails.show',
        'chartView'    => 'ipodetails.chart',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new IpoDetails;
    }

    /**
     * Create IpoDetails
     *
     * @param array $input
     * @return mixed
     */
    public function create($input)
    {
        $input = $this->prepareInputData($input, true);
        $model = $this->model->create($input);

        if($model)
        {
            return $model;
        }

        return false;
    }

    /**
     * Update IpoDetails
     *
     * @param int $id
     * @param array $input
     * @return bool|int|mixed
     */
    public function update($id, $input)
    {
        $model = $this->model->find($id);

        if($model)
        {
            $input = $this->prepareInputData($input);

            return $model->update($input);
        }

        return false;
    }

    /**
     * Destroy IpoDetails
     *
     * @param int $id
     * @return mixed
     * @throws GeneralException
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);

        if($model)
        {
            return $model->delete();
        }

        return  false;
    }

    /**
     * Get All
     *
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getAll($orderBy = 'id', $sort = 'asc')
    {
        return $this->model->orderBy($orderBy, $sort)->get();
    }

    /**
     * Get by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id = null)
    {
        if($id)
        {
            return $this->model->find($id);
        }

        return false;
    }

    /**
     * Get Table Fields
     *
     * @return array
     */
    public function getTableFields()
    {
        return [
            $this->model->getTable().'.*'
        ];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->model->select($this->getTableFields())
            ->orderBy('listing_date', 'asc')
            ->get();
    }

    /**
     * Set Admin
     *
     * @param boolean $isAdmin [description]
     */
    public function setAdmin($isAdmin = false)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Prepare Input Data
     *
     * @param array $input
     * @param bool $isCreate
     * @return array
     */
    public function prepareInputData($input = array(), $isCreate = false)
    {
        if($isCreate)
        {
            $input = array_merge($input, ['user_id' => access()->user()->id]);
        }

        $input['opening_date'] = date('Y-m-d', strtotime($input['opening_date']));
        $input['closing_date'] = date('Y-m-d', strtotime($input['closing_date']));
        $input['listing_date'] = date('Y-m-d', strtotime($input['listing_date']));
        $input['refund_date'] = date('Y-m-d', strtotime($input['refund_date']));

        return $input;
    }

    /**
     * Get Table Headers
     *
     * @return string
     */
    public function getTableHeaders()
    {
        if($this->isAdmin)
        {
            return json_encode($this->setTableStructure($this->tableHeaders));
        }

        $clientHeaders = $this->tableHeaders;

        unset($clientHeaders['username']);

        return json_encode($this->setTableStructure($clientHeaders));
    }

    /**
     * Get Table Columns
     *
     * @return string
     */
    public function getTableColumns()
    {
        if($this->isAdmin)
        {
            return json_encode($this->setTableStructure($this->tableColumns));
        }

        $clientColumns = $this->tableColumns;

        unset($clientColumns['username']);

        return json_encode($this->setTableStructure($clientColumns));
    }

    public function getArrayList()
    {
        $ipos = $this->model->orderBy('closing_date','desc')->get();
        $options = [];
        foreach($ipos as $ipo)
        {
            $options[$ipo->id] = $ipo->ipo_name;
        }

        return $options;
    }

    public function getChartData($months = null)
    {
        $ipos = $this->model->with(['assignments'])->get();
        $output = [];
        $return = [];

        foreach($ipos as $ipo)
        {
            $iDate = date('M-Y', strtotime($ipo->listing_date));
            $assignments = $ipo->assignments;
            $pl = $assignments->where('status',5)
                ->sum('final_net_pl');
            if(isset($output[$iDate]))
            {
                $output[$iDate] = $output[$iDate] + $pl;
            }
            else
            {
                $output[$iDate] = $pl;
            }
        }

        foreach($months as $amonth)
        {
            $return[$amonth] = $output[$amonth] ?? 0;
        }

        return $return;
    }

    public function getMonthlyExpenses($months = null)
    {
        // $clients = ClientDetail::all();
        // dd($clients);
        

        $start = Carbon::create(2024, 10, 1); // October 2024
            $end = Carbon::now()->startOfMonth(); // Current month (October 2025)

            $months = collect();

            while ($start <= $end) {
                $months->push(strtoupper($start->format('M-Y')));
                $start->addMonth();
            }

        $tFees = 0;
        $totalClients = 0;
        $op = [];
        foreach($months as $month)
        {
            $totalClients = $totalClients + ClientDetail::whereRaw("UPPER(DATE_FORMAT(created_at, '%b-%Y')) = ?", [$month])
                ->where('is_free', 0)
                ->count();
            // dd($totalClients);
            $paidInt = PaidInterest::whereRaw("
                UPPER(DATE_FORMAT(STR_TO_DATE(title, '%d-%m-%Y'), '%b-%Y')) = ?
            ", [$month])->first() ?? 0;
            $bajajPaid = 0;
            if(isset($paidInt) && isset($paidInt->id))
            {
                $bajajPaid = $paidInt->amount;
            }

            $tFees = $tFees + ( $totalClients * 500 );
            $simCost = Simplan::whereRaw("UPPER(DATE_FORMAT(recharge_date, '%b-%Y')) = ?", [$month])
                ->sum('cost');
            $op[ucfirst(strtolower($month))] = ($totalClients * 500) + $simCost + $bajajPaid;
        }
        
        // dd($op);
        return $op;
        $fees = Fees::all();
        $output = [];
        $return = [];
        foreach($fees as $fee)
        {
            $monthTitle = ucfirst($fee->month_title);
            if(isset($output[$monthTitle]))
            {
                $output[$monthTitle] = $output[$monthTitle] + $fee->fee_amount;
            }
            else
            {
                $output[$monthTitle] = $fee->fee_amount;
            }
        }

        foreach($months as $amonth)
        {
            $return[$amonth] = $output[$amonth] ?? 0;
        }

        return $return;
    }

    public function prepareClientSheet($ipoId = null)
    {
        $ipo = $this->model->where('id', $ipoId)->first();
        $clients = ClientDetail::where('is_free', 0)
            ->orderBy('investory_category', 'desc')
            ->orderBy('name')
            ->get();

        $data = [
            ['Sr', 'Name', 'PAN', 'CurrentBalance', 'Remaining', 'IPO'],
        ];
        $sr = 1;
        $retail = $ipo->min_lot_size * $ipo->price_band;
        $shni = $ipo->max_lot_size * $ipo->price_band;
        foreach($clients as $client)
        {
            $blockAmount = $client->investory_category == 2 ? $shni : $retail;
            $due = $client->balance - $blockAmount;
            $data[] = [
                $sr,
                $client->name,
                $client->pan_no,
                $client->balance,
                $due,
                $blockAmount,
            ];
            $sr++;
        }

        return $data;
    }
}