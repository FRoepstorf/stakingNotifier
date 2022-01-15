<?php
declare(strict_types=1);

namespace Froepstorf\Stakenotification\Service;

use GuzzleHttp\ClientInterface;

class LockedStakingService
{
	private const GET_LOCKED_STAKING_URL = 'https://www.binance.com/gateway-api/v1/friendly/pos/union?status=ALL&pageSize=100&asset=AXS';

	public function __construct(private ClientInterface $httpClient, private NotificationService $notificationService)
	{
	}

	public function checkStaking(): void
	{
		$response = $this->httpClient->request('GET', self::GET_LOCKED_STAKING_URL);

		$responseJson = $response->getBody()->getContents();
		$decodedResponseJson = json_decode($responseJson, true, JSON_THROW_ON_ERROR);
		foreach ($decodedResponseJson['data'] as $data) {
			foreach ($data['projects'] as $project) {
				if ($project['sellOut'] === true) {
					$this->notificationService->notify(sprintf('Can stake %s', $project['projectId']));
					continue;
				}
				$this->notificationService->notify(sprintf('Can stake %s', $project['projectId']));
			}
		}
	}
}
