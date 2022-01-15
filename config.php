<?php

namespace Froepstorf\Stakenotification;

use Froepstorf\Stakenotification\Domain\ChatId;
use Froepstorf\Stakenotification\Domain\EnvironmentReader;
use Froepstorf\Stakenotification\Domain\TelegramBaseUri;
use Froepstorf\Stakenotification\Domain\TelegramClient;
use Froepstorf\Stakenotification\Service\LockedStakingService;
use Froepstorf\Stakenotification\Service\NotificationService;
use Froepstorf\Stakenotification\Service\TelegramNotificationService;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use function DI\create;

return [
	ClientInterface::class => create(Client::class),

	LockedStakingService::class => function (ClientInterface $guzzleClient, NotificationService $notificationService) {
		return new LockedStakingService($guzzleClient, $notificationService);
	},

	NotificationService::class => function (TelegramClient $telegramClient) {
		return new TelegramNotificationService($telegramClient);
	},

	TelegramBaseUri::class => function (EnvironmentReader $environmentReader) {
		return new TelegramBaseUri($environmentReader->getTelegramBaseUrl());
	},

	ChatId::class => function (EnvironmentReader $environmentReader) {
		return new ChatId($environmentReader->getChatId());
	},

	TelegramClient::class => function (
		ClientInterface $guzzleClient,
		TelegramBaseUri $telegramBaseUri,
		ChatId $chatId
	) {
		return new TelegramClient(
			$guzzleClient,
			$telegramBaseUri,
			$chatId
		);
	}
];
