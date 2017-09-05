<?php
	require_once ( 'libs/database.class.php' );
	require_once ( 'libs/utility.class.php' );
	require_once ( 'libs/phpmailer.class.php' );
	require_once ( 'libs/authentication.class.php' );
	require_once ( 'libs/activityapps.class.php' );
	require_once ( 'libs/header.class.php' );
	require_once ( 'libs/footer.class.php' );
	
	$db     = new Database();
	$util   = new Utility();
	$mail   = new PHPMailer();
	$auth   = new Authentication( $db , $util , $mail );
	$act    = new ActivityApps( $db , $util , $auth );
	$header = new Header();
	$footer = new Footer();
	
	$util -> setImageDir ( "images/news/" );
	$img_directory = $util -> getImageDir ();
	
	if ( ! isset( $_COOKIE[ "mp_journalist" ] ) OR ! isset( $_COOKIE[ "mp_journalist_lvl" ] ) )
	{
		echo "<script text=\"text/javascript\">document.location.href=\"login\"</script>";
	}
?>


<html lang="en"
      data-textdirection="ltr"
      class="loading">
<head>
	
	<?php
		echo $header -> getMetaInformation ();
		echo $header -> getXUACimpatible ();
		echo $header -> getTitle ();
		echo $header -> getKeyword ();
		echo $header -> getAuthorInfo ();
		echo $header -> getFavicon ();
		echo $header -> getWebFont ();
		echo $header -> getMainLink ();
		echo $header -> getJquery ();
		
		$username   = $util -> decode ( $_COOKIE[ 'mp_journalist' ] );
		$level      = $util -> decode ( $_COOKIE[ 'mp_journalist_lvl' ] );
		$id_user    = $auth -> getUserID ( $username );
		$full_name  = $auth -> getFullName ( $id_user );
		$level_name = $auth -> getLevelName ( $level );
	?>

</head>

<body data-open="click"
      data-menu="vertical-menu"
      data-col="2-columns"
      class="vertical-layout vertical-menu 2-columns fixed-navbar">

<?php
	require_once ( 'components/navigation.php' );
	require_once ( 'components/sidebar.php' );
?>

<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-body">
			
			<?php
				if ( isset( $_GET[ 'mov' ] ) )
				{
					include ( 'pages/' . $_GET[ 'mov' ] . '.php' );
				}
				else
				{
					include ( 'pages/dashboard.php' );
				}
			?>

        </div>
    </div>
</div>

<?php
	require_once ( 'components/footer.php' );
	echo $footer -> getAllMainScript ();
?>

</body>
</html>

<script type="text/javascript">
	
	const login_page = "login"
	
	var initApp = function ()
	{
		$ ( "#logout_btn" ).click ( logoutSystem )
	}
	
	
	function logoutSystem ()
	{
		$.ajax
		 ( {
			   type     : 'POST' ,
			   url      : 'API_journalist/api_journalist.php' ,
			   dataType : 'JSON' ,
			   data     : "type=reqlogout" ,
			   cache    : false ,
			   success  : function ( JSONObject )
			   {
				   for ( var key in JSONObject )
				   {
					   if ( JSONObject.hasOwnProperty ( key ) )
					   {
						   if ( JSONObject[ key ][ "type" ] === "reslogout" )
						   {
							   if ( JSONObject[ key ][ "state" ] === "true" )
							   {
								   document.location.href = login_page
							   }
						   }
					   }
				   }
			   },
		   } )
		return false
	}
	
	$ ( document ).ready ( initApp )

</script>