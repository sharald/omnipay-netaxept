<?php

namespace Omnipay\Netaxept\Message;

use Omnipay\Tests\TestCase;
use Omnipay\Common\Exception\InvalidResponseException;

class CompletePurchaseRequestTest extends TestCase
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    private $httpRequest;

    /**
     * @var \Omnipay\Netaxept\Message\CompletePurchaseRequest
     */
    private $request;

    public function setUp(): void
    {
        $client = $this->getHttpClient();
        $this->httpRequest = $this->getHttpRequest();

        $this->request = new CompletePurchaseRequest($client, $this->httpRequest);
    }

    public function testGetDataThrowsExceptionWithoutResponseCode()
    {
        $this->expectException(InvalidResponseException::class);

        $this->httpRequest->query->set('transactionId', 'TRANS-123');

        $this->request->getData();
    }

    public function testGetDataThrowsExceptionWithoutTransactionId()
    {
        $this->expectException(InvalidResponseException::class);

        $this->httpRequest->query->set('responseCode', 'ABC-123');

        $this->request->getData();
    }
}
