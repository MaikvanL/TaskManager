<?
    $werknemer = new Werknemer();
    $user = $werknemer->getGebruiker($currentuserid);

?>

<div class="sidenav">
    <table style="font-size:14px;">
      <sup>Version: 0.2</sup>
            <?
         foreach ($user as $userrij){ ?>
        <tr>
            <td><strong><?=$userrij['aanhef']?> <?=$userrij['tussenvoegsel']?> <?=$userrij['achternaam']?></strong></td>
        </tr>
        <tr>
            <td><?=$userrij['functie']?></td>
        </tr>
        <? }?>
    </table>
	<hr style="margin-bottom:25px;">
	<ul class="nav nav-pills nav-stacked">
		<li class="<? if (PAGINA_NAAM == 'home') { echo 'active'; } ?>"><a href="<?=HTTP?>home"><span class="glyphicon glyphicon-home"></span>&nbsp; Home</a></li>
		<li class="<? if (PAGINA_NAAM == 'mijntaken') { echo 'active'; } ?>"><a href="#"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Mijn taken</a></li>
		<li class="<? if (PAGINA_NAAM == 'mijnplanning') { echo 'active'; } ?>"><a href="#"><span class="glyphicon glyphicon-calendar"></span>&nbsp; Mijn planning</a></li>
		<li class="<? if (PAGINA_NAAM == 'mijnregistratie') { echo 'active'; } ?>"><a href="#"><span class="glyphicon glyphicon-pencil"></span>&nbsp; Mijn registratie</a></li>
		<li class="<? if (PAGINA_NAAM == 'mijnprofiel') { echo 'active'; } ?>"><a href="<?=HTTP?>gebruikerswijzigen/<?=$currentuserid?>"><span class="glyphicon glyphicon-user"></span>&nbsp; Mijn profiel</a></li>
	</ul>
</div>
