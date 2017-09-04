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

    public function testInvalidNameFailure()
    {
        $this->expectException(MalformedName::class);

        new NamedParameter('%s{foo}');
    }

    public function testInvalidTypeFailure()
    {
        $this->expectException(MalformedType::class);

        new NamedParameter('s[foo]');
    }

    public function testGetName()
    {
        $this->assertEquals(
            self::NAME,
            $this->parameter->getName()
        );
    }

    public function testGetType()
    {
        $this->assertEquals(
            self::TYPE,
            $this->parameter->getType()
        );
    }

    public function testToString()
    {
        $this->assertEquals(
            sprintf(self::TEMPLATE, self::TYPE, self::NAME),
            (string)$this->parameter
        );
    }
}
