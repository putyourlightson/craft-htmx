<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\htmx\helpers;

use Craft;
use craft\helpers\Html;
use craft\helpers\Template;
use Twig\Markup;

class ComponentHelper
{
    /**
     * Returns a `hx-get` component.
     *
     * @param string $tag
     * @param string $url
     * @param string $content
     * @param array $data
     * @param array $hx
     * @param array $attributes
     * @return Markup
     */
    public static function get(string $tag, string $url, string $content, array $data, array $hx, array $attributes): Markup
    {
        $queryString = http_build_query($data);
        $url .= $queryString ? '?'.$queryString : '';

        $hx = array_merge(['get' => $url], $hx);

        $attributes = array_merge(self::_prefixAttributes($hx, 'hx-'), $attributes);

        return Template::raw(
            Html::tag($tag, $content, $attributes)
        );
    }

    /**
     * Returns a `hx-post` component.
     *
     * @param string $tag
     * @param string $url
     * @param string $content
     * @param array $data
     * @param array $hx
     * @param array $attributes
     * @return Markup
     */
    public static function post(string $tag, string $url, string $content, array $data, array $hx, array $attributes): Markup
    {
        $hx = array_merge(['post' => $url], $hx);
        $attributes = array_merge(self::_prefixAttributes($hx, 'hx-'), $attributes);

        $inputFields = [];

        if (Craft::$app->getRequest()->enableCsrfValidation) {
            $inputFields[] = Html::csrfInput();
        }

        foreach ($data as $name => $value) {
            $inputFields[] = Html::hiddenInput($name, $value);
        }

        $content = implode(' ', $inputFields).$content;

        return Template::raw(
            Html::tag($tag, $content, $attributes)
        );
    }

    /**
     * Returns an array of attributes with the names prefixed with the provided value.
     *
     * @param array $attributes
     * @param string $prefix
     * @return array
     */
    private static function _prefixAttributes(array $attributes, string $prefix = ''): array
    {
        $normalized = [];

        foreach ($attributes as $name => $value) {
            $normalized[$prefix.$name] = $value;
        }

        return $normalized;
    }
}
