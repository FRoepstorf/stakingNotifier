<?php
namespace Froepstorf\Stakenotification;

use DI\ContainerBuilder;
use Froepstorf\Stakenotification\Domain\Environment\Environment;
use Froepstorf\Stakenotification\Domain\EnvironmentReader;
use Froepstorf\Stakenotification\Service\LockedStakingService;

class ApplicationBuilder
{
	public static function build(EnvironmentReader $environmentReader): LambdaHandler
	{
		$containerBuilder = new ContainerBuilder();
		$environment = Environment::from($environmentReader->getEnvironment());
		$containerBuilder->addDefinitions(__DIR__ . '/../config.php');
		if ($environment->isProd()) {
			$containerBuilder->enableDefinitionCache();
			$containerBuilder->enableCompilation(__DIR__ . '/../var/container');
			// Add to CI
//			$containerBuilder->enableCompilation(__DIR__ . '/var/container');
//			$containerBuilder->writeProxiesToFile(true, __DIR__ . '/var/proxies');
		}
		$container = $containerBuilder->build();

		return new LambdaHandler(
			$container->get(LockedStakingService::class)
		);
	}
}
