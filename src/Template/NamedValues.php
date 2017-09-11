<?php
declare(strict_types=1);

namespace Giuffre\Sprint\Template;

use Giuffre\Sprint\Error\MissingValues;

/**
 * Class NamedValues
 * @package Giuffre\Sprint\Template
 */
class NamedValues extends \ArrayObject
{
    /**
     * NamedValues constructor.
     * @param array $valueMaps
     */
    public function __construct($valueMaps)
    {
        $namedValues = [];
        foreach ($valueMaps as $values) {
            foreach ($values as $name => $value) {
                $namedValues[$name] = $value;
            }
        }

        parent::__construct($namedValues);
    }

    /**
     * @param string $name
     * @return mixed
     * @throws MissingValues
     */
    public function getValue(string $name)
    {
        if (!array_key_exists($name, $this)) {
            throw MissingValues::forParameters($name);
        }

        return $this[$name];
    }
}
