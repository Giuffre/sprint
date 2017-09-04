<?php
declare(strict_types=1);

namespace Giuffre\Sprint\Template;

/**
 * Class NamedParameters
 * @package Giuffre\Sprint\Template
 */
class NamedParameters extends \ArrayObject
{
    /**
     * NamedParameters constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $namedParameters = [];
        foreach ($parameters as $parameter) {
            $namedParameters[] = new NamedParameter($parameter);
        }

        parent::__construct($namedParameters);
    }
}
