<?

define("PAGINA_TITEL"		,	"Vakantie toevoegen");
define("PAGINA_NAAM"		,	"vakantietoevoegen");
define("PAGINA_CATEGORIE"	, 	"taak");
define("USER_LEVEL", 4);
include(ROOT_WEBSITE."includes/header.php");
$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Vakantie toevoegen','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();
$jaar = new School();

if (isset($_POST['naam'])){
    $maakVakantie = $jaar->addHoliday($_POST);
    if (!$maakVakantie){
        $document->failed('Vakantie','toegevoegd');
    }
    else {
        $document->success('Vakantie', 'toegevoegd');
    }
}

?>

<div class="row">
    <div class="col-xs-12 col-md-3">

        <? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
    </div>
    <div class="col-md-9">
        <div class="content">
            <form method="post" action="">
                <div class="row">
                    <div class="col-md-6">
                        <legend>Naam</legend>
                        <input type="text" name="naam" placeholder="xxxx-xxxx" required>
                        <legend class="margin-top-10">Start vakantie</legend>
                        <input type="text" id="start" name="start" placeholder="dd-mm-yyyy" required>
                        <legend class="margin-top-10">Eind vakantie</legend>
                        <input type="text" id="end" name="end" placeholder="dd-mm-yyyy" required>
                        <legend class="margin-top-10">Schooljaar</legend>
                        <select class="form-control" name="schooljaar" id="schooljaar" placeholder="Schooljaar" required>
                            <?
                            $result = $jaar->allYears();
                            foreach ($result as $row) {  ?>
                                <option value="<?=$row['schooljaar_id']?>"><?=$row['naam']?></option>
                            <? } ?>
                        </select>

                        <button type="submit" class="btn btn-default margin-top-20">Submit</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    <script>
        $(function(){ $("#start").datepicker({
                dateFormat: 'dd-mm-yy',
                onClose: function( selectedDate ) {
                    $( "#end" ).datepicker( "option", "minDate", selectedDate );
                }
            }
        );  });
        $(function(){ $("#end").datepicker({
                dateFormat: 'dd-mm-yy',
                onClose: function( selectedDate ) {
                    $( "#start" ).datepicker( "option", "maxDate", selectedDate );
                }
            }
        );  });
    </script>

<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>