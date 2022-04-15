<?php

namespace KimaiPlugin\WeekendTrackingBundle\Widget;

use App\Entity\User;
use App\Repository\Query\TimesheetQuery;
use App\Repository\TimesheetRepository;
use App\Widget\Type\SimpleWidget;
use App\Widget\Type\UserWidget;

class WeekendHourWidget extends SimpleWidget implements UserWidget
{
    private TimesheetRepository $repository;

    public function __construct(TimesheetRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getId(): string
    {
        return 'weekendHours';
    }

    public function getTitle(): string
    {
        return 'Weekend Hours to spare';
    }

    public function getOptions(array $options = []): array
    {
        return array_merge([
            'icon' => 'duration',
            'dataType' => 'duration'
        ]);
    }

    public function getData(array $options = [])
    {
        $weekendHours = 0;

        $query = new TimesheetQuery();
        $entries = $this->repository->getTimesheetsForQuery($query);

        foreach ($entries as $sheet) {
            if($sheet->getBegin()->format('Y') == date('Y')) {
                $weekDay = $sheet->getBegin()->format('w');
                if ($weekDay == 0 || $weekDay == 6) {
                    $weekendHours += $sheet->getDuration();
                }
            }
        }

        return $weekendHours;
    }

    public function getTemplateName(): string
    {
        return 'widget/widget-counter.html.twig';
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
