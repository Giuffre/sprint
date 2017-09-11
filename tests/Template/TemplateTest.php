<?php
declare(strict_types=1);

namespace Tests\Template;

use Giuffre\Sprint\Template\Template;
use PHPUnit\Framework\TestCase;

class TemplateTest extends TestCase
{
    public function testToString()
    {
        $originalTemplate = 'whatever %s[does]';
        $template = new Template($originalTemplate);

        $this->assertEquals(
            $originalTemplate,
            (string)$template
        );
    }
}
