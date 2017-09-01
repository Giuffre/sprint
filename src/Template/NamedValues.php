<?php
/**
 * Created by PhpStorm.
 * User: angelogiuffredi
 * Date: 01/09/2017
 * Time: 15:56
 */

namespace Giuffre\Sprint\Template;

/**
 * Class NamedValues
 * @package Giuffre\Sprint\Template
 */
class NamedValues extends \ArrayObject
{
    /**
     * NamedValues constructor.
     * @param array $namedValues
     */
    public function __construct($namedValues = [])
    {
        $formattedNamedValues = [];
        foreach ($namedValues as $values) {
            foreach ($values as $name => $value) {
                $formattedNamedValues[$name] = $value;
            }
        }

        parent::__construct($formattedNamedValues);
    }
}
