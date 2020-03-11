<?php

$input_month = $argv[1];
$input_year = $argv[2];

function shift_days($array) {
    $last_element = array_pop($array);
    array_unshift($array, $last_element);
    return $array;
}

function get_days_for_month($month, $year)
{

    $dates = array();
    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    for($i = 1; $i <= $days_in_month; $i++){
        $month = date('m', mktime(0,0,0,$month,$i,$year));
        $week = date('W', mktime(0,0,0,$month,$i,$year));
        $week_day = date('D', mktime(0,0,0,$month,$i,$year));
        if($week_day == 'Sun') {
            $week = $week + 1;
        }
        $week = str_pad($week, 2, '0', STR_PAD_LEFT);
        $week = intval($week, 10);
        $day = date('d', mktime(0,0,0,$month,$i,$year));

        $dates[$month][$week][$week_day] = $day;
    }

    return $dates;
}

function print_month($selected_month, $selected_year) {

    $weekdays = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
    $weekdays_abbreviated = array('Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa');
    $dates = get_days_for_month($selected_month,$selected_year);

    foreach($dates as $month => $weeks) {

        echo "\r\n--------------------\r\n";
        echo date('F', mktime(0,0,0,$selected_month,1,$selected_year));
        echo " ",date('Y', mktime(0,0,0,$selected_month,1,$selected_year));
        echo "\r\n--------------------\r\n";
        echo implode(' ', $weekdays_abbreviated);
        echo "\r\n--------------------";
        foreach($weeks as $week => $days) {
            echo "\r\n";
            $dates_in_week = array();
            foreach($weekdays as $day) {
                array_push($dates_in_week, isset($days[$day]) ? $days[$day] : '  ');
            }
            $dates_in_week = shift_days($dates_in_week);
            foreach($dates_in_week as $date) {
                echo $date;
                echo ' ';
            }
        }
        echo "\r\n--------------------\r\n";
    }
}

function print_calendar($month, $year) {
    $month_one = $month;
    if($month_one + 1 > 12) {
        $month_two = $month_one - 11;
    } else {
        $month_two = $month_one + 1;
    }

    if($month_one + 2 > 12) {
        $month_three = $month_one - 10;
    } else {
        $month_three = $month_one + 2;
    }

    $year_one = $year;
    if($month_two === ($month + 1)) {
        $year_two = $year_one;
    } else {
        $year_two = $year_one +1;
    }
    if($month_three === ($month + 2)) {
        $year_three = $year_one;
    } else {
        $year_three = $year_one + 1;
    }

    print_month($month_one, $year_one);
    echo "\r\n";
    print_month($month_two, $year_two);
    echo "\r\n";
    print_month($month_three, $year_three);
}

print_calendar($input_month, $input_year);
?>