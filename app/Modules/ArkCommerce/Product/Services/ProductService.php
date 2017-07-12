<?php namespace App\Modules\ArkCommerce\Product\Services;


use Resource\Services\ResourceService;

use App\Modules\ArkCommerce\Product\Repositories\ProductRepository;

use App\Modules\ArkCommerce\Store\Services\StoreService;

use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;

use Config;

use File;


class ProductService extends ResourceService
{
    /**
     * @return ProductRepository
     */
    public function repository()
    {
        return new ProductRepository();
    }

    /**
     * @return StoreService
     */
    public function storeService()
    {
        return new StoreService();
    }

    /**
     * Find the product using the id
     * 
     * @param  $id
     * @return mixed
     */
    public function findProductById($id)
    {
    	return $this->repository()->findById($id);
    }

    /**
     * Create a new product record
     * 
     * @param  $request
     * @return mixed
     */
    public function create($request)
    {
        $data = $request->all();

        // Remove the comma for regular_price and sale_price if it has one
        if( strpos($data['regular_price'], ',') !== false )
        {
            $data['regular_price'] = str_replace(',', '', $data['regular_price']);
        }

        if( strpos($data['sale_price'], ',') !== false )
        {
            $data['sale_price'] = str_replace(',', '', $data['sale_price']);
        }

        //load directory constants
        $DIRECTORIES = Config::get('constants.directories');

        //get the image and create a new name
        $photoName = md5(uniqid(mt_rand(), true)) . '.' . $request->file('photo')->getClientOriginalExtension();

        //load directory constants
        $DIRECTORIES = Config::get('constants.directories');

        //create the directory if it doesn't exist
        if(!File::exists($DIRECTORIES['PRODUCT_PHOTO_FOLDER_PATH'])) {
            File::makeDirectory($DIRECTORIES['PRODUCT_PHOTO_FOLDER_PATH'], 0775, true);
        }
        
        //move the photo
        $request->file('photo')->move($DIRECTORIES['PRODUCT_PHOTO_FOLDER_PATH'] . '/', $photoName);
            
        //prepare the data
        $data['photo'] = $DIRECTORIES['PRODUCT_PHOTO_FOLDER'] . '/' . $photoName;

        $productResult = $this->repository()->create($data);

        return $productResult;

    }

    /**
     * Updates a product record by id
     * 
     * @param  $id
     * @param  $request
     * @return mixed
     */
    public function revise($id, $request)
    {
        $data = $request->all();

        // Remove the comma for regular_price and sale_price if it has one
        if( strpos($data['regular_price'], ',') !== false )
        {
            $data['regular_price'] = str_replace(',', '', $data['regular_price']);
        }

        if( strpos($data['sale_price'], ',') !== false )
        {
            $data['sale_price'] = str_replace(',', '', $data['sale_price']);
        }

        //load directory constants
        $DIRECTORIES = Config::get('constants.directories');
    
        if($request->file('photo')) {

            //get the image and create a new name
            $photoName = md5(uniqid(mt_rand(), true)) . '.' . $request->file('photo')->getClientOriginalExtension();
            
            if(File::exists($DIRECTORIES['PRODUCT_PHOTO_FOLDER_PATH'])) {
                //move the image
                $request->file('photo')->move($DIRECTORIES['PRODUCT_PHOTO_FOLDER_PATH'] . '/', $photoName);
                
                //prepare the data
                $data['photo'] = $DIRECTORIES['PRODUCT_PHOTO_FOLDER'] . '/' . $photoName;
            }
        }

        // delete old image
        $oldPhoto = $this->repository->find($id);
        File::delete(public_path() . $oldPhoto['photo']);

        $productResult = $this->repository()->update($data, $id);

        return $productResult;
    }

    /**
     * Get All Product With Store
     * 
     * @return mixed
     */
    public function getAllWithStore()
    {
        return $this->repository()->getAllProductAndStore();
    }

    /**
     * Get Product With Store by id
     * 
     * @param  $id
     * @return mixed
     */
    public function getProductWithStore($id)
    {
        return $this->repository()->getProductAndStore($id);
    }

    /**
     * Get Products for dropdown
     * 
     * @return mixed
     */
    public function getProductsForDropdown()
    {
        return $this->repository()->lists('name', 'id');
    }

        /**
     * Get all products with pagination
     * 
     * @param  $records
     * @return mixed
     */
    public function allProductsWithPagination($records)
    {
        $products =  $this->repository->paginate($records);

        if(count($products['data']) > 0)
        {
            //get the current route url
            $url = url(Route::getFacadeRoot()->current()->uri()) . '?records='.$records;

            //create the pagination manually
            $paginate = new LengthAwarePaginator($products['data'], $products['total'], $products['per_page'], $products['current_page'], array('path' => $url));

            // Get store and add in products array
            foreach ($products['data'] as $key => $product) {
                $store = $this->storeService()->getStoreName($product['store_id']);

                $products['data'][$key]['store_name'] = $store['name'];
            }

            $productList = $products['data'];
        }
        else
        {
            $productList = [];
            $paginate = [];
        }

        return [
                'productList' => $productList,
                'paginate' => $paginate
               ];
    }

    /**
     * Delete Product With Photo
     *
     * @param  $id
     * @return mixed
     */
    public function deleteProductWithPhoto($id)
    {
        // delete old image
        $oldPhoto = $this->repository->find($id);
        File::delete(public_path() . $oldPhoto['photo']);

        return $this->repository->delete($id);
    }
}