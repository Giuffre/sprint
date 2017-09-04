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
    const PATTERN_NAME = '/\[(\w+)\]/';
    const PATTERN_TYPE = '/%[\w]+/';

    /**
     * @var string
     */
    private $match;

    /**
     * NamedParameter constructor.
     * @param string $match
     */
    public function __construct($match)
    {
        $this->match = $match;
    }

    /**
     * @return string
     * @throws MalformedName
     */
    public function extractName(): string
    {
        $matches = [];
        preg_match(self::PATTERN_NAME, $this->match, $matches);
        if (!array_key_exists(1, $matches) || 0 >= count($matches)) {
            throw MalformedName::fromMatch($this->match);
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
        preg_match(self::PATTERN_TYPE, $this->match, $matches);
        if (!array_key_exists(0, $matches) || 0 >= count($matches)) {
            throw MalformedType::fromMatch($this->match);
        }

        return $matches[0];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->match;
    }
}
