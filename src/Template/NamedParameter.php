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
    const PATTERN_NAME = '/\[(\w+)\]$/';
    const PATTERN_TYPE = '/^%\w+/';

    /**
     * @var string
     */
    private $match;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * NamedParameter constructor.
     * @param string $match
     * @throws MalformedName
     * @throws MalformedType
     */
    public function __construct(string $match)
    {
        $this->match = $match;
        $this->extractName();
        $this->extractType();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->match;
    }

    /**
     * @throws MalformedName
     */
    private function extractName()
    {
        $matches = [];
        preg_match(self::PATTERN_NAME, $this->match, $matches);
        if (!array_key_exists(1, $matches) || 0 >= count($matches)) {
            throw MalformedName::fromMatch($this->match);
        }

        $this->name = $matches[1];
    }

    /**
     * @throws MalformedType
     */
    private function extractType()
    {
        $matches = [];
        preg_match(self::PATTERN_TYPE, $this->match, $matches);
        if (!array_key_exists(0, $matches) || 0 >= count($matches)) {
            throw MalformedType::fromMatch($this->match);
        }

        $this->type = $matches[0];
    }
}
