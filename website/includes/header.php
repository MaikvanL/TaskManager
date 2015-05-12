<div class="container">
	<section id="header">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<nav class="navbar navbar-default" role="navigation">
				  <div class="container-fluid">
					  <div class="col-md-1"><img src="http://www.scalda.nl/images/sda/images/logo.png" height="30" style="margin-top:10px;"></div>
					  <div class="navbar-header" style="margin-left:40px;">
				      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <a class="navbar-brand" href="<?=HTTP?>home">Task Manager</a>
				    </div>
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      <ul class="nav navbar-nav navbar-right">
				        <li><a href="#" class="<? if (PAGINA_CATEGORIE == 'weekoverzicht') { echo 'active'; } ?>"><span class="glyphicon glyphicon-calendar"></span>&nbsp;Weekoverzicht</a></li>
				        <li class="dropdown <? if (PAGINA_CATEGORIE == 'taak') { echo 'active'; } ?>">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Taakbeheer<span class="caret"></span></a>
				          <ul class="dropdown-menu" role="menu">
				            <li><a href="<?=HTTP?>taaktoevoegen"><span class="glyphicon glyphicon-plus"></span>&nbsp; Taak toevoegen</a></li>
				            <li class="divider"></li>
				            <li><a href="<?=HTTP?>taakoverzicht"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Taakoverzicht</a></li>
				          </ul>
				        </li>
				       <li class="dropdown <? if (PAGINA_CATEGORIE == 'gebruiker') { echo 'active'; } ?>">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>&nbsp; Gebruikersbeheer<span class="caret"></span></a>
				          <ul class="dropdown-menu" role="menu">
				            <li><a href="<?=HTTP?>gebruikerstoevoegen"><span class="glyphicon glyphicon-plus"></span>&nbsp; Gebruiker toevoegen</a></li>
				            <li class="divider"></li>
				            <li><a href="<?=HTTP?>gebruikersoverzicht"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Gebruikersoverzicht</a></li>
				            <!--<li class="divider"></li>
				            <li><a href="<?=HTTP?>userlevelmanagement">Userlevel management</a></li>-->
				          </ul>
				        </li>
				        <li class="dropdown <? if (PAGINA_CATEGORIE == 'team') { echo 'active'; } ?>">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-eye-open"></span>&nbsp; Teambeheer<span class="caret"></span></a>
				          <ul class="dropdown-menu" role="menu">
				            <li><a href="<?=HTTP?>teamtoevoegen"><span class="glyphicon glyphicon-plus"></span>&nbsp; Team toevoegen</a></li>
				            <li><a href="<?=HTTP?>teamoverzicht"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Team overzicht</a></li>
				            <li class="divider"></li>
				            <li><a href="<?=HTTP?>subteamtoevoegen"><span class="glyphicon glyphicon-plus"></span>&nbsp; Subteam toevoegen</a></li>
				            <li><a href="<?=HTTP?>subteamoverzicht"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Subteam overzicht</a></li>

				           <!-- <li><a href="<?=HTTP?>teammanagement">Team management</a></li>-->
				          </ul>
				        </li>

				        <li><a href ="<?=HTTP?>logout"><span class="glyphicon glyphicon-lock"></span>&nbsp;Loguit</a></li>
				        
				      </ul>
				  </div>
				</nav>
			</div>
		</div>
	</section>
