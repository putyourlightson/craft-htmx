<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\htmx;

use Craft;
use craft\base\Plugin;
use craft\events\TemplateEvent;
use craft\web\twig\variables\CraftVariable;
use craft\web\View;
use putyourlightson\htmx\helpers\ComponentHelper;
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
     * @var HtmxVariable
     */
    public static $htmxVariable;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        self::$plugin = $this;
        self::$htmxVariable = new HtmxVariable();

        $this->_rerouteActions();
        $this->_registerEvents();
        $this->_registerVariables();
        $this->_registerTwigExtensions();
    }

    /**
     * Reroutes actions to `htmx/route`
     */
    private function _rerouteActions()
    {
        if (self::$htmxVariable->getRequest()) {
            $request = Craft::$app->getRequest();

            if ($action = $request->getBodyParam('action')) {
                $request->setBodyParams(array_merge(
                    $request->getBodyParams(),
                    [
                        'action' => 'htmx/route',
                        'route' => $action,
                    ])
                );
            }
        }
    }

    /**
     * Registers events
     */
    private function _registerEvents()
    {
        if (self::$htmxVariable->getRequest()) {
            Event::on(View::class, View::EVENT_BEFORE_RENDER_TEMPLATE,
                function(TemplateEvent $event) {
                    $request = Craft::$app->getRequest();

                    $hxParams = $request->getParam('hx-params');
                    $hxParams = $hxParams ? json_decode($hxParams, true) : [];

                    foreach ($hxParams as $name => $value) {
                        $event->variables[$name] = $value;
                    }

                    foreach ($request->getQueryParams() as $name => $value) {
                        $event->variables[$name] = $value;
                    }
                }
            );

            Event::on(View::class, View::EVENT_AFTER_RENDER_TEMPLATE,
                function(TemplateEvent $event) {
                    $event->output = ComponentHelper::prepareOutput($event->output, $event->template);
                }
            );
        }
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
                $variable->set('htmx', self::$htmxVariable);
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
