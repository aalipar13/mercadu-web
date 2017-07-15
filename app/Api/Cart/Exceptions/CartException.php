<?php namespace App\Api\Cart\Exceptions;


use Symfony\Component\HttpKernel\Exception\HttpException;


class CartException extends HttpException
{
    /**
     * const for unable to fetch products
     */
    const UNABLE_FETCH_PRODUCTS = 'There are no products yet, sorry!';

    /**
     * @param string $errorType
     */
    public function __construct($errorType)
    {
        $statusCode = 422;
        switch($errorType)
        {
            case self::UNABLE_FETCH_PRODUCTS:
                $statusCode = 422;
                break;
        }

        parent::__construct($statusCode, $errorType);
    }
}