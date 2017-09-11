<?php
declare(strict_types=1);

namespace Giuffre\Sprint\Template;

use Giuffre\Sprint\Error\MalformedName;
use Giuffre\Sprint\Error\MalformedType;
use Giuffre\Sprint\Error\MissingValues;

/**
 * Class Transformer
 * @package Giuffre\Sprint\Template
 */
class Transformer implements TransformerInterface
{
    /**
     * @var Template
     */
    private $originalTemplate;

    /**
     * @var NamedValues
     */
    private $namedValues;

    /**
     * @var TransformerHelper
     */
    private $transformerHelper;

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
        $this->transformerHelper = new TransformerHelper($originalTemplate);
    }

    /**
     * @return TransformedObject
     * @throws MalformedName
     * @throws MalformedType
     * @throws MissingValues
     */
    public function __invoke(): TransformedObject
    {
        /** @var NamedParameter[] $namedParameters */
        $namedParameters = $this->transformerHelper->extractNamedParameters();

        $template = (string)$this->originalTemplate;
        $values = [];
        foreach ($namedParameters as $namedParameter) {
            $template = $this->transformerHelper->stripParameterNameFromTemplate($template, $namedParameter);
            $values[] = $this->namedValues->getValue($namedParameter->getName());
        }

        return new TransformedObject(
            new Template($template),
            $values
        );
    }

}
