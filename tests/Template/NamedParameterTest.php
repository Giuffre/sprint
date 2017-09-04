<?php
declare(strict_types=1);

namespace Tests\Template;

use Giuffre\Sprint\Error\MalformedName;
use Giuffre\Sprint\Error\MalformedType;
use Giuffre\Sprint\Template\NamedParameter;
use PHPUnit\Framework\TestCase;

class NamedParameterTest extends TestCase
{
    const TEMPLATE = '%s[%s]';
    const NAME = 'foo';
    const TYPE = '%s';

    /**
     * @var NamedParameter
     */
    private $parameter;

    protected function setUp()
    {
        $this->parameter = new NamedParameter(
            sprintf(self::TEMPLATE, self::TYPE, self::NAME)
        );
    }

    public function testExtractNameSuccess()
    {
        $this->assertEquals(
            self::NAME,
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
            self::TYPE,
            $this->parameter->extractType()
        );
    }

    public function testExtractTypeFailure()
    {
        $parameter = new NamedParameter('s[foo]');

        $this->expectException(MalformedType::class);
        $parameter->extractType();
    }

    public function testToString()
    {
        $this->assertEquals(
            sprintf(self::TEMPLATE, self::TYPE, self::NAME),
            (string)$this->parameter
        );
    }
}
