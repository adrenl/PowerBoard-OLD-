<?php if(!defined('IN_POWERBOARD')){die();}?>			<div data-role="footer">
				<h1>版权所有 <?php echo $_G['config']['startyear'];?>-<?=date('Y')?> &copy;<?php echo $_G['config']['bbname'];?><br>
				Powered by PowerBoard <?=POWERBOARD_VERSION?><br>
				GZip<?=$_G['config']['gzip']?'启用':'停用' ?></h1>
			</div>
		</div>
		<script>
			lazyload();
			window.onscroll=function(){
				lazyload();
			}
		</script>
	</body>
</html>