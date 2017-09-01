<?php
/**
 * Created by PhpStorm.
 * User: angelogiuffredi
 * Date: 01/09/2017
 * Time: 12:53
 */

namespace Giuffre\Sprint;

use Giuffre\Sprint\Error\DuplicateParametersFound;
use Giuffre\Sprint\Error\NamedParametersMismatch;
use Giuffre\Sprint\Template\NamedValues;
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
     * @throws DuplicateParametersFound
     * @throws NamedParametersMismatch
     */
    public static function sprint(string $template, array ...$namedValues): string
    {
        $transformedObject = (new Transformer(
            $template,
            new NamedValues($namedValues)
        ))->transform();

        return sprintf(
            $transformedObject->getTemplate(),
            ...$transformedObject->getValues()
        );
    }
}
