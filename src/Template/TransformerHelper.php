<?php
/**
 * Created by PhpStorm.
 * User: angelogiuffredi
 * Date: 9/10/17
 * Time: 10:51 PM
 */

namespace Giuffre\Sprint\Template;


use Giuffre\Sprint\Error\MalformedName;
use Giuffre\Sprint\Error\MalformedType;

class TransformerHelper
{
    const PATTERN = '/%[\w]+\[\w+\]/';

    /**
     * @var Template
     */
    private $originalTemplate;

    /**
     * TransformerHelper constructor.
     * @param Template $originalTemplate
     */
    public function __construct(Template $originalTemplate)
    {
        $this->originalTemplate = $originalTemplate;
    }

    /**
     * @return NamedParameters
     * @throws MalformedName
     * @throws MalformedType
     */
    public function extractNamedParameters(): NamedParameters
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
    public function stripParameterNameFromTemplate(string $template, NamedParameter $parameter): string
    {
        // This should be quicker than str_replace().
        return implode(
            $parameter->getType(),
            explode((string)$parameter, $template)
        );
    }
}