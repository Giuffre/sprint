<?php
declare(strict_types=1);

namespace Giuffre\Sprint\Template;

/**
 * Class NamedValues
 * @package Giuffre\Sprint\Template
 */
class NamedValues extends \ArrayObject
{
    /**
     * NamedValues constructor.
     * @param array $namedValues
     */
    public function __construct($namedValues = [])
    {
        $formattedNamedValues = [];
        foreach ($namedValues as $values) {
            foreach ($values as $name => $value) {
                $formattedNamedValues[$name] = $value;
            }
        }

        parent::__construct($formattedNamedValues);
    }

    /**
     * @return int
     */
    public function valueCount(): int
    {
        return $this->count();
    }
}
