<?php
	
	require_once ( 'libs/database.class.php' );
	require_once ( 'libs/utility.class.php' );
	require_once ( 'libs/phpmailer.class.php' );
	require_once ( 'libs/authentication.class.php' );
	require_once ( 'libs/header.class.php' );
	require_once ( 'libs/footer.class.php' );
	
	$db     = new Database();
	$util   = new Utility();
	$mail   = new PHPMailer();
	$auth   = new Authentication( $db , $util , $mail );
	$header = new Header();
	$footer = new Footer();
	
	if ( isset( $_COOKIE[ "mp_journalist" ] ) OR isset( $_COOKIE[ "mp_journalist_lvl" ] ) )
	{
		echo "<script text=\"text/javascript\">document.location.href=\"main\"</script>";
	}

?>

<html lang="en"
      data-textdirection="ltr"
      class="loading">

<head>
	<?php
		echo $header -> getMetaInformation ();
		echo $header -> getKeyword ();
		echo $header -> getXUACimpatible ();
		echo $header -> getTitle ();
		echo $header -> getAuthorInfo ();
		echo $header -> getFavicon ();
		echo $header -> getWebFont ();
		echo $header -> getLink ();
	?>
</head>

<body data-open="click"
      data-menu="vertical-menu"
      data-col="1-column"
      class="vertical-layout vertical-menu 1-column blank-page blank-page"
      style="background-image: url(app-assets/images/backgrounds/bg-2.jpg); background-repeat: no-repeat; background-attachment: fixed; background-position: center; ">

<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>

        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1 box-shadow-3 p-0">
                    <div class="card border-grey border-lighten-3 px-1 py-1 m-0">

                        <div class="card-header no-border">
                            <div class="card-title text-xs-center">
                                <img src="../images/logo.png"
                                     alt="branding logo">
                            </div>
                        </div>

                        <div class="card-body collapse in">
                            <p class="card-subtitle line-on-side text-muted text-xs-center font-small-3 mx-2 my-1">
                                <span>Masuk</span>
                            </p>

                            <div class="card-block">
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="text"
                                           class="form-control"
                                           id="username"
                                           placeholder=Username
                                           autocomplete="off">
                                    <div class="form-control-position">
                                        <i class="ft-user"></i>
                                    </div>
                                </fieldset>

                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="password"
                                           class="form-control"
                                           id="password"
                                           placeholder="Enter Password"
                                           autocomplete="off">
                                    <div class="form-control-position">
                                        <i class="fa fa-key"></i>
                                    </div>
                                </fieldset>


                                <a href="#"
                                   class="btn btn-social btn-min-width mr-1 mb-1 btn-facebook btn-block"
                                   style="background-color: #393a39;text-align: center"
                                   id="login_btn">
                                    <i class="fa fa-sign-in"></i> Masuk melalui Akun Media Pesona
                                </a>

                                <a href="#"
                                   class="btn btn-social btn-min-width mr-1 mb-1 btn-facebook btn-block"
                                   style="text-align: center"
                                   id="facebook">
                                    <i class="fa fa-facebook"></i> Masuk melalui Akun Facebook
                                </a>

                                <hr style="margin-top: 2rem;margin-bottom: 2rem;">

                                <div class="col-md-6">
                                    <button class="btn btn-outline btn-secondary btn-block"
                                            id="register_page">
                                        Daftar Akun
                                    </button>
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-outline btn-secondary btn-block"
                                            id="forgot_page">
                                        Lupa Password
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
<?php
	echo $footer -> getAllScript ();
	echo $footer -> getScriptLogin ();
?>
</body>
</html>


<script type="text/javascript">
	
	const register_page = "register"
	const forgot_page   = "forgot_page"
	const read_page     = "../read?id="
	
	var initApp = function ()
	{
		$ ( "#forgot_page" ).click ( gotoForgotPage )
		$ ( "#register_page" ).click ( gotoRegisterPage )
		$ ( "#login_btn" ).click ( loginProcess )
	}
	
	function gotoForgotPage ()
	{
		document.location.href = forgot_page
	}
	
	function gotoRegisterPage ()
	{
		document.location.href = register_page
	}
	
	function loginProcess ()
	{
		var username = $ ( "#username" ).val ()
		var password = $ ( "#password" ).val ()
		
		$.ajax
		 ( {
			   type     : 'POST' ,
			   url      : 'API_journalist/api_journalist.php' ,
			   data     : 'type=reqauthcheck' + "&username=" + username + "&password=" + password ,
			   dataType : 'JSON' ,
			   cache    : false ,
			   success  : function ( JSONObject )
			   {
				   for ( var key in JSONObject )
				   {
					   if ( JSONObject.hasOwnProperty ( key ) )
					   {
						   if ( JSONObject[ key ][ "type" ] === "resauthcheck" )
						   {
							   if ( JSONObject[ key ][ "state" ] === "true" )
							   {
								   var id_page = getCookie ( 'mp_pages' )
								   console.log ( "login success. Ready for main page" )
								   document.location.href = read_page + id_page
							   }
							   else
							   {
								   alert ( "Login tidak berhasil" )
							   }
						   }
					   }
				   }
			   } ,
		   } )
		return false
	}
	
	
	function getCookie ( cname )
	{
		var name = cname + "="
		var ca   = document.cookie.split ( ';' )
		for ( var i = 0 ; i < ca.length ; i++ )
		{
			var c = ca[ i ]
			while ( c.charAt ( 0 ) == ' ' )
			{
				c = c.substring ( 1 )
			}
			if ( c.indexOf ( name ) == 0 )
			{
				return c.substring ( name.length , c.length )
			}
		}
		return ""
	}
	
	$ ( document ).ready ( initApp )

</script>