<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\htmx\controllers;

use Craft;
use craft\web\Controller;
use yii\web\Response;

class RouteController extends Controller
{
    /**
     * @inheritdoc
     */
    protected $allowAnonymous = true;

    /**
     * Routes an action request through to another controller.
     *
     * @return Response
     */
    public function actionIndex(): Response
    {
        $request = Craft::$app->getRequest();
        $route = $request->getParam('route');

        if ($route !== null) {
            // Run the route action
            Craft::$app->runAction($route);
        }

        $variables = Craft::$app->getUrlManager()->getRouteParams();

        $response = $this->renderTemplate($request->getUrl(), $variables);

        // Set status code and remove redirects in case the route action attempted a redirect
        $response->setStatusCode(200);
        $response->getHeaders()->remove('Location');

        return $response;
    }
}
