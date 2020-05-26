<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\htmx\variables;

use Craft;
use craft\helpers\Html;
use craft\helpers\Template;
use putyourlightson\htmx\helpers\ComponentHelper;
use Twig\Markup;

class HtmxVariable
{
    public function component(string $template, array $options = []): Markup
    {
        $params = $options['params'] ?? [];
        $hx = $options['hx'] ?? [];
        $attributes = $options['attributes'] ?? [];

        return ComponentHelper::component($template, $params, $hx, $attributes);
    }

    /**
     * Returns a `hx-get` component with the provided options.
     *
     * @param string $tag
     * @param array $options
     * @return Markup
     */
    public function get(string $tag = 'div', array $options = []): Markup
    {
        $url = $options['url'] ?? '';
        $content = $options['content'] ?? '';
        $params = $options['params'] ?? [];
        $hx = $options['hx'] ?? [];
        $attributes = $options['attributes'] ?? [];

        return ComponentHelper::get($tag, $url, $content, $params, $hx, $attributes);
    }

    /**
     * Returns a `hx-post` component with the provided options.
     *
     * @param string $tag
     * @param array $options
     * @return Markup
     */
    public function post($tag = 'form', array $options = []): Markup
    {
        $url = $options['url'] ?? '';
        $content = $options['content'] ?? '';
        $params = $options['params'] ?? [];
        $hx = $options['hx'] ?? [];
        $attributes = $options['attributes'] ?? [];

        return ComponentHelper::post($tag, $url, $content, $params, $hx, $attributes);
    }

    /**
     * Returns a script tag to the source file using unpkg.com.
     *
     * @param array $attributes
     * @return Markup
     */
    public function script(array $attributes = []): Markup
    {
        return Template::raw(Html::jsFile('https://unpkg.com/htmx.org', $attributes));
    }

    /**
     * Returns whether this is a Htmx request.
     *
     * @return bool
     */
    public function getRequest(): bool
    {
        return (bool)Craft::$app->getRequest()->getHeaders()->get('X-HX-Request', false, true);
    }

    /**
     * Returns the element that triggered the request.
     *
     * @return array
     */
    public function getTrigger(): array
    {
        $headers = Craft::$app->getRequest()->getHeaders();

        return [
            'id' => $headers->get('X-HX-Trigger', '', true),
            'name' => $headers->get('X-HX-Trigger-Name', '', true),
        ];
    }
    /**
     * Returns the target element.
     *
     * @return array
     */
    public function getTarget(): array
    {
        $headers = Craft::$app->getRequest()->getHeaders();

        return [
            'id' => $headers->get('X-HX-Target', '', true),
        ];
    }

    /**
     * Returns the URL of the browser.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return Craft::$app->getRequest()->getHeaders()->get('X-HX-Current-URL', '', true);
    }

    /**
     * Returns value entered by the user when prompted via `hx-prompt`.
     *
     * @return string
     */
    public function getPrompt(): string
    {
        return Craft::$app->getRequest()->getHeaders()->get('X-HX-Prompt', '', true);
    }

    /**
     * Returns the original target of the event that triggered the request.
     *
     * @return array
     */
    public function getEventTarget(): array
    {
        $headers = Craft::$app->getRequest()->getHeaders();

        return [
            'id' => $headers->get('X-HX-Event-Target', '', true),
        ];
    }

    /**
     * Returns the active element.
     *
     * @return array
     */
    public function getElement(): array
    {
        $headers = Craft::$app->getRequest()->getHeaders();

        return [
            'id' => $headers->get('X-HX-Active-Element', '', true),
            'name' => $headers->get('X-HX-Active-Element-Name', '', true),
            'value' => $headers->get('X-HX-Active-Element-Value', '', true),
        ];
    }
}
