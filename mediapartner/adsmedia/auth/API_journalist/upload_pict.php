<?php
	
	require_once ( '../libs/database.class.php' );
	require_once ( '../libs/utility.class.php' );
	
	$db   = new Database();
	$util = new Utility();
	
	if ( isset( $_FILES[ "file" ][ "type" ] ) )
	{
		$validextensions = [
			"jpeg" ,
			"jpg" ,
			"png" ,
		];
		$temporary       = explode ( "." , $_FILES[ "file" ][ "name" ] );
		$file_extension  = end ( $temporary );
		
		if ( ( ( $_FILES[ "file" ][ "type" ] == "image/png" ) || ( $_FILES[ "file" ][ "type" ] == "image/jpg" )
		       || ( $_FILES[ "file" ][ "type" ] == "image/jpeg" ) )
		     && ( $_FILES[ "file" ][ "size" ] < 1000000 )
		     && in_array ( $file_extension ,
		                   $validextensions )
		)
		{
			if ( $_FILES[ "file" ][ "error" ] > 0 )
			{
				echo "Return Code: " . $_FILES[ "file" ][ "error" ] . "<br/><br/>";
			}
			else
			{
				if ( file_exists ( "../../../images/news/" . $_FILES[ "file" ][ "name" ] ) )
				{
					echo $_FILES[ "file" ][ "name" ] . " <span id=\"invalid\"><b>already
					exists.</b></span> ";
				}
				else
				{
					$code_uploaded = $util -> decode ( $_COOKIE[ 'mp_journalist_code' ] );
					setcookie ( "mp_journalist_code" ,
					            $code_uploaded ,
					            time () - ( 3600 ) ,
					            "/" );
					
					$sourcePath    = $_FILES[ 'file' ][ 'tmp_name' ];
					$file_name     = $_FILES[ 'file' ][ 'name' ];
					$targetPath    = "../../../images/news/" . $_FILES[ 'file' ][ 'name' ];
					$targetPathURL = "../../../images/news/" . $_FILES[ 'file' ][ 'name' ];
					
					$query   = "SELECT * FROM tbl_berita WHERE code_uploaded=?";
					$chk_dat = $db -> getValue ( $query , [ $code_uploaded ] );
					
					$state = ! empty( $chk_dat[ 'thumbnail' ] ) ? removeImage ( $code_uploaded , $db , $sourcePath ,
					                                                            $targetPath )
						: moveImage ( $sourcePath , $targetPath );
					
					$query         = "UPDATE tbl_berita SET thumbnail=? WHERE code_uploaded=?";
					$result_update = $db -> updateValue ( $query ,
					                                      [
						                                      $file_name ,
						                                      $code_uploaded ,
					                                      ] );
					
					$result_process = $result_update ? "0" : "1";
					echo $result_process;
					
				}
			}
		}
		else
		{
			echo "<span id=\"invalid\">***Invalid file Size or Type***<span>";
		}
	}
	
	function removeImage ( $code , $db , $sourcePath , $targetPath )
	{
		$query     = "SELECT * FROM tbl_berita WHERE code_uploaded=?";
		$news_dat  = $db -> getValue ( $query , [ $code ] );
		$url_image = $news_dat[ 'thumbnail' ];
		unlink ( $url_image );
		moveImage ( $sourcePath , $targetPath );
	}
	
	function moveImage ( $source , $target )
	{
		move_uploaded_file ( $source , $target );
	}

?>