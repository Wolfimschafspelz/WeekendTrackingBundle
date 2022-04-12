<?php
namespace KimaiPlugin\WeekendTrackingBundle\EventSubscriber;

use App\Event\DashboardEvent;
use App\Model\Widget;
use App\Widget\Type\CompoundRow;
use KimaiPlugin\WeekendTrackingBundle\Widget\WeekendHourWidget;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DashboardSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [DashboardEvent::DASHBOARD => ['onDashboardEvent', 200]];
    }

    public function onDashboardEvent(DashboardEvent $event)
    {
        $section = new CompoundRow();
        $section->setOrder(20);

        $section->addWidget(
            (new WeekendHourWidget())
                ->setId('weekend-hours')
                ->setTitle('Weekend Hours to spare')
                ->setOptions([
                    'icon' => 'duration',
                    'dataType' => 'duration'
                ])
        );

       $event->addSection($section);
    }
}
