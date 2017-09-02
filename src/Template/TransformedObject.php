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
     * @var Template
     */
    private $template;

    /**
     * @var array|mixed[]
     */
    private $values;

    /**
     * TransformedObject constructor.
     * @param Template $template
     * @param array|mixed[] $values
     */
    public function __construct(Template $template, array $values)
    {
        $this->template = $template;
        $this->values = $values;
    }

    /**
     * @return Template
     */
    public function getTemplate(): Template
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
