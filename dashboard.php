<?php require 'config.php'; need_student(); $id=$_SESSION['sid']; $m='';
if($_POST){q("INSERT INTO payments(student_id,amount,method,transaction_id) VALUES(?,?,?,?)","idss",$id,$_POST['amount'],$_POST['method'],$_POST['txn']);$m="Request sent. Balance updates after admin approval.";}
$s=q("SELECT * FROM students WHERE student_id=?","i",$id)[0];
$sub=q("SELECT s.*,p.package_name FROM subscriptions s JOIN meal_packages p ON p.package_id=s.package_id WHERE s.student_id=? AND s.status='active' ORDER BY s.subscription_id DESC","i",$id);
$pay=q("SELECT * FROM payments WHERE student_id=? ORDER BY payment_id DESC LIMIT 10","i",$id);
head("Welcome, ".$s['name'],'s'); if($m)echo "<div class='msg'>$m</div>"; ?>
<div class="box">Room: <?=e($s['room_no'])?> | Balance: <b><?=e($s['balance'])?></b></div>
<h3>Add money</h3><form method="post"><input type="number" step="0.01" name="amount" placeholder="Amount" required>
<select name="method"><option>bKash</option><option>Nagad</option><option>Cash</option></select><input name="txn" placeholder="Transaction ID"><button>Request</button></form>
<h3>Active packages</h3><table><tr><th>Package</th><th>Meals left</th><th>Expiry</th></tr>
<?php foreach($sub as $r)echo "<tr><td>".e($r['package_name'])."</td><td>".e($r['meals_remaining'])."</td><td>".e($r['expiry_date'])."</td></tr>"; ?></table>
<h3>Recent payments</h3><table><tr><th>Date</th><th>Amount</th><th>Method</th><th>Status</th></tr>
<?php foreach($pay as $r)echo "<tr><td>".e($r['payment_date'])."</td><td>".e($r['amount'])."</td><td>".e($r['method'])."</td><td>".e($r['status'])."</td></tr>"; ?></table>
<?php foot();