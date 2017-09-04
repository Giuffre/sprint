<?php
declare(strict_types=1);

namespace Giuffre\Sprint\Template;

use Giuffre\Sprint\Error\MissingValues;

/**
 * Class Transformer
 * @package Giuffre\Sprint\Template
 */
class Transformer implements TransformerInterface
{
    const PATTERN = '/%[\w]+\[\w+\]/';

    /**
     * @var string
     */
    private $originalTemplate;

    /**
     * @var NamedValues
     */
    private $namedValues;

    /**
     * Transformer constructor.
     * @param Template $originalTemplate
     * @param NamedValues $namedValues
     */
    public function __construct(
        Template $originalTemplate,
        NamedValues $namedValues
    )
    {
        $this->originalTemplate = $originalTemplate;
        $this->namedValues = $namedValues;
    }

    /**
     * @return TransformedObject
     * @throws MissingValues
     */
    public function transform(): TransformedObject
    {
        $namedParameters = $this->extractNamedParameters();

        $template = (string)$this->originalTemplate;
        $values = [];
        /** @var NamedParameter $namedParameter */
        foreach ($namedParameters as $namedParameter) {
            $template = self::stripParameterNameFromTemplate($template, $namedParameter);
            $values[] = $this->namedValues->getValue($namedParameter->extractName());
        }

        return new TransformedObject(
            new Template($template),
            $values
        );
    }

    /**
     * @return NamedParameters
     */
    private function extractNamedParameters(): NamedParameters
    {
        $parameters = [];

        preg_match_all(
            self::PATTERN,
            (string)$this->originalTemplate,
            $parameters
        );

        return new NamedParameters($parameters[0]);
    }

    /**
     * @param string $template
     * @param NamedParameter $parameter
     * @return string
     */
    private static function stripParameterNameFromTemplate(string $template, NamedParameter $parameter): string
    {
        // This should be quicker than str_replace().
        return implode(
            $parameter->extractType(),
            explode((string)$parameter, $template)
        );
    }
}
