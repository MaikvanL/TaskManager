<? 	
?>

<div class="sidenav">
	<h3 style="margin-top:15px;">Quickmenu</h3>
	<hr style="margin-bottom:25px;">
	<ul class="nav nav-pills nav-stacked">
		<li class="<? if (PAGINA_NAAM == 'home') { echo 'active'; } ?>"><a href="<?=HTTP?>home"><span class="glyphicon glyphicon-home"></span>&nbsp; Home</a></li>
		<li class="<? if (PAGINA_NAAM == 'mijntaken') { echo 'active'; } ?>"><a href="#"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Mijn taken</a></li>
		<li class="<? if (PAGINA_NAAM == 'mijnplanning') { echo 'active'; } ?>"><a href="#"><span class="glyphicon glyphicon-calendar"></span>&nbsp; Mijn planning</a></li>
		<li class="<? if (PAGINA_NAAM == 'mijnregistratie') { echo 'active'; } ?>"><a href="#"><span class="glyphicon glyphicon-pencil"></span>&nbsp; Mijn registratie</a></li>
		<li class="<? if (PAGINA_NAAM == 'mijnprofiel') { echo 'active'; } ?>"><a href="<?=HTTP?>gebruikerswijzigen/<?=$currentuserid?>"><span class="glyphicon glyphicon-user"></span>&nbsp; Mijn profiel</a></li>
	</ul>
</div>
