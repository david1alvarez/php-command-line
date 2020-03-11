<?php
//https://stackoverflow.com/questions/5536041/echo-all-months-with-days-calendar
//https://www.w3schools.com/php/phptryit.asp?filename=tryphp_func_date
//https://www.w3schools.com/php/func_date_date.asp
function getDates($year)
{
    $dates = array();

    // determine if the year is a leap year
    date("L", mktime(0,0,0, 7,7, $year)) ? $days = 366 : $days = 365;
    for($i = 1; $i <= $days; $i++){
        $month = date('m', mktime(0,0,0,1,$i,$year));
        $wk = date('W', mktime(0,0,0,1,$i,$year));
        $wkDay = date('D', mktime(0,0,0,1,$i,$year));
        $day = date('d', mktime(0,0,0,1,$i,$year));

        $dates[$month][$wk][$wkDay] = $day;
    } 

    return $dates;   
}

function getDaysForMonth($month, $year)
{
    $dates = array();
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    for($i = 1; $i <= $daysInMonth; $i++){
        $month = date('m', mktime(0,0,0,$month,$i,$year));
        $week = date('W', mktime(0,0,0,$month,$i,$year));
        $weekDay = date('D', mktime(0,0,0,$month,$i,$year));
        $day = date('d', mktime(0,0,0,$month,$i,$year));

        $dates[$month][$week][$weekDay] = $day;
    }

    return $dates;
}


    $weekdays = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
    $dates = getDaysForMonth(3,2020);

    foreach($dates as $month => $weeks) {
        echo implode(' ', $weekdays);
        foreach($weeks as $week => $days) {
            foreach($weekdays as $day) {
                echo isset($days[$day]) ? $days[$day] : ' ';
            }
        }
    }
?>

<?php //$dates = getDates(2011); 

// 
// $divider = '--------------------';
// 
// $weekdays = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'); ?>
<!-- <?php foreach($dates as $month => $weeks) { ?> -->
<!-- <table> -->
    <!-- <tr> -->
        <!-- <th><?php echo implode('</th><th>', $weekdays); ?></th> -->
    <!-- </tr> -->
    <!-- <?php foreach($weeks as $week => $days){ ?> -->
    <!-- <tr> -->
        <!-- <?php foreach($weekdays as $day){ ?> -->
        <!-- <td> -->
            <!-- <?php echo isset($days[$day]) ? $days[$day] : '&nbsp'; ?> -->
        <!-- </td>                -->
        <!-- <?php } ?> -->
    <!-- </tr> -->
    <!-- <?php } ?> -->
<!-- </table> -->
<!-- <?php } ?> -->