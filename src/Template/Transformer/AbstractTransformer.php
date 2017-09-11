<?php
/**
 * Created by PhpStorm.
 * User: angelogiuffredi
 * Date: 11/09/2017
 * Time: 14:55
 */

namespace Giuffre\Sprint\Template\Transformer;


use Giuffre\Sprint\Template\NamedValues;
use Giuffre\Sprint\Template\Template;
use Giuffre\Sprint\Template\TransformerHelper;

/**
 * Class AbstractTransformer
 * @package Giuffre\Sprint\Template\Transformer
 */
abstract class AbstractTransformer implements TransformerInterface
{
    /**
     * @var Template
     */
    protected $originalTemplate;

    /**
     * @var NamedValues
     */
    protected $namedValues;

    /**
     * @var TransformerHelper
     */
    protected $transformerHelper;

    /**
     * AbstractTransformer constructor.
     * @param Template $originalTemplate
     * @param NamedValues $namedValues
     */
    public function __construct(
        Template $originalTemplate,
        NamedValues $namedValues
    )
    {
        $this->originalTemplate = $originalTemplate;
        $this->namedValues = $namedValues;
        $this->transformerHelper = new TransformerHelper($originalTemplate);
    }

}
