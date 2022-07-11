<?php if(!defined('IN_POWERBOARD')){die();}?>		<div id="footer">
			<hr>
			版权所有 <?php echo $_G['config']['startyear'];?>-<?=date('Y')?> &copy;<?php echo $_G['config']['bbname'];?><br>
			Powered by PowerBoard <?=POWERBOARD_VERSION?><br>
			GZip<?=$_G['config']['gzip']?'启用':'停用' ?>
		</div>
		<script>
			window.onscroll=function(){
				try{lazyload();}catch(e){}
			}
		</script>
	</body>
</html>