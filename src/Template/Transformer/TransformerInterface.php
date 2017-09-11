<?php
declare(strict_types=1);

namespace Giuffre\Sprint\Template\Transformer;

use Giuffre\Sprint\Error\MissingValues;
use Giuffre\Sprint\Template\NamedValues;
use Giuffre\Sprint\Template\Template;
use Giuffre\Sprint\Template\TransformedObject;

/**
 * Interface TransformerInterface
 * @package Giuffre\Sprint\Template
 */
interface TransformerInterface
{

    /**
     * TransformerInterface constructor.
     * @param Template $originalTemplate
     * @param NamedValues $namedValues
     */
    public function __construct(Template $originalTemplate, NamedValues $namedValues);

    /**
     * @return TransformedObject
     * @throws MissingValues
     */
    public function __invoke(): TransformedObject;
}
