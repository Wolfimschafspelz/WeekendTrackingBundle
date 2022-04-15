<?php
namespace KimaiPlugin\WeekendTrackingBundle\EventSubscriber;

use App\Event\DashboardEvent;
use App\Widget\Type\CompoundRow;
use KimaiPlugin\WeekendTrackingBundle\Widget\WeekendHourWidget;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DashboardSubscriber implements EventSubscriberInterface
{
    private $weekendHourWidget;
    public function __construct(WeekendHourWidget $widget)
    {
        $this->weekendHourWidget = $widget;
    }

    public static function getSubscribedEvents(): array
    {
        return [DashboardEvent::class => ['onDashboardEvent', 200]];
    }

    public function onDashboardEvent(DashboardEvent $event)
    {
        $section = new CompoundRow();
        $section->setOrder(20);

        $section->addWidget($this->weekendHourWidget);

       $event->addSection($section);
    }
}
