<?php

namespace Froepstorf\Stakenotification\Domain;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

final class TelegramBaseUri
{
	private UriInterface $uri;

	public function __construct(string $baseUrl)
	{
		$this->uri = new Uri($baseUrl);
	}

	public function asUri(): UriInterface
	{
		return $this->uri;
	}
}
