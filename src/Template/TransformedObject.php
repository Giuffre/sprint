<?php

declare(strict_types=1);

namespace Giuffre\Sprint\Template;

/**
 * Class TransformedObject
 * @package Giuffre\Sprint\Template
 */
class TransformedObject
{
    /**
     * @var string
     */
    private $template;

    /**
     * @var array|mixed[]
     */
    private $values;

    /**
     * TransformedObject constructor.
     * @param string $template
     * @param array|mixed[] $values
     */
    public function __construct(string $template, array $values)
    {
        $this->template = $template;
        $this->values = $values;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @return array|mixed[]
     */
    public function getValues(): array
    {
        return $this->values;
    }
}
