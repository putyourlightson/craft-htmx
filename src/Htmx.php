<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\htmx;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use putyourlightson\htmx\twigextensions\HtmxTwigExtension;
use putyourlightson\htmx\variables\HtmxVariable;
use yii\base\Event;

class Htmx extends Plugin
{
    /**
     * @var Htmx
     */
    public static $plugin;

    /**
     * @var SeomaticVariable
     */
    public static $htmxVariable;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        self::$plugin = $this;

        $this->_registerVariables();
        $this->_registerTwigExtensions();
    }

    /**
     * Registers variables.
     */
    private function _registerVariables()
    {
        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT,
            function(Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('htmx', HtmxVariable::class);
            }
        );
    }

    /**
     * Registers Twig extensions
     */
    private function _registerTwigExtensions()
    {
        Craft::$app->view->registerTwigExtension(new HtmxTwigExtension());
    }
}
