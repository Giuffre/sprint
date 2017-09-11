<?php
declare(strict_types=1);

namespace Tests\Template;

use Giuffre\Sprint\Template\NamedValues;
use Giuffre\Sprint\Template\Template;
use Giuffre\Sprint\Template\TransformedObject;
use Giuffre\Sprint\Template\Transformer;
use Giuffre\Sprint\Template\Transformer\SprintTransformer;
use Moka\Traits\MokaCleanerTrait;
use PHPUnit\Framework\TestCase;
use function Moka\Plugin\PHPUnit\moka;

class SprintTransformerTest extends TestCase
{
    use MokaCleanerTrait;
    /**
     * @var Transformer\TransformerInterface
     */
    private $transformer;

    protected function setUp()
    {
        $this->transformer = new SprintTransformer(
            moka(Template::class)->stub([
                '__toString' => 'one %s[tic] three %s[tac] five'
            ]),
            moka(NamedValues::class, 'values')
        );
        moka('values')
            ->method('getValue')
            ->willReturnMap([
                ['tic', 'two'],
                ['tac', 'four'],
                ['toe', 'six']
            ]);
    }

    public function testConstruct()
    {
        $this->assertInstanceOf(SprintTransformer::class, $this->transformer);
    }

    public function testTransform()
    {
        /** @var TransformedObject $result */
        $result = ($this->transformer)();
        $this->assertInstanceOf(TransformedObject::class, $result);
        $this->assertCount(2, $result->getValues());
        $this->assertEquals([
            'two', 'four'
        ], $result->getValues());
        $this->assertEquals(
            'one %s three %s five',
            $result->getTemplate()
        );
    }

}
