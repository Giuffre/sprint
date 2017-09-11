<?php
/**
 * Created by PhpStorm.
 * User: angelogiuffredi
 * Date: 11/09/2017
 * Time: 14:53
 */

namespace Giuffre\Sprint\Template\Transformer;


use Giuffre\Sprint\Template\NamedParameter;
use Giuffre\Sprint\Template\Template;
use Giuffre\Sprint\Template\TransformedObject;

class TransparentTransformer extends AbstractTransformer
{
    public function __invoke(): TransformedObject
    {
        /** @var NamedParameter[] $namedParameters */
        $namedParameters = $this->transformerHelper->extractNamedParameters();

        $template = (string)$this->originalTemplate;
        $values = [];
        foreach ($namedParameters as $namedParameter) {
            $values[] = $this->namedValues->getValue(
                $namedParameter->getName()
            );
        }

        return new TransformedObject(
            new Template($template),
            $values
        );
    }

}
