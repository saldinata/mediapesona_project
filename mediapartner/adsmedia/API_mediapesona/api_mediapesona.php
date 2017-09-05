<?php
	
	require_once ( '../libs/database.class.php' );
	require_once ( '../libs/utility.class.php' );
	require_once ( '../libs/phpmailer.class.php' );
	require_once ( '../libs/authentication.class.php' );
	require_once ( '../libs/activityapps.class.php' );
	
	
	$db   = new Database();
	$util = new Utility();
	$mail = new PHPMailer();
	$auth = new Authentication( $db ,
	                            $util ,
	                            $mail );
	$act  = new ActivityApps( $db ,
	                          $util ,
	                          $auth );
	
	if ( isset( $_POST[ 'type' ] ) && !empty( $_POST[ 'type' ] ) )
	{
		switch ( $_POST[ 'type' ] )
		{
			case "reqcheckauth" :
				$auth -> reqcheckauth ( $_POST[ 'username' ] );
				break;
			
			case "reqlogout" :
				$auth -> reqlogout ( $_POST[ 'data_login' ] );
				break;
			
			case "reqreguser" :
				$auth -> reqreguser ( $_POST[ 'fullname' ] ,
				                      $_POST[ 'password' ] ,
				                      $_POST[ 'email' ] ,
				                      $_POST[ 'phone' ] ,
				                      $_POST[ 'address' ] );
				break;
			
			case "reqchangepass" :
				$auth -> reqchangepass ( $_POST[ 'username' ] ,
				                         $_POST[ 'old_pass' ] ,
				                         $_POST[ 'new_pass' ] );
				break;
			
			case "reqsubmitcomment":
				$act -> reqsubmitcomment ( $_POST[ 'comment' ] ,
				                           $_POST[ 'id_berita' ] );
				break;
			
			case "reqstareadnews" :
				$act -> reqstareadnews ( $_POST[ 'id_berita' ] );
				break;
			
			default :
				break;
		}
	}
?>