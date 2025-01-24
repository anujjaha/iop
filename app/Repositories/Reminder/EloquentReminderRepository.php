<?php 

namespace App\Repositories\Reminder;

/**
 * Class EloquentReminderRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\Reminder\Reminder;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentReminderRepository extends DbRepository
{
    /**
     * Reminder Model
     *
     * @var Object
     */
    public $model;

    /**
     * Reminder Title
     *
     * @var string
     */
    public $moduleTitle = 'Reminder';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        		'id'        => 'Id',
		'actual_time'        => 'Actual_time',
		'title'        => 'Title',
		'notes'        => 'Notes',
		'frequency'        => 'Frequency',
		'new_time'        => 'New_time',
		'reminder_tone'        => 'Reminder_tone',
		'user_id'        => 'User_id',
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
		'actual_time' =>   [
                    'data'          => 'actual_time',
                    'name'          => 'actual_time',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'title' =>   [
                    'data'          => 'title',
                    'name'          => 'title',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'notes' =>   [
                    'data'          => 'notes',
                    'name'          => 'notes',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'frequency' =>   [
                    'data'          => 'frequency',
                    'name'          => 'frequency',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'new_time' =>   [
                    'data'          => 'new_time',
                    'name'          => 'new_time',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'reminder_tone' =>   [
                    'data'          => 'reminder_tone',
                    'name'          => 'reminder_tone',
                    'searchable'    => true,
                    'sortable'      => true
                ],
		'user_id' =>   [
                    'data'          => 'user_id',
                    'name'          => 'user_id',
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
        'listRoute'     => 'reminder.index',
        'createRoute'   => 'reminder.create',
        'storeRoute'    => 'reminder.store',
        'editRoute'     => 'reminder.edit',
        'updateRoute'   => 'reminder.update',
        'deleteRoute'   => 'reminder.destroy',
        'dataRoute'     => 'reminder.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'reminder.index',
        'createView'    => 'reminder.create',
        'editView'      => 'reminder.edit',
        'deleteView'    => 'reminder.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new Reminder;
    }

    /**
     * Create Reminder
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
     * Update Reminder
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
     * Destroy Reminder
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
        return $this->model->select($this->getTableFields())->get();
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

    public function getReminderEvents()
    {
        $records    = $this->model->with('client')->get();
        $output     = [];

        foreach($records as $record)
        {
            if($record->frequency == 'MONTHLY')
            {
                for($i = 1; $i <= 12; $i++)
                {
                    if($i < 10)
                    {
                        $i = '0' .$i;
                    }
                    $output[] = $this->getCalendarInfo($record, $i);
                }
            }
            else if($record->frequency == 'YEARLY')
            {
                for($j = -1; $j < 3; $j++)
                {
                    $output[] = $this->getCalendarInfo($record, null, $j);
                }
            }
            else
            {
                $output[] = $this->getCalendarInfo($record);
            }
        }
        return $output;
    }

    private function getCalendarInfo($record, $i = null, $yearly = null)
    {
        $date = isset($i) ? date('Y-'.$i.'-d', strtotime($record->actual_time)) : date('Y-m-d', strtotime($record->actual_time));

        if(isset($yearly))
        {
            for($j = -1; $j < 3; $j++)
            {
                $d = date('d', strtotime($record->actual_time));
                $date = date('Y-m-'.$d, strtotime($yearly . ' year'));
            }
        }

        return [
            'title' =>  $record->client->getFullName()." | ".$record->title . "<br/>".$record->notes,
            'start' => $date
        ];
    }
}