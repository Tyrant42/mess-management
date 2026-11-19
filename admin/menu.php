<?php require '../config.php'; need_admin();
if($_POST)q("INSERT INTO daily_menu(date,breakfast,lunch,dinner) VALUES(?,?,?,?) ON DUPLICATE KEY UPDATE breakfast=VALUES(breakfast),lunch=VALUES(lunch),dinner=VALUES(dinner)","ssss",$_POST['date'],$_POST['b'],$_POST['l'],$_POST['d']);
head("Daily Menu",'a'); ?>
<form method="post"><input type="date" name="date" required><br><input name="b" placeholder="Breakfast"><input name="l" placeholder="Lunch"><input name="d" placeholder="Dinner"><button>Save menu</button></form>
<table><tr><th>Date</th><th>Breakfast</th><th>Lunch</th><th>Dinner</th></tr>
<?php foreach(q("SELECT * FROM daily_menu ORDER BY date DESC LIMIT 14") as $r)echo "<tr><td>".e($r['date'])."</td><td>".e($r['breakfast'])."</td><td>".e($r['lunch'])."</td><td>".e($r['dinner'])."</td></tr>"; ?></table>
<?php foot();