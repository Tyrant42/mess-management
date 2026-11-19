<?php require 'config.php'; $m='';
if($_POST){try{q("INSERT INTO students(name,email,phone,room_no,password) VALUES(?,?,?,?,?)","sssss",$_POST['name'],$_POST['email'],$_POST['phone'],$_POST['room'],password_hash($_POST['password'],PASSWORD_DEFAULT));header("Location: login.php");exit;}catch(Exception $x){$m="Email already registered.";}}
head("Student Registration"); if($m)echo "<div class='msg'>$m</div>"; ?>
<form method="post"><input name="name" placeholder="Name" required><input type="email" name="email" placeholder="Email" required><br>
<input name="phone" placeholder="Phone"><input name="room" placeholder="Room no"><input type="password" name="password" placeholder="Password" required><br><button>Register</button></form>
<?php foot();