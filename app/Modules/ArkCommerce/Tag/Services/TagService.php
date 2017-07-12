<?php namespace App\Modules\ArkCommerce\Tag\Services;


use App\Modules\ArkCommerce\Tag\Repositories\TagRepository;

use App\Modules\ArkCommerce\Store\Services\StoreService;

use Resource\Services\ResourceService;

use Resource\Events\ResourceWasCreated;
use Resource\Events\ResourceWasDeleted;
use Resource\Events\ResourceWasUpdated;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;

use DB;


class TagService extends ResourceService
{
    /**
     * @var
     */
    private $dispatcher;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dispatcher = new Dispatcher(new Container());

        parent::__construct();
    }

    /**
     * @return TagRepository
     */
    public function repository()
    {
        return new TagRepository();
    }

    /**
     * @return StoreService
     */
    public function storeService()
    {
        return new StoreService();
    }

    /**
     * Creates a record
     *
     * @param $data
     * @return mixed
     * @throws Exception
     * @throws \Exception
     */
    public function create($data)
    {
        DB::beginTransaction();

            $data['slug'] = str_slug($data['name']);
            $data = $this->repository->create($data);
            $this->dispatcher->fire(new ResourceWasCreated($data));

        DB::commit();

        return $data;
    }

    /**
     * Updates a record by id
     *
     * @param $id
     * @param array $data
     * @return array|mixed
     * @throws Exception
     * @throws \Exception
     */
    public function update($id, array $data)
    {
        DB::beginTransaction();

        $data['slug'] = str_slug($data['name']);
        $data = $this->repository->update($data, $id);
        $this->dispatcher->fire(new ResourceWasUpdated($data));

        DB::commit();

        return $data;
    }

    /**
     * Get All Tag With Store
     * 
     * @return mixed
     */
    public function getAllWithStore()
    {
        return $this->repository()->getAllTagAndStore();
    }

    /**
     * Get Tag With Store by id
     * 
     * @param  $id
     * @return mixed
     */
    public function getTagWithStore($id)
    {
        return $this->repository()->getTagAndStore($id);
    }

    /**
     * Get Tags for dropdown
     * 
     * @return mixed
     */
    public function getTagsForDropdown($value = 'id')
    {
        return $this->repository()->lists('name', $value);
    }

    /**
     * Get all tags with pagination
     * 
     * @param  $records
     * @return mixed
     */
    public function allTagsWithPagination($records)
    {
        $tags =  $this->repository->paginate($records);

        if(count($tags['data']) > 0)
        {
            //get the current route url
            $url = url(Route::getFacadeRoot()->current()->uri()) . '?records='.$records;

            //create the pagination manually
            $paginate = new LengthAwarePaginator($tags['data'], $tags['total'], $tags['per_page'], $tags['current_page'], array('path' => $url));

            // Get store and add in tags array
            foreach ($tags['data'] as $key => $tag) {
                $store = $this->storeService()->getStoreName($tag['store_id']);

                $tags['data'][$key]['store_name'] = $store['name'];
            }

            $tagList = $tags['data'];
        }

        else
        {
            $tagList = [];
            $paginate = [];
        }

        return [
                'tagList' => $tagList,
                'paginate' => $paginate
               ];

    }
}