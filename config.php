<?php

namespace Froepstorf\Stakenotification;

use Froepstorf\Stakenotification\Service\LockedStakingService;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use function DI\create;

return [
	ClientInterface::class => create(Client::class),
	LockedStakingService::class => function (ClientInterface $guzzleClient) {
		return new LockedStakingService($guzzleClient);
	},
];
