<?php require '../config.php'; need_admin();
if(isset($_POST['ok'])){$p=q("SELECT * FROM payments WHERE payment_id=? AND status='pending'","i",$_POST['ok']);
if($p){q("UPDATE payments SET status='approved' WHERE payment_id=?","i",$_POST['ok']);q("UPDATE students SET balance=balance+? WHERE student_id=?","di",$p[0]['amount'],$p[0]['student_id']);}}
if(isset($_POST['no']))q("UPDATE payments SET status='rejected' WHERE payment_id=? AND status='pending'","i",$_POST['no']);
head("Payments",'a'); ?>
<table><tr><th>Student</th><th>Amount</th><th>Method</th><th>Txn ID</th><th>Status</th><th></th></tr>
<?php foreach(q("SELECT p.*,s.name FROM payments p JOIN students s ON s.student_id=p.student_id ORDER BY p.payment_id DESC") as $r){echo "<tr><td>".e($r['name'])."</td><td>".e($r['amount'])."</td><td>".e($r['method'])."</td><td>".e($r['transaction_id'])."</td><td>".e($r['status'])."</td><td>";
if($r['status']=='pending')echo "<form method='post' style='margin:0;padding:0;border:0'><button name='ok' value='".(int)$r['payment_id']."'>Approve</button> <button name='no' value='".(int)$r['payment_id']."'>Reject</button></form>";echo "</td></tr>";} ?></table>
<?php foot();