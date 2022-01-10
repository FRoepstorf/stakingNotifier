<?php
declare(strict_types=1);

namespace Froepstorf\Stakenotification\Service;

use GuzzleHttp\ClientInterface;

class LockedStakingService
{
	private const GET_LOCKED_STAKING_URL = 'https://www.binance.com/gateway-api/v1/friendly/pos/union?status=ALL&pageSize=100&asset=AXS';

	public function __construct(private ClientInterface $httpClient)
	{
	}

	public function checkStaking()
	{
		$response = $this->httpClient->request('GET', self::GET_LOCKED_STAKING_URL);

		$responseJson = $response->getBody()->getContents();
		$decodedResponseJson = json_decode($responseJson, true, JSON_THROW_ON_ERROR);
		foreach ($decodedResponseJson['data'] as $data) {
			foreach ($data['projects'] as $project) {
				if ($project['sellOut'] === true) {
					continue;
				}
			}
			// Can Stake now
			echo sprintf('Can stake %s', $project['projectId']);
		}
	}
}
