<?php
require "include/bittorrent.php";
dbconn();
if (get_user_class() < UC_ADMINISTRATOR)
stderr("Error", "Permission denied.");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$userid = trim($_POST["userid"]);

if (!$userid)
  stderr("Error", "Please fill out the form correctly.");

$res = sql_query("SELECT * FROM users WHERE id=" . sqlesc($userid)) or sqlerr();
if (mysql_num_rows($res) != 1)
  stderr("Error", "Bad user id or password. Please verify that all entered information is correct.");
$arr = mysql_fetch_assoc($res);

$id = $arr['id'];
$name = $arr['username'];
$res = sql_query("DELETE FROM users WHERE id=$id") or sqlerr();
record_op_log($CURUSER['id'],$id,htmlspecialchars($name),'del','');
if (mysql_affected_rows() != 1)
  stderr("Error", "Unable to delete the account.");
stderr("Success", "用户：".htmlspecialchars($name)."</b> 删除成功",false);
}
stdhead("Delete account");
?>
<h1>Delete account</h1>
<div border=1 cellspacing=0 cellpadding=5>
<form method=post action=delacctadmin.php>
<div><div class=rowhead>User name</div><div><input size=40 name=userid></div></div>

<div><div colspan=2><input type=submit class=btn value='Delete'></div></div>
</form>
</div>
<?php
stdfoot();
