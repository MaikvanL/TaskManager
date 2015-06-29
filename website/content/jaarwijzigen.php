<?

define("PAGINA_TITEL"		,	"Instellingen");
define("PAGINA_NAAM"		,	"instellingen");
define("PAGINA_CATEGORIE"	, 	"instellingen");
define("USER_LEVEL", 4);
include(ROOT_WEBSITE."includes/header.php");
$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Instellingen','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();

$school = new School();

if (isset($_POST['schooljaar_id'])){
    $wijzigJaar = $school->editYear($_POST);
    if (!$wijzigJaar){
        $document->failed('Schooljaar', 'gewijzigd');
    }
    else {
        $document->success('Schooljaar', 'gewijzigd');
    }
}
if (isset($_GET['var2'])){
    $jaar=$school->getYear($_GET['var2']);
}


foreach ($jaar as $row) {

?>

<div class="row">
    <div class="col-xs-12 col-md-3">

        <div class="sidenav" style="margin-bottom:30px;padding:15px;">
            <h5>Bestaande jaren:</h5>
            <table>
                <tbody>
                <?
                $results = $school->allYears();
                foreach ($results as $result) {
                    ?>
                    <tr>
                        <td><?=$result['naam']?></td>
                    </tr>
                <? } ?>
                </tbody>
            </table>
        </div>
        <? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
    </div>
    <div class="col-md-9">
    <div class="content">
        <form method="post" action="">
            <input type="hidden" value="<?=$row['schooljaar_id']?>" name="schooljaar_id">
            <div class="row">
                <div class="col-md-6">
                    <legend>Naam</legend>
                    <input type="text" name="naam" value="<?=$row['naam']?>" placeholder="xxxx-xxxx" required>
                    <legend class="margin-top-10">Start schooljaar</legend>
                    <input type="text" id="start" value="<?=$document->convertFromSQLDate($row['start'])?>" name="start" placeholder="dd-mm-yyyy" required>
                    <legend class="margin-top-10">Eind schooljaar</legend>
                    <input type="text" id="end" value="<?=$document->convertFromSQLDate($row['end'])?>" name="end" placeholder="dd-mm-yyyy" required>
                    <legend class="margin-top-10">Urennorm</legend>
                    <input type="text" id="urennorm" value="<?=$row['urennorm']?>" name="urennorm" placeholder="2000" required>
                    <button type="submit" class="btn btn-default">Submit</button>

                </div>
            </div>
        </form>


    </div>
    </div>
</div>
<? } ?>
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