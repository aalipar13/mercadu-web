<?php namespace App\Api\OrderDetail\Repositories;


use App\Common\Models\OrderDetail;

use Resource\Repositories\ResourceRepository;


class OrderDetailRepository extends ResourceRepository
{
    /**
     * @return OrderDetail
     */
    public function model()
    {
        return OrderDetail::class;
    }
}