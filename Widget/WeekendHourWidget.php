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

        $this->setId('weekendHours');
        $this->setTitle('Weekend Hours to spare');
        $this->setOptions(
            ['icon' => 'duration',
            'user' => null,
            'dataType' => 'duration'
            ]);
    }

    public function setUser(User $user) : void
    {
        $this->setOption('user', $user);
    }

    public function getOptions(array $options = []): array
    {
        $options = parent::getOptions($options);
        
        if (empty($options['id'])) {
            $options['id'] = 'weekendHours';
        }

        return $options;
    }

    public function getData(array $options = [])
    {
        $weekendHours = 0;
        $options = $this->getOptions($options);

        /** @var User user */
        $user = $options['user'];


        $query = new TimesheetQuery();
        $query->addUser($user);
        $entries = $this->repository->getTimesheetsForQuery($query);;

        foreach ($entries as $sheet) {
            if($sheet->getCategory() == 'flextime') {
                $weekendHours -= $sheet->getDuration();
            }
            else {
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
}
