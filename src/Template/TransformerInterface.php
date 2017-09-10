<?php
declare(strict_types=1);

namespace Giuffre\Sprint\Template;

use Giuffre\Sprint\Error\MissingValues;

/**
 * Interface TransformerInterface
 * @package Giuffre\Sprint\Template
 */
interface TransformerInterface
{
    /**
     * @return TransformedObject
     * @throws MissingValues
     */
    public function __invoke(): TransformedObject;
}
