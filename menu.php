<?php require 'config.php'; need_student(); $id=$_SESSION['sid']; $m=''; $d=$_GET['date']??date('Y-m-d');
if($_POST){q("INSERT INTO meal_ratings(student_id,date,meal_type,rating,comment) VALUES(?,?,?,?,?)","issis",$id,$d,$_POST['type'],$_POST['rating'],$_POST['comment']);$m="Thanks for your rating!";}
$r=q("SELECT * FROM daily_menu WHERE date=?","s",$d);
head("Daily Menu",'s'); if($m)echo "<div class='msg'>$m</div>"; ?>
<form method="get"><input type="date" name="date" value="<?=e($d)?>"><button>Show</button></form>
<?php if($r){$r=$r[0];echo "<div class='box'><b>Breakfast:</b> ".e($r['breakfast'])."<br><b>Lunch:</b> ".e($r['lunch'])."<br><b>Dinner:</b> ".e($r['dinner'])."</div>";}else echo "<div class='box'>No menu for this date.</div>"; ?>
<h3>Rate a meal (<?=e($d)?>)</h3><form method="post"><select name="type"><option>breakfast</option><option>lunch</option><option>dinner</option></select>
<select name="rating"><?php for($i=5;$i>=1;$i--)echo "<option>$i</option>"; ?></select><input name="comment" placeholder="Comment" maxlength="255"><button>Submit</button></form>
<?php foot();
