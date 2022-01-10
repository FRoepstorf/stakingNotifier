<?php
declare(strict_types=1);

namespace Froepstorf\Stakenotification\Domain;

use Froepstorf\Stakenotification\Exception\EnvironmentVariableNotFoundException;

class EnvironmentReader
{
	public function getEnvironment(): string
	{
		return $this->readFromEnvironment('ENVIRONMENT');
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
