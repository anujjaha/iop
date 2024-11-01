<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Transformers\GiftTransformer;
use App\Http\Controllers\Api\BaseApiController;
use App\Repositories\Gift\EloquentGiftRepository;

class APIGiftController extends BaseApiController
{
    /**
     * Gift Transformer
     *
     * @var Object
     */
    protected $giftTransformer;

    /**
     * Repository
     *
     * @var Object
     */
    protected $repository;

    /**
     * PrimaryKey
     *
     * @var string
     */
    protected $primaryKey = 'giftId';

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->repository                       = new EloquentGiftRepository();
        $this->giftTransformer = new GiftTransformer();
    }

    /**
     * List of All Gift
     *
     * @param Request $request
     * @return json
     */
    public function index(Request $request)
    {
        $paginate   = $request->get('paginate') ? $request->get('paginate') : false;
        $orderBy    = $request->get('orderBy') ? $request->get('orderBy') : 'id';
        $order      = $request->get('order') ? $request->get('order') : 'ASC';
        $items      = $paginate ? $this->repository->model->orderBy($orderBy, $order)->paginate($paginate)->items() : $this->repository->getAll($orderBy, $order);

        if(isset($items) && count($items))
        {
            $itemsOutput = $this->giftTransformer->transformCollection($items);

            return $this->successResponse($itemsOutput);
        }

        return $this->setStatusCode(400)->failureResponse([
            'message' => 'Unable to find Gift!'
            ], 'No Gift Found !');
    }

    /**
     * Create New (Store)
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $model = $this->repository->create($request->all());

        if($model)
        {
            $responseData = $this->giftTransformer->transform($model);

            return $this->successResponse($responseData, 'Gift is Created Successfully');
        }

        return $this->setStatusCode(400)->failureResponse([
            'reason' => 'Invalid Inputs'
            ], 'Something went wrong !');
    }

    /**
     * View
     *
     * @param Request $request
     * @param Int $id
     * @return string
     */
    public function show(Request $request, $id = null)
    {
        $itemId = (int) hasher()->decode($id);

        if($itemId)
        {
            $itemData = $this->repository->getById($itemId);

            if($itemData)
            {
                $responseData = $this->giftTransformer->transform($itemData);

                return $this->successResponse($responseData, 'View Item');
            }
        }

        return $this->setStatusCode(400)->failureResponse([
            'reason' => 'Invalid Inputs or Item not exists !'
            ], 'Something went wrong !');
    }

    /**
     * Update
     *
     * @param Request $request
     * @param int $id
     * @return string
     */
    public function update(Request $request, $id = null)
    {
        $itemId = (int) hasher()->decode($id);

        if($itemId)
        {
            $status = $this->repository->update($itemId, $request->all());

            if($status)
            {
                $itemData       = $this->repository->getById($itemId);
                $responseData   = $this->giftTransformer->transform($itemData);

                return $this->successResponse($responseData, 'Gift is Edited Successfully');
            }
        }

        return $this->setStatusCode(400)->failureResponse([
            'reason' => 'Invalid Inputs'
        ], 'Something went wrong !');
    }

    /**
     * Delete ( Destroy )
     *
     * @param Request $request
     * @return string
     */
    public function destroy(Request $request, $id = null)
    {
        $itemId = (int) hasher()->decode($id);

        if($itemId)
        {
            $status = $this->repository->destroy($itemId);

            if($status)
            {
                return $this->successResponse([
                    'success' => 'Gift Deleted'
                ], 'Gift is Deleted Successfully');
            }
        }

        return $this->setStatusCode(404)->failureResponse([
            'reason' => 'Invalid Inputs'
        ], 'Something went wrong !');
    }
}