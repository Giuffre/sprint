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

    public function testConstructorSuccess()
    {
        $transformer = new Transformer(
            moka(Template::class)->stub([
                '__toString' => 'Apples are %s[color] and taste %s[how]'
            ]),
            moka(NamedValues::class)
        );

        $this->assertInstanceOf(Transformer::class, $transformer);
    }

    public function testConstructorFailure()
    {
        $transformer = new Transformer(
            moka(Template::class)->stub([
                '__toString' => 'Apples are %s[color] and taste %s[how]'
            ]),
            moka(NamedValues::class)
        );

        $this->assertInstanceOf(Transformer::class, $transformer);
    }
}
