<?php
/**
 * Created by PhpStorm.
 * User: angelogiuffredi
 * Date: 9/2/17
 * Time: 11:55 AM
 */

namespace Tests\Transformer;

use Giuffre\Sprint\Template\NamedValues;
use Giuffre\Sprint\Template\Template;
use Giuffre\Sprint\Template\Transformer;
use function Moka\Plugin\PHPUnit\moka;
use PHPUnit\Framework\TestCase;

class TransformerTest extends TestCase
{
    public function testConstructorSuccess()
    {
        $transformer = new Transformer(
            moka(Template::class)->stub([
                '__toString' => 'The Apple is %[color] and its taste is %s[how]'
            ]),
            moka(NamedValues::class)
        );

        $this->assertInstanceOf(Transformer::class, $transformer);
    }

    public function testConstructorFail()
    {
        $transformer = new Transformer(
            moka(Template::class)->stub([
                '__toString' => 'The Apple is %[color] and its taste is %s[how]'
            ]),
            moka(NamedValues::class)
        );

        $this->assertInstanceOf(Transformer::class, $transformer);
    }
}
