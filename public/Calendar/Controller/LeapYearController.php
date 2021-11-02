<?php

namespace App\Calendar\Controller;

use App\Calendar\Model\LeapYear;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class LeapYearController
{
    public function index(Request $request, $year)
    {
        $leapYear = new LeapYear();
        if ($leapYear->isLeapYear($year)) {
            return new Response('Да, данный год високосный!');
        }

        return new Response('Нет, данный год не високосный.');
    }
}