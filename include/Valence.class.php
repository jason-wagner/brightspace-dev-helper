<?php

use GuzzleHttp\Client;

class Valence
{
	private $httpclient, $handler;
	public const VERSION_LP = 1.26;

	public function __construct()
	{
		$authContextFactory = new D2LAppContextFactory();
		$authContext = $authContextFactory->createSecurityContext($_ENV['D2L_VALENCE_APP_ID'], $_ENV['D2L_VALENCE_APP_KEY']);
		$hostSpec = new D2LHostSpec($_ENV['D2L_VALENCE_HOST'], $_ENV['D2L_VALENCE_PORT'], $_ENV['D2L_VALENCE_SCHEME']);
		$this->handler = $authContext->createUserContextFromHostSpec($hostSpec, $_ENV['D2L_VALENCE_USER_ID'], $_ENV['D2L_VALENCE_USER_KEY']);
		$this->httpclient = new Client(['base_uri' => "{$_ENV['D2L_VALENCE_SCHEME']}://{$_ENV['D2L_VALENCE_HOST']}'/"]);
	}

	public function apirequest(string $route, string $method = 'GET', array $data = null)
	{
		$uri = $this->handler->createAuthenticatedUri(str_replace(' ', '%20', $route), $method);
		$response = $this->httpclient->request($method, $uri, ['json' => $data]);
		$responseCode = $response->getStatusCode();
		return json_decode($response->getBody());
	}

	public function whoami()
	{
		return $this->apirequest("/d2l/api/lp/".Valence::VERSION_LP."/users/whoami");
	}

	public function versions()
	{
		return $this->apirequest("/d2l/api/versions/");
	}
}
