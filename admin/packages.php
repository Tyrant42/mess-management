<?php require '../config.php'; need_admin(); $m='';
if(isset($_POST['add']))q("INSERT INTO meal_packages(package_name,meal_count,price,validity_days) VALUES(?,?,?,?)","sidi",$_POST['name'],$_POST['meals'],$_POST['price'],$_POST['days']);
if(isset($_POST['del'])){try{q("DELETE FROM meal_packages WHERE package_id=?","i",$_POST['del']);}catch(Exception $x){$m="Cannot delete: students have bought this package.";}}
head("Packages",'a'); if($m)echo "<div class='msg'>$m</div>"; ?>
<form method="post"><input name="name" placeholder="Package name" required><input type="number" name="meals" placeholder="Meals" required><input type="number" step="0.01" name="price" placeholder="Price" required><input type="number" name="days" placeholder="Valid days" required><button name="add">Add</button></form>
<table><tr><th>Name</th><th>Meals</th><th>Price</th><th>Days</th><th></th></tr>
<?php foreach(q("SELECT * FROM meal_packages") as $r)echo "<tr><td>".e($r['package_name'])."</td><td>".e($r['meal_count'])."</td><td>".e($r['price'])."</td><td>".e($r['validity_days'])."</td><td><form method='post' style='margin:0;padding:0;border:0'><button name='del' value='".(int)$r['package_id']."'>Delete</button></form></td></tr>"; ?></table>
<?php foot();