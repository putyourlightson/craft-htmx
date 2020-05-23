<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\htmx\variables;

use Craft;

class HtmxVariable
{
    /**
     * Returns whether this is a Htmx request.
     *
     * @return bool
     */
    public function getIsRequest(): bool
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
            'value' => $headers->get('X-HX-Active-Element', '', true),
        ];
    }
}
