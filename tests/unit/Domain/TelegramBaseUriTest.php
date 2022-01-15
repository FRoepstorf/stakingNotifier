<?php

namespace Froepstorf\Stakenotification\UnitTest\Domain;

use Froepstorf\Stakenotification\Domain\TelegramBaseUri;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriInterface;

class TelegramBaseUriTest extends TestCase
{
	private const BASE_URI = 'https://mocked.telegram.api';

	private TelegramBaseUri $telegramBaseUri;

	protected function setUp(): void
	{
		$this->telegramBaseUri = new TelegramBaseUri(self::BASE_URI);
	}

	public function testCanGetAsUri()
	{
		$this->assertInstanceOf(UriInterface::class, $this->telegramBaseUri->asUri());
	}

	public function testValidatesThatUriIsEqual()
	{
		$this->assertSame(self::BASE_URI, $this->telegramBaseUri->asUri()->__toString());
	}
}
