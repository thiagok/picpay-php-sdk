<?php

namespace Picpay;

/**
 * Class Seller
 *
 * @package Picpay
 */
class Seller implements \JsonSerializable
{
    /** @var string $apiUrl */
    private $apiUrl;

    /** @var string $picpayToken */
    private $picpayToken;

    /** @var string $sellerToken */
    private $sellerToken;

    /**
     * Seller constructor.
     *
     * @param string $apiUrl
     * @param string $picpayToken
     * @param string $sellerToken
     */
    public function __construct($picpayToken, $sellerToken, $apiUrl = null)
    {
        $this->picpayToken = $picpayToken;
        $this->sellerToken = $sellerToken;

        $this->apiUrl = $apiUrl ? : 'https://appws.picpay.com/ecommerce/public/';
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


    /**
     * Get the value of apiUrl
     *
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * Get the value of picpayToken
     *
     * @return string
     */
    public function getPicpayToken()
    {
        return $this->picpayToken;
    }

    /**
     * Get the value of sellerToken
     *
     * @return string
     */
    public function getSellerToken()
    {
        return $this->sellerToken;
    }
}
