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
     * @var array
     */
    private $namedParameters;

    /**
     * NamedParameters constructor.
     * @param array $namedParameters
     */
    public function __construct(array $namedParameters)
    {
        $this->namedParameters = $namedParameters;
        $input = [];
        foreach ($this->namedParameters as $namedParameter) {
            $input[] = new NamedParameter($namedParameter);
        }

        parent::__construct($input);
    }

    /**
     * @return bool
     */
    public function hasDupes(): bool
    {
        return !(count($this->namedParameters) === count(array_unique($this->namedParameters)));
    }
}
