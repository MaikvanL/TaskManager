		</div>
		<script>
		 	$.backstretch("<?=HTTP_WEBSITE?>images/layout/background.svg");
			$(document).ready(function(){
				$("#footer-top").click(function(){
					$("#footer-total").slideToggle("slow");
					
				});
			});
</script>
<div id="footer">
    	<div id="footer-top" class="button-footer social">
			<span class="glyphicon glyphicon-info-sign"></span> <span style="position:relative; top:-1px;">About</span>
		</div>
	<div id="footer-total">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<h3 style="margin:0px;">Opdrachtgever</h3>
					<h4 style="margin:0px;">Bram van Huele</h4>
					<h5 style="margin:0px;">Scalda College voor Techniek en Design</h5>
					<h6>Edisonweg, Vlissingen</h6>
				</div>
				<div class="col-md-4">
					<h3 style="margin-top:0px;">Opleiding</h3>
					<h5>Applicatieontwikkelaar</h5>
					<h6>Niveau 4</h6>
				</div>
				<div class="col-md-4">
					<h3 style="margin-top:0px;">Projectgroep</h3>
					<h5>Maik van Lieshout, Huberto van den Hoven </h5>
					<h6>Jeremy Muller, Jochem van Boven, Bryan den Hollander, Kevin Geertse, Elroy van Noort, Ivo Spoor</h6>
			</div>
		</div>
	</div>
</div>		

<style>
	#footer { position: fixed; bottom:0; width:100%;}
	#footer-top { background: rgba(255, 255, 255, 0.75); border-radius: 10px 10px 0 0; color: #777; font-size: 18px; line-height: 25px; margin: 0 auto; padding: 10px 15px; text-align: center; width: 200px; }
	#footer-top:hover { text-decoration: none !important;}
	#footer-total { display: none; width:100%; padding:5px; background:#64C371; border-top:1px solid #89BF05; color:#fff; height: 110px;}
	#flip { cursor: pointer; }
	#footer-total ul a li { float: left; list-style: none; margin:5px; padding: 0 10px; line-height: 22px; border: 1px solid #D4D4D4; color: }
	#footer-total ul a { color: #677982; text-decoration: none;}
	.button-footer { cursor: pointer; }
	@media only screen 
	and (min-width : 768px) 
	and (max-width : 1024px)  { #footer-total { height: 160px; } }
</style>