<?php
require "include/bittorrent.php";
dbconn();
loggedinorreturn();
require_once(get_langfile_path());
if (get_user_class() < UC_SYSOP)
stderr("Error", "Permission denied.");
$class = 0 + $_POST["class"];
	if ($class)
		int_check($class,true);
$or = $_POST["or"];

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$res = sql_query("SELECT id, username, email FROM users WHERE class $or ".mysql_real_escape_string($class)) or sqlerr(__FILE__, __LINE__);

$subject = substr(htmlspecialchars(trim($_POST["subject"])), 0, 80);
if ($subject == "") $subject = "(no subject)";
$subject = "Fw: $subject";

$message1 = htmlspecialchars(trim($_POST["message"]));
if ($message1 == "") stderr("Error", "Empty message!");

while($arr=mysql_fetch_array($res)){

$to = $arr["email"];


$message = "Message received from ".$SITENAME." on " . date("Y-m-d H:i:s") . ".\n" .
"---------------------------------------------------------------------\n\n" .
$message1 . "\n\n" .
"---------------------------------------------------------------------\n$SITENAME\n";

$success = sent_mail($to,$SITENAME,$SITEEMAIL,$subject,$message,"Mass Mail",false);	
}


if ($success)
stderr("Success", "Messages sent.");
else
stderr("Error", "Try again.");

}

stdhead("Mass E-mail Gateway");
?>

<p><div border=0 class=main cellspacing=0 cellpadding=0><div>
<div class=embedded style='padding-left: 10px'><font size=3><b><?php echo $lang_massmail['head_massmail']?></b></font></div>
</div></div></p>
<div border=1 cellspacing=0 cellpadding=5>
<form method=post action=massmail.php>

<?php
if (get_user_class() == UC_MODERATOR && $CURUSER["class"] > UC_POWER_USER)
printf("<input type=hidden name=class value=$CURUSER[class]\n");
else
{
print("<div><div class=rowhead>".$lang_massmail['text_classe']."</div><div colspan=2 align=left><select name=or><option value='<'><<option value='>'>><option value='='>=<option value='<='><=<option value='>='>>=</select><select name=class>\n");
if (get_user_class() == UC_MODERATOR)
$maxclass = UC_POWER_USER;
else
$maxclass = get_user_class() - 1;
for ($i = 0; $i <= $maxclass; ++$i)
print("<option value=$i" . ($CURUSER["class"] == $i ? " selected" : "") . ">$prefix" . get_user_class_name($i,false,true,true) . "\n");
print("</select></div></div>\n");
}
?>


<div><div class=rowhead><?php echo $lang_massmail['text_subject']?></div><div><input type=text name=subject size=80></div></div>
<div><div class=rowhead><?php echo $lang_massmail['text_body']?></div><div><textarea name=message cols=80 rows=20></textarea></div></div>
<div><div colspan=2 align=center><input type=submit value="<?php echo $lang_massmail['submit_send']?>" class=btn></div></div>
</form>
</div>

<?php
stdfoot();
