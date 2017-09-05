<?php
declare(strict_types=1);

namespace Tests\Template;

use Giuffre\Sprint\Template\NamedValues;
use Giuffre\Sprint\Template\Template;
use Giuffre\Sprint\Template\Transformer;
use Moka\Traits\MokaCleanerTrait;
use PHPUnit\Framework\TestCase;
use function Moka\Plugin\PHPUnit\moka;

class TransformerTest extends TestCase
{
    use MokaCleanerTrait;

    public function testConstruct()
    {
        $transformer = new Transformer(
            moka(Template::class),
            moka(NamedValues::class)
        );

        $this->assertInstanceOf(Transformer::class, $transformer);
    }
}
