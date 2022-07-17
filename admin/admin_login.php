<?php
	if(gpcget('submit')=='true'){
		if(authcode($_G['user']['password'])!=gpcget('password')){
			amsg('login_password_error');
		}
		$_SESSION['in_cp']=true;
		amsg('login_success','admin.php?mod=powerboard#index');
	}
?>
<form method="post" action="<?=$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']?>">
	<div class="div_father">
		<div class="div_title"><?=$cplang['login_to_admin']?></div>
		<div class="div_content">
			<table class="set" border="1">
				<tr>
					<td colspan="2"><?=$cplang['welcome_msg']?><br></td>
				</tr>
				<tr>
					<td style="width:40%;"><?=$cplang['username']?></td>
					<td><?=$_G['user']['username']?></td>
				</tr>
				<tr>
					<td><?=$cplang['password']?></td>
					<td><?=showinput('password','password')?></td>
				</tr>
			</table>
		</div>
	</div>
	<?=showinput('hidden','submit',null,'true')?>
	<p class="c"><?=showinput('submit',null,null,'submit')?></p>
</form>