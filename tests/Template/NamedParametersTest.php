<?php
declare(strict_types=1);

namespace Tests\Template;

use Giuffre\Sprint\Template\NamedParameter;
use Giuffre\Sprint\Template\NamedParameters;
use PHPUnit\Framework\TestCase;

class NamedParametersTest extends TestCase
{
    public function testConstruct()
    {
        $arguments = [
            '%s[foo]',
            '%d[bar]'
        ];

        $parameters = new NamedParameters($arguments);

        $this->assertCount(count($arguments), $parameters);
        $this->assertInstanceOf(
            NamedParameter::class,
            reset($parameters)
        );
    }
}
