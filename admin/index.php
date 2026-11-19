<?php require '../config.php'; need_admin();
if(isset($_POST['del']))q("DELETE FROM students WHERE student_id=?","i",$_POST['del']);
head("Students",'a'); ?>
<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Room</th><th>Balance</th><th></th></tr>
<?php foreach(q("SELECT * FROM students ORDER BY student_id DESC") as $r)echo "<tr><td>".e($r['student_id'])."</td><td>".e($r['name'])."</td><td>".e($r['email'])."</td><td>".e($r['phone'])."</td><td>".e($r['room_no'])."</td><td>".e($r['balance'])."</td><td><form method='post' style='margin:0;padding:0;border:0' onsubmit=\"return confirm('Delete student?')\"><button name='del' value='".(int)$r['student_id']."'>Delete</button></form></td></tr>"; ?></table>
<?php foot();