<?php
declare(strict_types=1);

namespace Froepstorf\Stakenotification\Service;

use Froepstorf\Stakenotification\Domain\TelegramClient;

class TelegramNotificationService implements NotificationService
{
	public function __construct(private TelegramClient $telegramClient)
	{
	}

	public function notify(string $message): void
	{
		$this->telegramClient->sendMessage($message);
	}
}
