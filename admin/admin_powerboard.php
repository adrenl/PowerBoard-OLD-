<?php
	if(gpcget('submit')=='1'){
	}
?>
<div class="div_father" id="index">
	<div class="div_title"><?=$cplang['menu_index']?></div>
	<div class="div_content">
		<table class="set" border="1">
			<tr>
				<td style="width:40%;"><?=$cplang['index_os']?></td>
				<td><?=PHP_OS?></td>
			</tr>
			<tr>
				<td><?=$cplang['index_php']?></td>
				<td><?=PHP_VERSION?></td>
			</tr>
			<tr>
				<td><?=$cplang['index_powerboard_ver']?></td>
				<td><?=POWERBOARD_VERSION.' '.POWERBOARD_RELEASE?></td>
			</tr>
			<tr>
				<td><?=$cplang['index_data_size']?></td>
				<td>
					<?php
						if(gpcget('showdatasize')=='1'){
							echo sizecount(getdirsize('data'));
						}else{
							echo '<a href="admin.php?mod=powerboard&showdatasize=1#index">'.$cplang['show'].'</a>';
						}
					?>
				</td>
			</tr>
		</table>
	</div>
</div>
<form method="post" action="<?=$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']?>">
	<div class="div_father" id="basic">
		<div class="div_title"><?=$cplang['menu_basic']?></div>
		<div class="div_content">
			<table class="set" border="1">
				<tr>
					<td style="width:40%;"><strong><?=$cplang['basic_bbname']?></strong><br><?=$cplang['basic_bbname_d']?></td>
					<td><?=showinput('text','bbname','',$_G['config']['bbname'])?></td>
				</tr>
				<tr>
					<td><strong><?=$cplang['basic_bburl']?></strong><br><?=$cplang['basic_bburl_d']?></td>
					<td><?=showinput('text','bburl','',$_G['config']['bburl'])?></td>
				</tr>
				<tr>
					<td><strong><?=$cplang['basic_close']?></strong><br><?=$cplang['basic_close_d']?></td>
					<td><?=showradio('isclose',$_G['config']['close']['isclose'])?></td>
				</tr>
				<tr>
					<td><strong><?=$cplang['basic_close_why']?></strong><br><?=$cplang['basic_close_why_d']?></td>
					<td><?=showtextarea('whyclose','',$_G['config']['close']['why'])?></td>
				</tr>
			</table>
		</div>
	</div>
	<?=showinput('hidden','submit','','true')?>
	<?=showinput('hidden','action','','basic')?>
	<p class="c"><?=showinput('submit','','','submit')?></p>
</form>
<form method="post" action="<?=$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']?>">
	<div class="div_father" id="login_register">
		<div class="div_title"><?=$cplang['menu_login_register']?></div>
		<div class="div_content">
			<table class="set" border="1">
				<tr>
					<td style="width:40%;"><strong><?=$cplang['lgrg_canregister']?></strong><br><?=$cplang['lgrg_canregister_d']?></td>
					<td><?=showradio('canregister',$_G['config']['user']['canregister'])?></td>
				</tr>
				<tr>
					<td><strong><?=$cplang['lgrg_savekey']?></strong><br><?=$cplang['lgrg_savekey_d']?></td>
					<td><?=showtextarea('savekey','',$_G['config']['user']['savekey'])?></td>
				</tr>
				<tr>
					<td><strong><?=$cplang['lgrg_once_email']?></strong><br><?=$cplang['lgrg_once_email_d']?></td>
					<td><?=showradio('once_email',$_G['config']['user']['once_email'])?></td>
				</tr>
				<tr>
					<td><strong><?=$cplang['lgrg_censoremail']?></strong><br><?=$cplang['lgrg_censoremail_d']?></td>
					<td><?=showtextarea('censoremail',null,$_G['config']['user']['censoremail'])?></td>
				</tr>
				<tr>
					<td><strong><?=$cplang['lgrg_newbiespan']?></strong><br><?=$cplang['lgrg_newbiespan_d']?></td>
					<td><?=showinput('number','newbiespan','',$_G['config']['user']['newbiespan'])?></td>
				</tr>
				<tr>
					<td><strong><?=$cplang['lgrg_sendu2u']?></strong><br><?=$cplang['lgrg_sendu2u_d']?></td>
					<td><?=showtextarea('sendu2u',null,$_G['config']['user']['sendu2u'])?></td>
				</tr>
				<tr>
					<td><strong><?=$cplang['lgrg_showbbrules']?></strong><br><?=$cplang['lgrg_showbbrules_d']?></td>
					<td><?=showtextarea('showbbrules',null,$_G['config']['user']['showbbrules'])?></td>
				</tr>
			</table>
		</div>
	</div>
	<?=showinput('hidden','submit',null,'true')?>
	<?=showinput('hidden','action',null,'login_register')?>
	<p class="c"><?=showinput('submit',null,null,'submit')?></p>
</form>