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
$document->load_metatags('Taak toevoegen','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();
$document->checkUserlevel($session, USER_LEVEL);

$taak = new Taak();
$subteam = new subteam();
$subteams=$subteam->overzicht();

if (isset($_GET['var2'])){
    $taak=$werknemer->getGebruiker($_GET['var2']);
}


?>

<div class="row">
    <div class="col-xs-12 col-md-3">
        <? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
    </div>
    <div class="col-md-9">
        <div class="content">
            <div class="row">
                <div class="col-md-7">
                    <legend>Taak toevoegen aan subteam</legend>
                    <?
                    if (isset($_POST['naam'])){

                        $createTaak = $taak->addTask($_POST);
                        if (!$createTaak){
                            $document->failed('Taak', 'toegevoegd');
                        }
                        else {
                            $document->success('Taak', 'toegevoegd');
                        }
                    }
                    ?>

                    <form method="post">
                        <div class="row">
                            <div class="col-md-10">
                                <label>Naam</label>
                                <input type="text" class="form-control" name="naam" id="naam" placeholder="Naam">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <label>Code</label>
                                <input type="text" class="form-control" name="code" id="code" placeholder="Code">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <label>Omschrijving</label>
                                <input type="text" class="form-control" name="omschrijving" id="omschrijving" placeholder="Omschrijving">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <label>Categorie</label>
                                <!-- Hier moet een foreach loop komen met de categorieën die later beheerbaar gemaakt zullen worden, tot die tijd handmatig invullen -->
                                <input type="text" class="form-control" name="categorie" id="categorie" placeholder="Naam">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <label>Klokuren</label>
                                <input type="number" class="form-control" name="klokuren" id="klokuren" placeholder="Klokuren">
                            </div>
                            <div class="col-md-5">
                                <label>Lesuren</label>
                                <input type="number" class="form-control" name="lesuren" id="lesuren" placeholder="Lesuren">
                            </div>
                        </div>
                </div>
                <div class="col-md-5">
                    <legend>Subteam</legend>
                    <select name="subteam" class="subteamselect" style="width:250px;">
                        <?  foreach ($subteams as $row){?>
                            <option id="<?=$row['st_id']?>" value="<?=$row['st_id']?>"><?=$row['subteamnaam']?></option>
                        <?}?>
                    </select>
                    <div style = "margin-top:20px">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up"></span> Opslaan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(".subteamselect").select2();
    $(function() {
        var spinner = $( "#klokuren").spinner();
        var spinner2 = $( "#lesuren").spinner();

    });





</script>
<style> .subteamselect { min-height:295px; } </style>
<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>
