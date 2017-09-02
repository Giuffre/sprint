<?php

declare(strict_types=1);

namespace Giuffre\Sprint\Template;

use Giuffre\Sprint\Error\MalformedName;
use Giuffre\Sprint\Error\MalformedType;

/**
 * Class NamedParameter
 * @package Giuffre\Sprint\Template
 */
class NamedParameter
{
    /**
     * @var string
     */
    private $fromMatch;

    /**
     * NamedParameter constructor.
     * @param string $fromMatch
     */
    public function __construct($fromMatch)
    {
        $this->fromMatch = $fromMatch;
    }

    /**
     * @return string
     * @throws MalformedName
     */
    public function extractName(): string
    {
        $matches = [];
        preg_match('/\[(\w+)\]/', $this->fromMatch, $matches);
        if (!array_key_exists(1, $matches) || 0 >= count($matches)) {
            throw new MalformedName(
                sprintf('Could not extract a name from this string: %s', $this->fromMatch)
            );
        }

        return $matches[1];
    }

    /**
     * @return string
     * @throws MalformedType
     */
    public function extractType(): string
    {
        $matches = [];
        preg_match('/(%)([\w]+)/', $this->fromMatch, $matches);
        if (!array_key_exists(0, $matches) || 0 >= count($matches)) {
            throw new MalformedType(
                sprintf('Could not extract a type from this string: %s', $this->fromMatch)
            );
        }

        return $matches[0];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->fromMatch;
    }
}
