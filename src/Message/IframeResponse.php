<?php

namespace Omnipay\PayPalPlus\Message;

/**
 * PayPalPlus Iframe Response
 */
class IframeResponse
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     * @var boolean
     */
    protected $sandbox;

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
        $this->setSandbox(false);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array_merge([
            'placeholder' => 'ppplus',
            'country' => 'DE',
        ], $this->parameters, [
            'mode' => $this->isSandbox() ? 'sandbox' : 'live',
        ]);
    }

    /**
     * @return string
     */
    public function getBody()
    {
        $template = file_get_contents(__DIR__ . '/../Resources/iframe.html');
        return str_replace('__JSON__',
            json_encode($this->getData(), JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS), $template);
    }

    public function render()
    {
        return '<!DOCTYPE html><html><body style="margin: 0; padding: 0;">' . $this->getBody() . '</body></html>';
    }

    /**
     * @return boolean
     */
    public function isSandbox()
    {
        return $this->sandbox;
    }

    /**
     * @param boolean $sandbox
     */
    public function setSandbox($sandbox)
    {
        $this->sandbox = $sandbox;
    }
}
