<?php

namespace Froepstorf\Stakenotification\UnitTest\Domain;

use Froepstorf\Stakenotification\Domain\ChatId;
use PHPUnit\Framework\TestCase;

/** @covers \Froepstorf\Stakenotification\Domain\ChatId */
class ChatIdTest extends TestCase
{
	private const CHAT_ID = '123456';
	
	public function testCanChatIdAsString()
	{
		$chatId = new ChatId(self::CHAT_ID);
		
		$this->assertSame(self::CHAT_ID, $chatId->asString());
	}
}
