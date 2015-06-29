<?

define("PAGINA_TITEL"		,	"Toevoegen");
define("PAGINA_NAAM"		,	"jaartoevoegen");
define("PAGINA_CATEGORIE"	, 	"taak");
define("USER_LEVEL", 4);
include(ROOT_WEBSITE."includes/header.php");
$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Jaar toevoegen','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();
$jaar = new School();

if (isset($_POST['naam'])){
    $maakJaar = $jaar->addYear($_POST);
    if (!$maakJaar){
        $document->failed('Jaar','toegevoegd');
    }
    else {
        $document->success('Jaar', 'toegevoegd');
    }
}

?>

<div class="row">
    <div class="col-xs-12 col-md-3">

        <div class="sidenav" style="margin-bottom:30px;padding:15px;">
            <h5>Bestaande jaren:</h5>
            <table>
                <tbody>
                <?
                $result = $jaar->allYears();
                foreach ($result as $row) {
                    ?>
                    <tr>
                        <td><?=$row['naam']?></td>
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
                <div class="row">
                    <div class="col-md-6">
                        <legend>Naam</legend>
                        <input type="text" name="naam" placeholder="xxxx-xxxx" required>
                        <legend class="margin-top-10">Start schooljaar</legend>
                        <input type="text" id="start" name="start" placeholder="dd-mm-yyyy" required>
                        <legend class="margin-top-10">Eind schooljaar</legend>
                        <input type="text" id="end" name="end" placeholder="dd-mm-yyyy" required>
                        <legend class="margin-top-10">Urennorm</legend>
                        <input type="text" id="urennorm" name="urennorm" placeholder="2000" required>
                        <button type="submit" class="btn btn-default">Submit</button>

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