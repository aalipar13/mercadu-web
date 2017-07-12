<?php namespace App\Modules\ArkCommerce\StorePhoto\Repositories;


use App\Common\Models\StorePhoto;

use Resource\Repositories\ResourceRepository;


class StorePhotoRepository extends ResourceRepository
{
    /**
     * @return StorePhoto
     */
    public function model()
    {
        return StorePhoto::class;
    }
}