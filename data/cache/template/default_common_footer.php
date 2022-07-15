<?php if(!defined('IN_POWERBOARD')){die();}?>		<div id="footer">
			版权所有 <?php echo $_G['config']['startyear'];?>-<?php echo date('Y')?> &copy;<?php echo $_G['config']['bbname'];?><br>
			Powered by PowerBoard <?php echo POWERBOARD_VERSION?><br>
			GZip<?php echo $_G['config']['gzip']?'启用':'停用' ?>
		</div>
		<script>
			lazyload();
			window.onscroll=function(){
				lazyload();
			}
		</script>
	</body>
</html>