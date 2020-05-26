<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\htmx\twigextensions;

use putyourlightson\htmx\Htmx;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class HtmxTwigExtension extends AbstractExtension implements GlobalsInterface
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getGlobals(): array
    {
        return ['hx' => Htmx::$htmxVariable];
    }
}
