<?php
namespace KimaiPlugin\WeekendTrackingBundle\EventSubscriber;

use App\Event\DashboardEvent;
use App\Model\Widget;
use App\Widget\Type\CompoundRow;
use KimaiPlugin\WeekendTrackingBundle\Widget\HelloWidget;
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
            (new HelloWidget())
                ->setId('custom-widget-id')
                ->setTitle('Hello World!')
                ->setData([])
                ->setOptions([
                    'icon' => 'time',
                ])
        );

       $event->addSection($section);
    }
}
