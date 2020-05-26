<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\htmx\helpers;

use Craft;
use craft\helpers\Html;
use craft\helpers\StringHelper;
use craft\helpers\Template;
use Twig\Markup;

class ComponentHelper
{
    /**
     * Returns a live component.
     *
     * @param string $template
     * @param array $params
     * @param array $hx
     * @param array $attributes
     * @return Markup
     */
    public static function component(string $template, array $params, array $hx, array $attributes): Markup
    {
        $id = 'hx-'.StringHelper::randomString(8);

        $hx = array_merge([
                'target' => '#'.$id,
                'include' => '*',
            ],
            $hx);

        $attributes = array_merge(
            self::_prefixAttributes($hx, 'hx-'),
            $attributes
        );

        $hxParamsInput = Html::hiddenInput('hx-params', json_encode($params));

        $renderedTemplate = Craft::$app->getView()->renderTemplate($template, $params);
        $renderedTemplate = self::prepareOutput($renderedTemplate, $template);

        $content = $hxParamsInput
            .Html::tag('div', $renderedTemplate, ['id' => $id]);

        return Template::raw(
            Html::tag('div', $content, $attributes)
        );
    }

    /**
     * Returns prepared output for a component.
     *
     * @param string $output
     * @param string $template
     * @return string
     */
    public static function prepareOutput(string $output, string $template): string
    {
        // Replace `hx-get`, or `hx-get=""`
        $output = preg_replace(
            '/hx-get([ >]|="")/',
            'hx-get="/'.$template.'"',
            $output
        );

        return $output;
    }

    /**
     * Returns a `hx-get` component.
     *
     * @param string $tag
     * @param string $url
     * @param string $content
     * @param array $params
     * @param array $hx
     * @param array $attributes
     * @return Markup
     */
    public static function get(string $tag, string $url, string $content, array $params, array $hx, array $attributes): Markup
    {
        $queryString = http_build_query($params);
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
     * @param array $params
     * @param array $hx
     * @param array $attributes
     * @return Markup
     */
    public static function post(string $tag, string $url, string $content, array $params, array $hx, array $attributes): Markup
    {
        $hx = array_merge(['post' => $url], $hx);
        $attributes = array_merge(self::_prefixAttributes($hx, 'hx-'), $attributes);

        $inputFields = [];

        if (Craft::$app->getRequest()->enableCsrfValidation) {
            $inputFields[] = Html::csrfInput();
        }

        foreach ($params as $name => $value) {
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
