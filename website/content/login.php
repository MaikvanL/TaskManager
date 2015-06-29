<?php
define("PAGINA_TITEL"		,	"Login");
define("PAGINA_NAAM"		,	"login");
define("PAGINA_CATEGORIE"	, 	"misc");
include(ROOT_WEBSITE."includes/databaseConnection.php");
session_start();


$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Login');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();


if($_SERVER["REQUEST_METHOD"] == "POST"){
	//je array splitsen
	
	$email1=mysql_real_escape_string($_POST['email']);
	$wachtwoord1=mysql_real_escape_string($_POST['wachtwoord']);
	$email=htmlspecialchars($email1);
	$wachtwoord=htmlspecialchars($wachtwoord1);
	
	//wachtwoord misschien nog encrypted???
	$sql="SELECT * FROM werknemer WHERE email='$email' and wachtwoord='$wachtwoord'";
	$result=mysql_query($sql);
	$count=mysql_num_rows($result);
	$row=mysql_fetch_array($result);



	if($count==1)
	{	
		$id=$row['wn_id'];
		$userlevel=$row['userlevel'];
		$sql="SELECT * FROM werknemer WHERE wn_id='$id'";
		$result=mysql_query($sql);
		$results=mysql_fetch_array($result);
		
		session_start();
		$_SESSION['login']="$email";
		$_SESSION['info']="$results";
		$_SESSION['id']="$id";
		$_SESSION['userlevel']="$userlevel";
		
		
		header("location: home");

	}
	else 
	{
	 ?><script>confirm("uw email of wachtwoord is verkeerd");</script><?
	}
}
?>




<div class="container">
	<div id="loginbox">
		<img id="logo" src="<?=HTTP_WEBSITE?>images/layout/scalda.png">
		<h1 class="title">Task Manager</h1>
		<div class="formbox">
			<form method="post" class="form-horizontal" role="form" action="">
			  <div class="form-group">
			    <div class="col-sm-12">
			      <input type="email" name="email" class="form-control" id="emailinput" placeholder="E-mail">
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-12">
			      <input type="password" name="wachtwoord" class="form-control" id="passwordinput" placeholder="Wachtwoord">
			    </div>
			  </div>
			  <button type="submit" class="btn btn-default" style="width:100%;">Log in</button>
			 </form>
		</div>
	</div>
</div>

<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>