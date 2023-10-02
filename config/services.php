<?php

use Component\AppCore\Container;
use Component\Database\Drivers\Driver;
use Component\Database\Drivers\MysqlConfig;

return function (Container $container) {

    $container->set(Driver::class, MysqlConfig::class);
};