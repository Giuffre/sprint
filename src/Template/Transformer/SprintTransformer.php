<?php
declare(strict_types=1);

namespace Giuffre\Sprint\Template\Transformer;

use Giuffre\Sprint\Error\MalformedName;
use Giuffre\Sprint\Error\MalformedType;
use Giuffre\Sprint\Error\MissingValues;
use Giuffre\Sprint\Template\NamedParameter;
use Giuffre\Sprint\Template\Template;
use Giuffre\Sprint\Template\TransformedObject;

/**
 * Class Transformer
 * @package Giuffre\Sprint\Template
 */
class SprintTransformer extends AbstractTransformer
{
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
