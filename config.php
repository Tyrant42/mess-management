<?php
session_start();
$conn = new mysqli("localhost","root","","mess_management");
function e($s){return htmlspecialchars((string)$s);}
function q($sql,$t='',...$p){global $conn;$s=$conn->prepare($sql);if($t)$s->bind_param($t,...$p);$s->execute();$r=$s->get_result();return $r?$r->fetch_all(MYSQLI_ASSOC):[];}
function need_student(){if(empty($_SESSION['sid'])){header("Location: login.php");exit;}}
function need_admin(){if(empty($_SESSION['aid'])){header("Location: login.php");exit;}}
function head($t,$m=''){$P=($m=='a'||$m=='x')?'../':'';
echo "<!DOCTYPE html><html><head><meta charset='utf-8'><meta name='viewport' content='width=device-width,initial-scale=1'><title>".e($t)."</title><link rel='stylesheet' href='{$P}style.css'></head><body><nav><b>Mess Manager</b>";
if($m=='s')echo "<a href='dashboard.php'>Dashboard</a><a href='packages.php'>Packages</a><a href='planner.php'>Planner</a><a href='menu.php'>Menu</a><a href='logout.php'>Logout</a>";
if($m=='a')echo "<a href='index.php'>Students</a><a href='payments.php'>Payments</a><a href='packages.php'>Packages</a><a href='menu.php'>Menu</a><a href='../logout.php'>Logout</a>";
echo "</nav><main><h2>".e($t)."</h2>";}
function foot(){echo "</main></body></html>";}