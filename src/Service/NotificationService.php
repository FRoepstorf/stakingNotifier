<?php
declare(strict_types=1);

namespace Froepstorf\Stakenotification\Service;

interface NotificationService
{
	public function notify(string $message): void;
}
