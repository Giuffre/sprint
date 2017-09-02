<?php
declare(strict_types=1);

namespace Giuffre\Sprint\Template;

/**
 * Class Template
 * @package Giuffre\Sprint\Template
 */
class Template
{
    /**
     * @var string
     */
    private $originalTemplate;

    /**
     * Template constructor.
     * @param string $originalTemplate
     */
    public function __construct($originalTemplate)
    {
        $this->originalTemplate = $originalTemplate;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->originalTemplate;
    }
}
