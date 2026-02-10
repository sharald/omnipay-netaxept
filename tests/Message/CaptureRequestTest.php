<?php

namespace Omnipay\Netaxept\Message;

use Omnipay\Tests\TestCase;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * @author Antonio Peric-Mazar <antonio@locastic.com>
 */
class CaptureRequestTest extends TestCase
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    private $httpRequest;

    /**
     * @var \Omnipay\Netaxept\Message\CaptureRequest
     */
    private $request;

    public function setUp(): void
    {
        $client = $this->getHttpClient();
        $this->httpRequest = $this->getHttpRequest();

        $this->request = new CaptureRequest($client, $this->httpRequest);
    }

    public function testGetDataThrowsExceptionWithoutTransactionAmount()
    {
        $this->expectException(InvalidResponseException::class);

        $this->httpRequest->query->set('transactionId', 'TRANS-123');

        $this->request->getData();
    }

    public function testGetDataThrowsExceptionWithoutTransactionId()
    {
        $this->expectException(InvalidResponseException::class);

        $this->httpRequest->query->set('transactionAmount', 'ABC-123');

        $this->request->getData();
    }
}
