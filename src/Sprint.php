<?php
declare(strict_types=1);

namespace Giuffre\Sprint;

use Giuffre\Sprint\Error\MalformedName;
use Giuffre\Sprint\Error\MalformedType;
use Giuffre\Sprint\Error\MissingValues;
use Giuffre\Sprint\Template\NamedValues;
use Giuffre\Sprint\Template\Template;
use Giuffre\Sprint\Template\TransformedObject;
use Giuffre\Sprint\Template\Transformer;

/**
 * Class Sprint
 * @package Giuffre\Sprint
 */
class Sprint
{
    /**
     * @param string $template
     * @param array[] ...$namedValues
     * @return string
     * @throws MalformedName
     * @throws MalformedType
     * @throws MissingValues
     */
    public static function sprint(string $template, array ...$namedValues): string
    {
        /** @var TransformedObject $transformedObject */
        $transformedObject = (new Transformer(
            new Template($template),
            new NamedValues($namedValues)
        ))();

        return sprintf(
            (string)$transformedObject->getTemplate(),
            ...$transformedObject->getValues()
        );
    }
}
