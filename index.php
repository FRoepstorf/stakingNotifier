<?php

namespace Froepstorf\Stakenotification;

use Froepstorf\Stakenotification\Domain\EnvironmentReader;

require_once __DIR__ . '/vendor/autoload.php';

return ApplicationBuilder::build(new EnvironmentReader());

