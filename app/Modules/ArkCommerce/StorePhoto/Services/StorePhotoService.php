<?php namespace App\Modules\ArkCommerce\StorePhoto\Services;


use App\Modules\ArkCommerce\StorePhoto\Repositories\StorePhotoRepository;

use Resource\Services\ResourceService;
use Resource\Events\ResourceWasCreated;
use Resource\Events\ResourceWasDeleted;
use Resource\Events\ResourceWasUpdated;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;

use DB;

use Config;

use File;


class StorePhotoService extends ResourceService
{
    /**
     * @var $dispatcher
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
     * @return StorePhotoRepository
     */
    public function repository()
    {
        return new StorePhotoRepository();
    }

    /**
     * Creates a new store photo record
     * 
     * @param  $storeId
     * @param  $data
     * @return mixed
     */
    public function save($storeId, $request)
    {
        //load directory constants
        $DIRECTORIES = Config::get('constants.directories');

        $data['store_id'] = $storeId;

        DB::beginTransaction();

            foreach ($request->files as $file) {
                foreach ($file as $key) {
                    //get the image and create a new name
                    $photoName = md5(uniqid(mt_rand(), true)) . '.' . $key->getClientOriginalExtension();

                    //create the directory if it doesn't exist
                    if(!File::exists($DIRECTORIES['STORE_PHOTO_FOLDER_PATH'])) {
                        File::makeDirectory($DIRECTORIES['STORE_PHOTO_FOLDER_PATH'], 0775, true);
                    }

                    //move the photo
                    $key->move($DIRECTORIES['STORE_PHOTO_FOLDER_PATH'] . '/', $photoName);
                    //prepare the data
                    $data['photo'] = $DIRECTORIES['STORE_PHOTO_FOLDER'] . '/' . $photoName;

                    $result = $this->repository->create($data);
                    $this->dispatcher->fire(new ResourceWasCreated($result));
                }
            }


        DB::commit();

        return $result;
    }

    /**
     * Updates a store photo record
     * 
     * @param  $storeId
     * @param  $data
     * @return mixed
     */
    public function revise($id, $request)
    {
        //load directory constants
        $DIRECTORIES = Config::get('constants.directories');

        if(!empty($request->file('photo'))) {
            foreach ($request->file('photo') as $key) {

                //get the image and create a new name
                $photoName = md5(uniqid(mt_rand(), true)) . '.' . $key->getClientOriginalExtension();

                if(File::exists($DIRECTORIES['STORE_PHOTO_FOLDER_PATH'])) {
                    //move the image
                    $key->move($DIRECTORIES['STORE_PHOTO_FOLDER_PATH'] . '/', $photoName);

                    //prepare the data
                    $data['photo'] = $DIRECTORIES['STORE_PHOTO_FOLDER'] . '/' . $photoName;
                }

                // delete old image
                $oldPhoto = $this->repository->find($id);
                File::delete(public_path() . $oldPhoto['photo']);

                $result = $this->repository->update($data, $id);
                $this->dispatcher->fire(new ResourceWasUpdated($result));
            }

            return $result;
        }
    }

    /**
     * Delete Store Photo
     * 
     * @param  $id
     * @return mixed
     */
    public function deletePhoto($id)
    {
        // delete old image
        $oldPhoto = $this->repository->find($id);
        File::delete(public_path() . $oldPhoto['photo']);

        $this->repository->delete($id);
    }

    /**
     * Get Photos by storeId
     * 
     * @param  $storeId
     * @return mixed
     */
    public function getPhotos($storeId)
    {
        return $this->repository->findByAttribute('store_id', $storeId);
    }
}
