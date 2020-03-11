<?php
//https://stackoverflow.com/questions/5536041/echo-all-months-with-days-calendar
function getDates($year)
{
    $dates = array();

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

?>

<?php $dates = getDates(2011); 

$weekdays = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'); ?>
<?php foreach($dates as $month => $weeks) { ?>
<table>
    <tr>
        <th><?php echo implode('</th><th>', $weekdays); ?></th>
    </tr>
    <?php foreach($weeks as $week => $days){ ?>
    <tr>
        <?php foreach($weekdays as $day){ ?>
        <td>
            <?php echo isset($days[$day]) ? $days[$day] : '&nbsp'; ?>
        </td>               
        <?php } ?>
    </tr>
    <?php } ?>
</table>
<?php } ?>