<?php
require "include/bittorrent.php";
dbconn();
loggedinorreturn();
require_once(get_langfile_path());
if (get_user_class() < UC_ADMINISTRATOR)
stderr("Sorry", "Access denied.");
stdhead("Add Upload", false);
?>
<div class=main width=737 border=0 cellspacing=0 cellpadding=0><div><div class=embedded>
<div align=center>
<h1><?php echo $lang_amountupload['head_add_upload']?></a></h1>
<form method=post action=takeamountupload.php>
<?php

if ($_GET["returnto"] || $_SERVER["HTTP_REFERER"])
{
?>
<input type=hidden name=returnto value="<?php echo htmlspecialchars($_GET["returnto"]) ? htmlspecialchars($_GET["returnto"]) : htmlspecialchars($_SERVER["HTTP_REFERER"])?>">
<?php
}
?>
<div cellspacing=0 cellpadding=5>
<?php
if ($_GET["sent"] == 1) {
?>
<div><div colspan=2 class="text" align="center"><font color=red><b><?php echo $lang_amountupload['text_add_done']?></font></b></div></div>
<?php
}
?>
<div><div class="rowhead" valign="top"><?php echo $lang_amountupload['text_amount']?></div><div class="rowfollow"><input type=text name=amount size=10><?php echo $lang_amountupload['text_unit']?></div></div>
<div>
<div class="rowhead" valign="top"><?php echo $lang_amountupload['text_usergroup']?></div><div class="rowfollow">
  <div style="border: 0" width="100%" cellpadding="0" cellspacing="0">
    <div>
             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="0">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_peasant']?></div>

             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="1">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_user']?></div>

             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="2">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_power_user']?></div>

             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="3">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_elite_user']?></div>
      </div>
    <div>
             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="4">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_crazy_user']?></div>

             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="5">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_insane_user']?></div>

             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="6">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_veteran_user']?></div>

             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="7">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_extreme_user']?></div>
      </div>

    <div>
             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="8">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_ultimate_user']?></div>

             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="9">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_nexus_master']?></div>

             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="10">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_vip']?></div>

             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="11">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_uploader']?></div>
      </div>

    <div>
             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="12">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_moderators']?></div>

             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="13">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_administrators']?></div>

             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="14">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_sysops']?></div>

             <div style="border: 0" width="20"><input type="checkbox" name="clases[]" value="15">
             </div>
             <div style="border: 0"><?php echo $lang_functions['text_staff_leader']?></div>
	
       <div style="border: 0">&nbsp;</div>
       <div style="border: 0">&nbsp;</div>
      </div>
    </div>
  </div>
</div>
<div><div class="rowhead" valign="top"><?php echo $lang_amountupload['text_subject']?></div><div class="rowfollow"><input type=text name=subject size=82></div></div>
<div><div class="rowhead" valign="top"><?php echo $lang_amountupload['text_reason']?></div><div class="rowfollow"><textarea name=msg cols=80 rows=5><?php echo $body?></textarea></div></div>
<div>
<div class="rowfollow" colspan=2><div align="center"><b><?php echo $lang_amountupload['text_operator']?></b>
<?php echo $CURUSER['username']?>
<input name="sender" type="radio" value="self" checked>
&nbsp; System
<input name="sender" type="radio" value="system">
</div></div></div>
<div><div class="rowfollow" colspan=2 align=center><input type=submit value="<?php echo $lang_amountupload['submit_do']?>" class=btn></div></div>
</div>
<input type=hidden name=receiver value=<?php echo $receiver?>>
</form>

 </div></div></div></div>
<br />
<?php echo $lang_amountupload['text_note']?>
<?php
stdfoot();
