<?php require 'config.php'; need_student(); $id=$_SESSION['sid']; $m='';
if($_POST){q("INSERT INTO meal_planner(student_id,date,breakfast,lunch,dinner) VALUES(?,?,?,?,?) ON DUPLICATE KEY UPDATE breakfast=VALUES(breakfast),lunch=VALUES(lunch),dinner=VALUES(dinner)","isiii",$id,$_POST['date'],(int)isset($_POST['b']),(int)isset($_POST['l']),(int)isset($_POST['d']));$m="Saved.";}
head("Meal Planner",'s'); if($m)echo "<div class='msg'>$m</div>"; ?>
<form method="post"><input type="date" name="date" min="<?=date('Y-m-d')?>" required>
<label><input type="checkbox" name="b" checked> Breakfast</label> <label><input type="checkbox" name="l" checked> Lunch</label> <label><input type="checkbox" name="d" checked> Dinner</label> <button>Save</button></form>
<table><tr><th>Date</th><th>B</th><th>L</th><th>D</th></tr>
<?php foreach(q("SELECT * FROM meal_planner WHERE student_id=? AND date>=CURDATE() ORDER BY date","i",$id) as $r)echo "<tr><td>".e($r['date'])."</td><td>".($r['breakfast']?'Yes':'No')."</td><td>".($r['lunch']?'Yes':'No')."</td><td>".($r['dinner']?'Yes':'No')."</td></tr>"; ?></table>
<?php foot();