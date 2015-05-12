<?
define("PAGINA_TITEL"		,	"Home");
define("PAGINA_NAAM"		,	"home");
define("PAGINA_CATEGORIE"	, 	"home");

// print_r($_SESSION);

$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Home','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();




include(ROOT_WEBSITE."includes/header.php");

?>

<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9 col-xs-12">
		<div class="content">
			<h1 style="margin-top:0px;">Home</h1>
			<hr>
			<p>Loream ipsum dolor sit amet, consectetur adipiscing elit. Ut non facilisis augue. Phasellus porttitor, est nec maximus suscipit, risus metus dignissim lectus, molestie cursus tellus neque id neque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sodales, velit at pretium consectetur, purus mauris lobortis ipsum, vel blandit odio lorem at lectus. Etiam sollicitudin arcu maximus placerat viverra. Aliquam et ultrices leo. Maecenas mauris nisi, consequat at sagittis in, tincidunt quis sem. In rutrum sapien quis malesuada accumsan. Phasellus eu enim a arcu semper egestas a vel est. Mauris vitae tortor at nisi dignissim lacinia nec ut mauris. Sed at augue dapibus, pharetra risus vel, fringilla mauris goeie dagschotel. Donec tincidunt eu nisi in venenatis. Duis nec lectus ipsum. Aenean lobortis consectetur nulla et molestie. Etiam tincidunt tempus ex, ut viverra velit dictum in. </p>
		</div>
	</div>
</div>

<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>