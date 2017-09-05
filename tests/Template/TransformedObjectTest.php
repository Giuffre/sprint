<?php
declare(strict_types=1);

namespace Tests\Template;

use Giuffre\Sprint\Template\Template;
use Giuffre\Sprint\Template\TransformedObject;
use function Moka\Plugin\PHPUnit\moka;
use Moka\Traits\MokaCleanerTrait;
use PHPUnit\Framework\TestCase;

class TransformedObjectTest extends TestCase
{
    use MokaCleanerTrait;

    /**
     * @var TransformedObject
     */
    private $object;

    /**
     * @var array
     */
    private $values;

    protected function setUp()
    {
        $this->values = ['foo', 'bar'];

        $this->object = new TransformedObject(
            moka(Template::class, 'template'),
            $this->values
        );
    }

    public function testGetTemplate()
    {
        $this->assertSame(
            moka('template'),
            $this->object->getTemplate()
        );
    }

    public function testGetValues()
    {
        $this->assertSame(
            $this->values,
            $this->object->getValues()
        );
    }
}
