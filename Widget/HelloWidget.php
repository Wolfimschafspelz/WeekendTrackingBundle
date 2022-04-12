<?php
namespace KimaiPlugin\WeekendTrackingBundle\Widget;

use App\Widget\Type\SimpleWidget;

class HelloWidget extends SimpleWidget {

    public function getTemplateName(): string
    {
	return 'widget/widget-more.html.twig';
    }
}
