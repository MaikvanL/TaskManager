<?

define("PAGINA_TITEL"		,	"Overzicht");
define("PAGINA_NAAM"		,	"overzicht");
define("PAGINA_CATEGORIE"	, 	"taak");

$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Taakverdeling');
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
			<h1 style="margin-top:0px;">Taakverdeling</h1>
			<? /*
			if (isset($_GET["var2"])) {

			if ($_GET['var2']=="updatestatus"){ ?> 
				<div id="confirm">
					<h4 style="text-align:center;">Weet je zeker dat je de status van deze gebruiker wilt wijzigen?</h4>
					<div style="width:200px; margin:0 auto; text-align:center;">
						<a style="padding:5px;" href="<?=HTTP?>gebruikersoverzicht/togglestatus/<?=$_GET['var3']?>">Ja</a> <a style="padding:5px;" href="<?=HTTP?>gebruikersoverzicht">Nee</a>
					</div>
				</div>
			<? }
			} */ ?>

			<hr>
			<table class="table table-hover">
				<thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>To-do</th>
                    <th class="verdeling">1659</th>
                    <th class="verdeling">1659</th>
                    <th class="verdeling">1161</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Assigned</th>
                    <th class="verdeling">1659</th>
                    <th class="verdeling">1659</th>
                    <th class="verdeling">1161</th>
                </tr>

                <tr>
                        <th>Taak</th>
						<th>Code</th>
                        <th>Opmerking</th>
                        <th>Klokuren</th>
                        <th class="verdeling">Huelbr</th>
                        <th class="verdeling">Branre</th>
                        <th class="verdeling">Schice</th>
					</tr>
				</thead>
				<tbody>
                    <tr>
                        <td>Directe Onderwijstijd</td>
                        <td>DOT</td>
                        <td></td>
                        <td></td>
                        <td class="verdeling"><input class="ureninput" type="text"></td>
                        <td class="verdeling"><input class="ureninput" type="text"></td>
                        <td class="verdeling"><input class="ureninput" type="text"></td>
                    </tr>
                    <tr>
                        <td>Voorbereiding & Nazorg</td>
                        <td>VoNa</td>
                        <td>50% van DOT</td>
                        <td>0,5</td>
                        <td class="verdeling"><input class="ureninput" type="text"></td>
                        <td class="verdeling"><input class="ureninput" type="text"></td>
                        <td class="verdeling"><input class="ureninput" type="text"></td>
					</tr>
                    <tr>
                        <td>Intake</td>
                        <td>INT</td>
                        <td>1 KU per deelnemer</td>
                        <td>30</td>
                        <td class="verdeling"><input class="ureninput" type="text"></td>
                        <td class="verdeling"><input class="ureninput" type="text"></td>
                        <td class="verdeling"><input class="ureninput" type="text"></td>
                    </tr>
                    <tr>
                        <td>Begeleiding individueel</td>
                        <td>BEG.IND</td>
                        <td>20-30 KU</td>
                        <td>20</td>
                        <td class="verdeling"><input class="ureninput" type="text"></td>
                        <td class="verdeling"><input class="ureninput" type="text"></td>
                        <td class="verdeling"><input class="ureninput" type="text"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="verdeling"><button type="button">Save</button></td>
                        <td class="verdeling"><button type="button">Save</button></td>
                        <td class="verdeling"><button type="button">Save</button></td>
                    </tr>

                </tbody>
			</table>
		</div>
	</div>
</div>


<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>