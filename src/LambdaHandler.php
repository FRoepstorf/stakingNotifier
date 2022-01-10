<?php
declare(strict_types=1);
namespace Froepstorf\Stakenotification;

use Bref\Context\Context;
use Bref\Event\EventBridge\EventBridgeEvent;
use Bref\Event\EventBridge\EventBridgeHandler;
use Froepstorf\Stakenotification\Service\LockedStakingService;

class LambdaHandler extends EventBridgeHandler
{
	public function __construct(private LockedStakingService $lockedStakingService)
	{
	}

	public function handleEventBridge(EventBridgeEvent $event, Context $context): void
	{
		$this->lockedStakingService->checkStaking();
	}
}
