</div>
<!-- /wrapper -->
			<!-- footer -->
			<footer class="footer" role="contentinfo">
				<div class="container-fluid">
					<div class="row">
					<!-- copyright -->
					<div class="copyright col-10">
						<?php bloginfo('name'); ?>
					</div>
					<!-- /copyright -->
					<div class="col-2">
						<?php echo do_shortcode('[gtranslate]'); ?>
					</div>
					</div>
				</div>
			</footer>
			<!-- /footer -->



		<?php wp_footer(); ?>

		<!-- analytics -->
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>

		<script type="text/javascript">
if (window.location.href=="https://domain.com") {
document.getElementById("gtranslate_wrapper").style.display = "none";
}
</script>

	</body>
</html>
