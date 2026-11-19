<?php require 'config.php'; $m='';
if($_POST){$r=q("SELECT * FROM students WHERE email=?","s",$_POST['email']);
if($r&&password_verify($_POST['password'],$r[0]['password'])){$_SESSION['sid']=$r[0]['student_id'];header("Location: dashboard.php");exit;}$m="Wrong email or password.";}
head("Student Login"); if($m)echo "<div class='msg'>$m</div>"; ?>
<form method="post"><input type="email" name="email" placeholder="Email" required><input type="password" name="password" placeholder="Password" required><button>Login</button></form>
<a href="register.php">Create account</a>
<?php foot();
