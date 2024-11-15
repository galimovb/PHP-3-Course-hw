<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    #[Route("/calendar/{month}", name: "calendar_default", methods: ['GET'], defaults: ["month" => null])]
    #[Route("/calendar/table/{month}", name: "calendar_table", methods: ['GET'], defaults: ["month" => null])]
    public function table($month = null): Response
    {
        $currentMonth = $month ?? date('n'); // Текущий месяц, если не указан
        $currentYear = date('Y');

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
        $firstDayOfMonth = date('N', strtotime("$currentYear-$currentMonth-01"));

        $days = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $days[] = [
                'day' => $i,
                'isWeekend' => in_array(date('N', strtotime("$currentYear-$currentMonth-$i")), [6, 7]),
            ];
        }

        return $this->render('calendar/table.html.twig', [
            'month' => $currentMonth,
            'year' => $currentYear,
            'days' => $days,
            'firstDayOfMonth' => $firstDayOfMonth,
        ]);
    }

    #[Route("/calendar/list/{month}", name: "calendar_list", methods: ['GET'], defaults: ["month" => null])]
    public function list($month = null): Response
    {
        $currentMonth = $month ?? date('n'); // Текущий месяц, если не указан
        $currentYear = date('Y');

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
        $firstDayOfMonth = date('N', strtotime("$currentYear-$currentMonth-01"));

        $days = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $days[] = [
                'day' => $i,
                'isWeekend' => in_array(date('N', strtotime("$currentYear-$currentMonth-$i")), [6, 7]),
            ];
        }

        return $this->render('calendar/list.html.twig', [
            'month' => $currentMonth,
            'year' => $currentYear,
            'days' => $days,
            'firstDayOfMonth' => $firstDayOfMonth,
        ]);
    }

    #[Route("/calendar/weekends/{month}", name: "calendar_weekends", methods: ['GET'], defaults: ["month" => null])]
    public function weekends($month = null): Response
    {
        $currentMonth = $month ?? date('n'); // Текущий месяц, если не указан
        $currentYear = date('Y');

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
        $firstDayOfMonth = date('N', strtotime("$currentYear-$currentMonth-01"));

        $days = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $days[] = [
                'day' => $i,
                'isWeekend' => in_array(date('N', strtotime("$currentYear-$currentMonth-$i")), [6, 7]),
            ];
        }

        return $this->render('calendar/weekends.html.twig', [
            'month' => $currentMonth,
            'year' => $currentYear,
            'days' => $days,
            'firstDayOfMonth' => $firstDayOfMonth,
        ]);
    }
}