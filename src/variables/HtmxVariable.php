<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\htmx\variables;

use Craft;
use putyourlightson\htmx\helpers\ComponentHelper;
use Twig\Markup;

class HtmxVariable
{
    /**
     * Returns a `hx-get` component.
     *
     * @param array $params
     * @return Markup
     */
    public function get(array $params = []): Markup
    {
        $tag = $params['tag'] ?? 'div';
        $url = $params['url'] ?? '';
        $content = $params['content'] ?? '';
        $data = $params['data'] ?? [];
        $hx = $params['hx'] ?? [];
        $attributes = $params['attributes'] ?? [];

        return ComponentHelper::get($tag, $url, $content, $data, $hx, $attributes);
    }

    /**
     * Returns a `hx-post` component.
     *
     * @param array $params
     * @return Markup
     */
    public function post(array $params = []): Markup
    {
        $tag = $params['tag'] ?? 'form';
        $url = $params['url'] ?? '';
        $content = $params['content'] ?? '';
        $data = $params['data'] ?? [];
        $hx = $params['hx'] ?? [];
        $attributes = $params['attributes'] ?? [];

        return ComponentHelper::post($tag, $url, $content, $data, $hx, $attributes);
    }

    /**
     * Returns the request parameter if this is a Htmx request and it exists, otherwise `$defaultValue`.
     *
     * @param string $name
     * @param mixed $defaultValue
     * @return mixed
     */
    public function getParam(string $name, $defaultValue = null)
    {
        if (!$this->getIsRequest()) {
            return $defaultValue;
        }

        return Craft::$app->getRequest()->getParam($name, $defaultValue);
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
