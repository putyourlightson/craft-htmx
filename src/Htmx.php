<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\htmx;

use Craft;
use craft\base\Plugin;
use craft\elements\db\ElementQuery;
use craft\events\CancelableEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Utilities;
use craft\web\twig\variables\CraftVariable;
use putyourlightson\pluginsales\variables\PluginSalesVariable;
use yii\base\Event;

class Htmx extends Plugin
{
    /**
     * @var Htmx
     */
    public static $plugin;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        self::$plugin = $this;

        $this->_registerVariables();
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
}
