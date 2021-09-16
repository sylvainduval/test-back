<?php

namespace App\Tests\Behat;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Exception;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Webmozart\Assert\Assert;

class ApiContext implements Context
{

	use SharedContextTrait;

	/**
	 * @var HttpClientInterface
	 */
	private $httpClient;

	private $httpClientOptions = [];

	/**
	 * @var ResponseInterface
	 */
	private $httpResponse;


	public function __construct(Client $kernelClient)
	{
		$this->httpClient = $kernelClient;
	}


	/**
	 * @When /^j'ajoute l'entête (.*) égale à (.*)$/
	 * @param $header
	 * @param $value
	 */
	public function addHeader($header, $value)
	{
		$this->httpClientOptions['headers'][$header] = $value;
	}

	/**
	 * @When /^j'envoie une requête HTTP (.+) sur ([\S]+)$/
	 * @param $method
	 * @param $url
	 *
	 * @throws TransportExceptionInterface
	 */
	public function httpRequest($method, $url)
	{
		$this->httpResponse = $this->httpClient->request($method, $url, $this->httpClientOptions);
	}

	/**
	 * @When /^j'envoie une requête HTTP (.+) sur (.+) avec le contenu :$/
	 * @param $method
	 * @param $url
	 * @param PyStringNode $body
	 *
	 * @throws TransportExceptionInterface
	 * @throws Exception
	 */
	public function httpRequestWithBody($method, $url, PyStringNode $body)
	{
		$url = $this->sharingContext->renderTwigTemplate($url);
		var_dump($url);exit();
		$this->httpClientOptions['body'] = $this->sharingContext->renderTwigTemplate($body->getRaw());
		$this->httpResponse = $this->httpClient->request($method, $url, $this->httpClientOptions);
	}

	/**
	 * @When le code HTTP de la réponse doit être :statusCode
	 * @param $statusCode
	 *
	 * @throws TransportExceptionInterface
	 */
	public function leCodeHttpDeLaReponseDoitEtre($statusCode)
	{
		Assert::same($this->httpResponse->getStatusCode(), $statusCode);
	}
}
