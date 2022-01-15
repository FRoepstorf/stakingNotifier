<?php
declare(strict_types=1);

namespace Froepstorf\Stakenotification\Domain;

use Froepstorf\Stakenotification\Exception\EnvironmentVariableNotFoundException;

final class EnvironmentReader
{
	public function getEnvironment(): string
	{
		return $this->readFromEnvironment('ENVIRONMENT');
	}

	public function getTelegramBaseUrl(): string
	{
		return $this->readFromEnvironment('TELEGRAM_BASE_URL');
	}

	public function getChatId(): string
	{
		return $this->readFromEnvironment('CHAT_ID');
	}

	private function readFromEnvironment(string $key): string
	{
		$envVariable = getenv($key);
		if ($envVariable === false) {
			throw new EnvironmentVariableNotFoundException(
				sprintf('The requested environment variable "%s" was not found', $key)
			);
		}

		return $envVariable;
	}
}
