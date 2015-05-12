<?
define("PAGINA_TITEL"		,	"Taaktoevoegen");
define("PAGINA_NAAM"		,	"taaktoevoegen");
define("PAGINA_CATEGORIE"	, 	"taken");
define("USER_LEVEL", 4);
include(ROOT_WEBSITE."includes/header.php");	
$session = $_SESSION['userlevel'];
$userId  = $_SESSION['id'];
$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Taak wijzigen','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();
$document->checkUserlevel($session, USER_LEVEL);

$subteam = new subteam();
$subteams=$subteam->getSubTeamByLeader($userId);

?>

<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9">
		<div class="content">
			<div class="row">
				<div class="col-md-7">
					<legend>Taak wijzigen</legend>
					<form>
						<div class="row">
							<div class="col-md-10">
								<label>Categorie</label>
								<select class="form-control">
									<option>x</option>
									<option>x</option>
									<option>x</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-10">
								<label>Code</label>
								<input type="text" class="form-control" name="code" id="code" placeholder="code">		
							</div>
						</div>
						<div class="row">
							<div class="col-md-10">
								<label>Naam</label>
								<input type="text" class="form-control" name="naam" id="naam" placeholder="Naam">		
							</div>
						</div>
						<div class="row">
							<div class="col-md-10">
								<label>Omschrijving</label>
								<input type="text" class="form-control" name="omschrijving" id="omschrijving" placeholder="Omschrijving">		
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<label>Klokuren</label>
								<input type="text" class="form-control" name="klokuren" id="klokuren" placeholder="Klokuren">		
							</div>
							<div class="col-md-5">
								<label>Lesuren</label>
								<input type="text" class="form-control" name="lesuren" id="lesuren" placeholder="Lesuren">		
							</div>
						</div>	
						</div>
						<div class="col-md-5">
							<legend>Subteams</legend>
							<?  foreach ($subteams as $row){?>	
								<div class="checkbox">	
								    <input type="checkbox" value="<?=$row->id?>" id="<?=$row->id?>" ><label><?=$row->subteamnaam?></option>
								</div>
							<?}?>
							<div class="col-md-3" style="margin-top:20px">
								<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up"></span> Opslaan</button>	
							</div>
						</div>
					</form>
				</div>
			</div>
		</div><!--einde content-->
	</div>
</div>
<style> .subteamselect { min-height:295px; } </style>
<? 
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>
