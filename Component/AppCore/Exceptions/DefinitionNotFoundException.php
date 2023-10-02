<?php

namespace Component\AppCore\Exceptions;

use Psr\Container\NotFoundExceptionInterface;

class DefinitionNotFoundException extends \Exception implements NotFoundExceptionInterface
{

}