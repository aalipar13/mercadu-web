<?php namespace App\Modules\ArkCommerce\Store\Services;


use Resource\Services\ResourceService;

use App\Modules\ArkCommerce\Store\Repositories\StoreRepository;

use App\Modules\ArkCommerce\StorePhoto\Services\StorePhotoService;

use Resource\Events\ResourceWasCreated;
use Resource\Events\ResourceWasDeleted;
use Resource\Events\ResourceWasUpdated;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;

use DB;

use Config;

use File;


class StoreService extends ResourceService
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
     * @return StoreRepository
     */
    public function repository()
    {
        return new StoreRepository();
    }

    /**
     * @return StorePhotoService
     */
    public function service()
    {
        return new StorePhotoService();
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
        //load directory constants
        $DIRECTORIES = Config::get('constants.directories');

        $request = $data;

        $data = $data->all();

        // Remove the comma for min_orders if it has one
        // if( strpos($data['min_orders'], ',') !== false )
        // {
        //     $data['min_orders'] = str_replace(',', '', $data['min_orders']);
        // }

        $data['slug'] = str_slug($data['name']);

        DB::beginTransaction();
                
            $result['store'] = $this->repository->create($data);

            $result['storePhoto'] = $this->service()->save($result['store']['id'], $request);

            //get the image and create a new name
            $photoName = md5(uniqid(mt_rand(), true)) . '.' . $request->file('store_img')->getClientOriginalExtension();

            //create the directory if it doesn't exist
            if(!File::exists($DIRECTORIES['STORE_PHOTO_FOLDER_PATH'])) {
                File::makeDirectory($DIRECTORIES['STORE_PHOTO_FOLDER_PATH'], 0775, true);
            }
            
            //move the photo
            $request->file('store_img')->move($DIRECTORIES['STORE_PHOTO_FOLDER_PATH'] . '/', $photoName);
                
            //prepare the data
            $data['store_img'] = $DIRECTORIES['STORE_PHOTO_FOLDER'] . '/' . $photoName;

            $this->dispatcher->fire(new ResourceWasCreated($result));

        DB::commit();

        return $result;
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
    public function revise($id, $data)
    {
        //load directory constants
        $DIRECTORIES = Config::get('constants.directories');

        $request = $data;

        $data = $data->all();

        // Remove the comma for min_orders if it has one
        // if( strpos($data['min_orders'], ',') !== false )
        // {
        //     $data['min_orders'] = str_replace(',', '', $data['min_orders']);
        // }

        $data['slug'] = str_slug($data['name']);

        DB::beginTransaction();

        if($request->file('store_img')) {

            //get the image and create a new name
            $photoName = md5(uniqid(mt_rand(), true)) . '.' . $request->file('store_img')->getClientOriginalExtension();
            
            if(File::exists($DIRECTORIES['STORE_PHOTO_FOLDER_PATH'])) {
                //move the image
                $request->file('store_img')->move($DIRECTORIES['STORE_PHOTO_FOLDER_PATH'] . '/', $photoName);
                
                //prepare the data
                $data['store_img'] = $DIRECTORIES['STORE_PHOTO_FOLDER'] . '/' . $photoName;
            }
        }

        // delete old image
        $oldPhoto = $this->repository->find($id);
        File::delete(public_path() . $oldPhoto['store_img']);

        $result['store'] = $this->repository->update($data, $id);

        $this->dispatcher->fire(new ResourceWasUpdated($result));

        DB::commit();

        return $result;
    }

    /**
     * Get Stores for dropdown
     * 
     * @return mixed
     */
    public function getStoresForDropdown()
    {
        return $this->repository()->lists('name', 'id');
    }

    /**
     * Get all stores with pagination
     * 
     * @param  $records
     * @return mixed
     */
    public function allStoresWithPagination($records)
    {
        $store =  $this->repository->paginate($records);

        if(count($store['data']) > 0)
        {
            //get the current route url
            $url = url(Route::getFacadeRoot()->current()->uri()) . '?records='.$records;

            //create the pagination manually
            $paginate = new LengthAwarePaginator($store['data'], $store['total'], $store['per_page'], $store['current_page'], array('path' => $url));

            $storeList = $store['data'];
        }
        else
        {
            $storeList = [];
            $paginate = [];
        }

        return [
                'storeList' => $storeList,
                'paginate' => $paginate
               ];
    }

    /**
     * Get Store Name
     * 
     * @return mixed
     */
    public function getStoreName($id)
    {
        return $this->repository()->find($id, ['name']);
    }

    /**
     * Get store with store photos
     * 
     * @return mixed
     */
    public function getStoreWithPhotos($storeId)
    {
        return $this->repository()->getStoreWithStorePhotos($storeId);
    }

    /**
     * Get store with name
     * 
     * @param  $name
     * @return mixed
     */
    public function getStoreWithName($name)
    {
        return $this->repository()->getStoreByName($name);
    }
}