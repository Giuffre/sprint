<?php
declare(strict_types=1);

namespace Giuffre\Sprint\Template;

use Giuffre\Sprint\Error\DuplicateParametersFound;
use Giuffre\Sprint\Error\NamedParametersMismatch;

/**
 * Interface TransformerInterface
 * @package Giuffre\Sprint\Template
 */
interface TransformerInterface
{
    /**
     * @return TransformedObject
     * @throws DuplicateParametersFound
     * @throws NamedParametersMismatch
     */
    public function transform(): TransformedObject;
}
