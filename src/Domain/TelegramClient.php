<?php
declare(strict_types=1);

namespace Froepstorf\Stakenotification\Domain;

use GuzzleHttp\ClientInterface;

final class TelegramClient
{
	public function __construct(
		private ClientInterface $guzzleClient,
		private TelegramBaseUri $telegramBaseUri,
		private ChatId $chatId
	)
	{
	}

	public function sendMessage(string $message): void
	{
		$this->guzzleClient->request(
			'GET',
			sprintf('%s/sendmessage?chat_id=%s&text=%s',
				$this->telegramBaseUri->asUri()->__toString(),
				$this->chatId->asString(),
				$message
			)
		);
	}
}
