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
     * @var NamedParameter[]
     */
    private $namedParameters = [];

    /**
     * NamedParameters constructor.
     * @param array $namedParameters
     */
    public function __construct(array $namedParameters)
    {
        foreach ($namedParameters as $namedParameter) {
            $this->namedParameters[] = new NamedParameter($namedParameter);
        }

        parent::__construct($this->namedParameters);
    }

    /**
     * @return int
     */
    public function parameterCount(): int
    {
        $names = array_map(function (NamedParameter $parameter) {
            return $parameter->extractName();
        }, $this->namedParameters);

        return count(array_unique($names));
    }
}
