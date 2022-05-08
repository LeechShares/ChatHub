<?php
session_start ();
function loginForm() {
    echo '
	<div class="form-group">
		<div id="loginform">
			<form action="index.php" method="post">
			<h1>Welcome to ChatUS!</h1><hr/>
				<label for="name">Ano pwede itawag sayu lods☺️.</label>
				<input type="text" name="name" id="name" class="form-control" placeholder="Your Nickname"/>
				<input type="submit" class="btn btn-default" name="enter" id="enter" value="Enter" />
			</form>
		</div>
	</div>
   ';
}
 
if (isset ( $_POST ['enter'] )) {
    if ($_POST ['name'] != "") {
        $_SESSION ['name'] = stripslashes ( htmlspecialchars ( $_POST ['name'] ) );
        $cb = fopen ( "log.html", 'a' );
        fwrite ( $cb, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has joined the chat session.</i><br></div>" );
        fclose ( $cb );
    } else {
        echo '<span class="error">Please Enter a Name</span>';
    }
}
 
if (isset ( $_GET ['logout'] )) {
    $cb = fopen ( "log.html", 'a' );
    fwrite ( $cb, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has left the chat session.</i><br></div>" );
    fclose ( $cb );
    session_destroy ();
    header ( "Location: index.php" );
}
?>
<!DOCTYPE html>
 <html>
 <head>
	 <title>MENU</title>
	 <meta charset="UTF-8"/>
<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	  <meta name="viewport" content="width=device-width,height=device-height, initial-scale=0.8, user-scalable=no,">
	<script type="text/javascript" src="js/jquery.min.js"></script>
 </head>
	 <body>
	 <?php
	if (! isset ( $_SESSION ['name'] )) {
	loginForm ();
	} else {
?>
<div id="wrapper">
	<div id="menu">
			<p class="logout"><a id="exit" href="#" class="btn btn-default">❌</a>
			<a id="dashboard" href="index.php" class="btn btn-default">💬</a></p>
			<br>
			<br>
	<h1>DASHBOARD</h1><hr/>
		<p class="welcome">Welcome <b><a><?php echo $_SESSION['name']; ?></a></b> Alam mo bang may mga secreto dito sa site nato</p>
		<p>bakit dimo subukang mag ikot dito🔥</p>

		<TABLE BORDER="4" CELLPADDING="8" textsize="13px"> <TR ALIGN="left"> <TD VALIGN="middle"><a href="">BrowserGAMES🎮</a><TD> <TD VALIGN="middle"><a href="">FREENET APP🎭</a><TD> <TD VALIGN="middle"><a href="">EARNING APP🎟️</a><TD> </TR> </TABLE>
			
			</form>
		</div>
	</div>	 
	<p>temporary ni mga ser</p>
	 </body>
	 <?php
}
?>
 </html>