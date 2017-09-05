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
			case "reqreguser" :
				$auth -> reqreguser (
					$_POST[ 'fullname' ] ,
					$_POST[ 'password' ] ,
					$_POST[ 'email' ] ,
					$_POST[ 'username' ] ,
					$_POST[ 'level' ] );
				break;
			
			case "reqauthcheck" :
				$auth -> reqauthcheck (
					$_POST[ 'username' ] ,
					$_POST[ 'password' ] );
				break;
			
			case "reqlogout" :
				$auth -> reqlogout ();
				break;
			
			case "reqchangepass" :
				$auth -> reqchangepass (
					$_POST[ 'username' ] ,
					$_POST[ 'old_pass' ] ,
					$_POST[ 'new_pass' ] );
				break;
			
			case "reqpostnews" :
				$act -> reqpostnews (
					$_POST[ 'newstitle' ] ,
					$_POST[ 'contentnews' ] ,
					$_POST[ 'category' ] ,
					$_POST[ 'source_img' ] );
				break;
			
			case "reqpostbreakingnews" :
				$act -> reqpostbreakingnews (
					$_POST[ 'content' ] );
				break;
			
			case "reqeditpostnews" :
				$act -> reqeditpostnews (
					$_POST[ 'newstitle' ] ,
					$_POST[ 'contentnews' ] ,
					$_POST[ 'category' ] ,
					$_POST[ 'id_news' ] ,
					$_POST[ 'source_img' ] );
				break;
			
			case "reqapprovenews" :
				$act -> reqapprovenews (
					$_POST[ 'id_berita' ] );
				break;
			
			case "reqsendresetpass" :
				$act -> reqsendresetpass (
					$_POST[ 'email' ] );
				break;
			
			case 'reqregfbakun' :
				$auth -> reqregfbakun (
					$_POST[ 'name' ] ,
					$_POST[ 'email' ] );
				break;
			
			case 'reqstorepointreward' :
				$act -> reqstorepointreward (
					$_POST[ 'point' ] ,
					$_POST[ 'id_berita' ] );
				break;
			
			case 'reqsetunpub' :
				$act -> reqsetunpub (
					$_POST[ 'id_berita' ] );
				break;
			
			case 'reqsetpub' :
				$act -> reqsetpub (
					$_POST[ 'id_berita' ] );
				break;
			
			case 'reqpreviewnews' :
				$act -> reqpreviewnews (
					$_POST[ 'id_berita' ] );
				break;
			
			default :
				break;
		}
	}
?>