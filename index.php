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
        fwrite ( $cb, "<div class='msgln'><i style="color:green">User " . $_SESSION ['name'] . " has joined the chat session.</i><br></div>" );
        fclose ( $cb );
    } else {
        echo '<span class="error">Walang pangalan ano ka SpermCell🤡</span>';
    }
}
 
if (isset ( $_GET ['logout'] )) {
    $cb = fopen ( "log.html", 'a' );
    fwrite ( $cb, "<div class='msgln'><i style="color:red">User " . $_SESSION ['name'] . " has left the chat session.</i><br></div>" );
    fclose ( $cb );
    session_destroy ();
    header ( "Location: index.php" );
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ChatUS - PUBLIC ROOM</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=0.8,user-scalable="no">
</head>
<body>
<?php
	if (! isset ( $_SESSION ['name'] )) {
	loginForm ();
	} else {
?>
<div id="wrapper">
	<div id="menu">
	<h1>ChatUS	!</h1><hr/>
		<p class="welcome">Hi <b><a><?php echo $_SESSION['name']; ?></a></b> Welcome dito☺️</p>
		<p class="logout"><a id="exit" href="#" class="btn btn-default">❌</a>
			<a id="dashboard" href="dashboard.php" class="btn btn-default">👤</a></p>
	<div style="clear: both"></div>
	</div>
	<div id="chatbox">
	<p>THIS FUCKING WEBSITE IS CREATED BY: REJARDLANGMAHINA</p>
	<?php
		if (file_exists ( "log.html" ) && filesize ( "log.html" ) > 0) {
		$handle = fopen ( "log.html", "r" );
		$contents = fread ( $handle, filesize ( "log.html" ) );
		fclose ( $handle );

		echo $contents;
		}
	?>
	</div>
<form name="message" action="">
	<input name="usermsg" class="form-control" type="text" id="usermsg" placeholder="💬" />
	<input name="submitmsg" class="btn btn-default" type="submit" id="submitmsg" value="Send" />
</form>
</div>
<div id="note">
<h3>NOTE:</h3>
<p align="justify">DO NOT CHAT YOUR PERSONAL INFORMATION LIKE CARD # , PASSWORDS ETC,</p>
<p align="justify">WALANG RULES DITO KAYA LAHAT PWEDE MONG GAWIN😝</p>
<p style="color:red,"> <strong>Paalala Mula sa Kupal na Gumawa neto</strong>🖕</p>
</div>
<script type="text/javascript">
$(document).ready(function(){
});
$(document).ready(function(){
    $("#exit").click(function(){
        var exit = confirm("Are You sure about that Haha");
        if(exit==true){window.location = 'index.php?logout=true';}     
    });
});
$("#submitmsg").click(function(){
        var clientmsg = $("#usermsg").val();
        $.post("post.php", {text: clientmsg});             
        $("#usermsg").attr("value", "");
        loadLog;
    return false;
});
function loadLog(){    
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
    $.ajax({
        url: "log.html",
        cache: false,
        success: function(html){       
            $("#chatbox").html(html);       
            var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
            if(newscrollHeight > oldscrollHeight){
                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal');
            }              
        },
    });
}
setInterval (loadLog, 2500);
</script>
<?php
}
?>
</body>
</html>