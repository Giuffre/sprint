<?php
/**
 * Created by PhpStorm.
 * User: angelogiuffredi
 * Date: 9/10/17
 * Time: 10:56 PM
 */

namespace Tests\Template;


use Giuffre\Sprint\Template\NamedParameter;
use Giuffre\Sprint\Template\NamedParameters;
use Giuffre\Sprint\Template\Template;
use Giuffre\Sprint\Template\TransformerHelper;
use function Moka\Plugin\PHPUnit\moka;
use PHPUnit\Framework\TestCase;

class TransformerHelperTest extends TestCase
{
    const TEMPLATE = 'Apples are %s[color]';
    /**
     * @var TransformerHelper
     */
    private $transformerHelper;

    public function setUp()
    {
        $this->transformerHelper = new TransformerHelper(
            moka(Template::class)->stub([
                '__toString' => self::TEMPLATE
            ])
        );
    }

    public function testExtractNamedParametersSuccess()
    {
        $namedParameters = $this->transformerHelper->extractNamedParameters();
        $this->assertInstanceOf(NamedParameters::class, $namedParameters);
        $this->assertContainsOnly(NamedParameter::class, $namedParameters);
        $this->assertCount(1, $namedParameters);
    }

    public function testStripParameterNameFromTemplateSuccess()
    {
        $result = $this->transformerHelper->stripParameterNameFromTemplate(
            self::TEMPLATE,
            new NamedParameter('%s[color]')
        );

        $this->assertNotContains('color', $result);
    }

}