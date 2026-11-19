<?php require 'config.php'; need_student(); $id=$_SESSION['sid']; $m='';
if(isset($_POST['buy'])){$p=q("SELECT * FROM meal_packages WHERE package_id=?","i",$_POST['buy'])[0];$b=q("SELECT balance FROM students WHERE student_id=?","i",$id)[0]['balance'];
if($b<$p['price'])$m="Not enough balance. Add money on the dashboard.";else{
q("UPDATE students SET balance=balance-? WHERE student_id=?","di",$p['price'],$id);
q("INSERT INTO subscriptions(student_id,package_id,meals_remaining,purchase_date,expiry_date) VALUES(?,?,?,CURDATE(),DATE_ADD(CURDATE(),INTERVAL ? DAY))","iiii",$id,$p['package_id'],$p['meal_count'],$p['validity_days']);$m="Package purchased!";}}
head("Meal Packages",'s'); if($m)echo "<div class='msg'>$m</div>"; ?>
<table><tr><th>Package</th><th>Meals</th><th>Price</th><th>Valid (days)</th><th></th></tr>
<?php foreach(q("SELECT * FROM meal_packages") as $r)echo "<tr><td>".e($r['package_name'])."</td><td>".e($r['meal_count'])."</td><td>".e($r['price'])."</td><td>".e($r['validity_days'])."</td><td><form method='post' style='margin:0;padding:0;border:0'><button name='buy' value='".(int)$r['package_id']."'>Buy</button></form></td></tr>"; ?></table>
<?php foot();
