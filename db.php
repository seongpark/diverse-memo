 <?php
  session_start();
  header('Content-Type: text/html; charset=UTF-8');
  
  $db = new mysqli("localhost","root","123456","hanshi");
  $db->set_charset("utf8");

  function mq($sql){
    global $db;
    return $db->query($sql);
  }

  ?>