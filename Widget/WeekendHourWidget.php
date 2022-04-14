<?php
namespace KimaiPlugin\WeekendTrackingBundle\Widget;

use App\Widget\Type\AbstractUserAmountPeriod;

class WeekendHourWidget extends AbstractUserAmountPeriod {

    public function getOptions(array $options = []): array
    {
        return array_merge([
            'icon' => 'duration', 
            'dataType' => 'duration'
        ], parent::getOptions($options));
    }

    public function getData(array $options = [])
    {
        //TODO: implement me
    }

    public function getTemplateName(): string
    {
	return 'widget/widget-counter.html.twig';
    }
}
