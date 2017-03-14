<?php

namespace Omnipay\PayPalPlus;

use Omnipay\PayPal\RestGateway;
use Omnipay\PayPalPlus\Message\IframeRequest;
use Omnipay\PayPalPlus\Message\IframeResponse;
use Omnipay\PayPalPlus\Message\RestPurchaseRequest;

/**
 * PayPal Plus Gateway.
 *
 * @link https://www.paypalobjects.com/webstatic/de_DE/downloads/PayPal-PLUS-IntegrationGuide.pdf
 */
class Gateway extends RestGateway
{
    /**
     * {@inheritdoc}
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest(RestPurchaseRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return IframeResponse
     */
    public function createIframe(array $parameters)
    {
        $response = new IframeResponse($parameters);
        $response->setSandbox($this->parameters->getBoolean('testMode'));
        return $response;
    }
}
