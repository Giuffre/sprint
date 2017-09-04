<?php
declare(strict_types=1);

namespace Tests\Template;

use Giuffre\Sprint\Error\MalformedName;
use Giuffre\Sprint\Error\MalformedType;
use Giuffre\Sprint\Template\NamedParameter;
use PHPUnit\Framework\TestCase;

class NamedParameterTest extends TestCase
{
    /**
     * @var NamedParameter
     */
    private $parameter;

    protected function setUp()
    {
        $this->parameter = new NamedParameter('%s[foo]');
    }

    public function testExtractNameSuccess()
    {
        $this->assertEquals(
            'foo',
            $this->parameter->extractName()
        );
    }

    public function testExtractNameFailure()
    {
        $parameter = new NamedParameter('%s{foo}');

        $this->expectException(MalformedName::class);
        $parameter->extractName();
    }

    public function testExtractTypeSuccess()
    {
        $this->assertEquals(
            '%s',
            $this->parameter->extractType()
        );
    }

    public function testExtractTypeFailure()
    {
        $parameter = new NamedParameter('s[foo]');

        $this->expectException(MalformedType::class);
        $parameter->extractType();
    }
}
