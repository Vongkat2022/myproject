<?php exec("php transfer5.php");
 $hostname = "localhost";
 $user = ""; $pass = "";
 $db = "wsndata"; $charset = 'utf8';
$dsn = "mysql:host=$hostname;dbname=$db;charset=$charset"; 
$opt = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false, ];
$pdo = new PDO($dsn, $user, $pass, $opt);
 $tempdata = ""; $humiddata = ""; 
 $stmt = $pdo->query('select time_stamp , temperature, humidity from temp_humi where reading_date = CURDATE() order by time_stamp desc limit 10');
  while ($res = $stmt->fetch()) { $tempdata .="["; 
    $humiddata .="[";
     $time = strtotime($res["time_stamp"]);
      $time = ltrim(date("h.i", $time),'0');
       $tempdata .= $time.","; $tempdata .=$res["temperature"]."],";
        $humiddata .= $time.","; $humiddata .=$res["humidity"]."],";
     } $tempdata = rtrim($tempdata, ","); 
     $humiddata = rtrim($humiddata, ",");
      $scrolljson = "[";
       $stmt2 = $pdo->query('select time_stamp, temperature, humidity from temp_humi where reading_date = CURDATE() order by time_stamp desc limit 10');
        while ($res2 = $stmt2->fetch()) 
        { $scrolljson .="{";
             $time = strtotime($res2["time_stamp"]);
             $time = ltrim(date("h.i", $time),'0'); 
             $scrolljson .= '"time": '. $time.",";
              $scrolljson .= '"humidity": '. $res2["humidity"].",";
              $scrolljson .= '"temperature": '. $res2["temperature"]."},";
55
}
$scrolljson = rtrim($scrolljson, ","); 
$scrolljson.="]";
 //echo $humiddata; //echo $data;di /*$cxn = mysql_connect($hostname, $user, $pass); mysql_select_db($db); $query = mysql_query("select node_id, temperature, humidity, date, time_stamp from temp_humi") or die ("Cannot get readings ".mysql_error()); while ($res = mysql_fetch_array($query)) { echo $res["node_id"]; }*/ //data: [ ?>