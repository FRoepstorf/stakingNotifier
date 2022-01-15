<?php
declare(strict_types=1);
namespace Froepstorf\Stakenotification\Domain;

final class ChatId
{
	public function __construct(private string $chatId)
	{
	}

	public function asString(): string
	{
		return $this->chatId;
	}
}
