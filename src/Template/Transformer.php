<?php

declare(strict_types=1);

namespace Giuffre\Sprint\Template;

use Giuffre\Sprint\Error\DuplicateParametersFound;
use Giuffre\Sprint\Error\NamedParametersMismatch;

/**
 * Class Transformer
 * @package Giuffre\Sprint\Template
 */
class Transformer implements TransformerInterface
{
    const PATTERN = '/(%)([\w]+)\[(\w+)\]/';

    /**
     * @var NamedValues
     */
    private $namedValues;

    /**
     * @var string
     */
    private $originalTemplate;

    /**
     * Transformer constructor.
     * @param Template $originalTemplate
     * @param NamedValues $namedValues
     */
    public function __construct(
        Template $originalTemplate,
        NamedValues $namedValues
    ) {
        $this->originalTemplate = $originalTemplate;
        $this->namedValues = $namedValues;
    }

    /**
     * @return TransformedObject
     * @throws DuplicateParametersFound
     * @throws NamedParametersMismatch
     */
    public function transform(): TransformedObject
    {
        $namedParameters = [];
        $template = (string)$this->originalTemplate;
        preg_match_all(self::PATTERN, $template, $namedParameters);

        $namedParameters = new NamedParameters($namedParameters[0]);
        if ($namedParameters->parameterCount() !== $this->namedValues->valueCount()) {
            throw new NamedParametersMismatch('Placeholders and values count must be the same');
        }

        $values = [];
        foreach ($namedParameters as $match) {
            $values[] = $this->getValue($match->extractName());

            $template = str_replace(
                (string)$match,
                $match->extractType(),
                $template
            );
        }

        return new TransformedObject(
            new Template($template),
            $values
        );
    }

    /**
     * @param string $name
     * @return mixed
     */
    private function getValue(string $name)
    {
        return $this->namedValues[$name];
    }
}
