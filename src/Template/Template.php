<?php
/**
 * Created by PhpStorm.
 * User: angelogiuffredi
 * Date: 9/2/17
 * Time: 3:57 PM
 */

namespace Giuffre\Sprint\Template;


class Template
{
    /**
     * @var string
     */
    private $originalTemplate;

    /**
     * Template constructor.
     * @param string $originalTemplate
     */
    public function __construct($originalTemplate)
    {
        $this->originalTemplate = $originalTemplate;
    }

    public function __toString(): string
    {
        return $this->originalTemplate;
    }
}