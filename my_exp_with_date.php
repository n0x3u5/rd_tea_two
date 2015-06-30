<?php
  require_once('/includes/sessions.php');
  require_once('/includes/functions.php');

  $connection = make_connection();

  $from = date('Y-m-d', strtotime('01-06-2015'));
  $to = date('Y-m-d', strtotime('30-06-2015'));
  $query = "select * from daily_weather where division = 'Hansqua' and record_date between '$from' and '$to'";

  var_dump($query);

  $result = mysqli_query($connection, $query);
  confirm_query($result);

   echo "<br>"; var_dump($result); echo "<br>";

  while($weather = mysqli_fetch_assoc($result))
  {
   echo "<br>"; var_dump($weather);  echo "<br>";
  }
?>
