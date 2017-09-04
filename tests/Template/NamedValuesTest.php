<?php
declare(strict_types=1);

namespace Tests\Template;

use Giuffre\Sprint\Error\MissingValues;
use Giuffre\Sprint\Template\NamedValues;
use PHPUnit\Framework\TestCase;

class NamedValuesTest extends TestCase
{
    /**
     * @var NamedValues
     */
    private $values;

    protected function setUp()
    {
        $this->values = new NamedValues([
            [
                'foo' => 'bar',
                'mad' => 'max'
            ]
        ]);
    }

    public function testGetValueSuccess()
    {
        $this->assertEquals(
            'max',
            $this->values->getValue('mad')
        );
    }

    public function testGetValueFailure()
    {
        $this->expectException(MissingValues::class);

        $this->values->getValue('wazzup');
    }
}
