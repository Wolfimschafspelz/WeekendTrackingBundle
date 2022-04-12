<?php
namespace KimaiPlugin\WeekendTrackingBundle\Widget;

use App\Widget\Type\SimpleWidget;

class WeekendHourWidget extends SimpleWidget {

    public function getData(array $options = [])
    {
        //TODO: implement me
    }

    public function getTemplateName(): string
    {
	return 'widget/widget-counter.html.twig';
    }
}
