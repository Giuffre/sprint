<?php
/**
 * Created by PhpStorm.
 * User: angelogiuffredi
 * Date: 01/09/2017
 * Time: 15:21
 */

namespace Giuffre\Sprint\Template;

use Giuffre\Sprint\Error\DuplicateParametersFound;
use Giuffre\Sprint\Error\MalformedName;
use Giuffre\Sprint\Error\MalformedType;
use Giuffre\Sprint\Error\NamedParametersMismatch;

/**
 * Class Transformer
 * @package Giuffre\Sprint\Template
 */
class Transformer
{
    /**
     * @var string
     */
    private $pattern = '/(%)([\w]+)\[(\w+)\]/';

    /**
     * @var NamedValues
     */
    private $namedValues;

    /**
     * @var string
     */
    private $originalTemplate;

    /**
     * Transformer constructor.
     * @param string $originalTemplate
     * @param NamedValues $namedValues
     */
    public function __construct(string $originalTemplate, NamedValues $namedValues)
    {
        $this->originalTemplate = $originalTemplate;
        $this->namedValues = $namedValues;
    }

    /**
     * @return TransformedObject
     * @throws DuplicateParametersFound
     * @throws NamedParametersMismatch
     */
    public function transform(): TransformedObject
    {
        $namedParameters = [];
        $template = $this->originalTemplate;
        preg_match_all($this->pattern, $template, $namedParameters);

        $namedParameters = $namedParameters[0];
        if (true === self::hasDupes($namedParameters)) {
            throw new DuplicateParametersFound('Named parameters must be occur at most once');
        }

        if (count($namedParameters) !== count($this->namedValues)) {
            throw new NamedParametersMismatch('Placeholders and values count must be the same');
        }

        $values = [];
        foreach ($namedParameters as $match) {
            $values[] = self::getValue(
                $this->namedValues,
                self::getName($match)
            );

            $template = str_replace(
                $match,
                self::getType($match),
                $template
            );
        }

        return new TransformedObject(
            $template,
            $values
        );
    }

    /**
     * @param array $array
     * @return bool
     */
    private static function hasDupes(array $array): bool
    {
        return !(count($array) === count(array_unique($array)));
    }

    /**
     * @param NamedValues $namedValues
     * @param string $name
     * @return mixed
     */
    private static function getValue(NamedValues $namedValues, string $name)
    {
        return $namedValues[$name];
    }

    /**
     * @param string $fromMatch
     * @return string
     * @throws MalformedName
     */
    private static function getName(string $fromMatch): string
    {
        $matches = [];
        preg_match('/\[(\w+)\]/', $fromMatch, $matches);
        if (!array_key_exists(1, $matches) || 0 >= count($matches)) {
            throw new MalformedName(
                sprintf('Could not extract a name from this string: %s', $fromMatch)
            );
        }

        return $matches[1];
    }

    /**
     * @param string $fromMatch
     * @return string
     * @throws MalformedType
     */
    private static function getType(string $fromMatch): string
    {
        $matches = [];
        preg_match('/(%)([\w]+)/', $fromMatch, $matches);
        if (!array_key_exists(0, $matches) || 0 >= count($matches)) {
            throw new MalformedType(
                sprintf('Could not extract a type from this string: %s', $fromMatch)
            );
        }

        return $matches[0];
    }
}
