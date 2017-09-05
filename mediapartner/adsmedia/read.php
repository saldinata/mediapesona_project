<?php
	
	
	require_once ( 'libs/database.class.php' );
	require_once ( 'libs/utility.class.php' );
	require_once ( 'libs/phpmailer.class.php' );
	require_once ( 'libs/authentication.class.php' );
	require_once ( 'libs/activityapps.class.php' );
	require_once ( 'libs/header.class.php' );
	require_once ( 'libs/footer.class.php' );
	
	$util   = new Utility();
	$db     = new Database();
	$mail   = new PHPMailer();
	$auth   = new Authentication( $db , $util , $mail );
	$act    = new ActivityApps( $db , $util , $auth );
	$header = new Header();
	$footer = new Footer();
	
	$util -> setImageDir ( "images/news/" );
	$img_directory = $util -> getImageDir ();
	
	if ( isset( $_GET[ 'id' ] ) )
	{
		$id = $util -> sanitation ( $_GET[ 'id' ] );
		
		echo "<input type=\"hidden\" value=\"$id\" id=\"idberita\" />";
		
		$news_data = json_decode ( $act -> getNewsContentForRead ( $id ) );
		
		//news data :
		$id_con           = $news_data ->{'id_con'};
		$chk_kontent      = $news_data ->{'title'};
		$pict_noted       = $news_data ->{'pict_source'};
		$id_contributor   = $news_data ->{'id_con'};
		$contributor_name = $auth -> getFullName ( $id_contributor );
		$date_publish     = $util -> changeFormatDateFromNumberToString ( $news_data ->{'date_pub'} );
		
		//statistic data :
		$read_stats    = $act -> getStaReadNews ( $id );
		$comment_stats = $act -> getStaComNews ( $id );
	}
?>

<!doctype html>
<html lang="en"
      class="no-js">

<head>
	<?php
		echo $header -> getTitle ();
		echo $header -> getMetaInformation ();
		echo $header -> getXUACimpatible ();
		echo $header -> getLink ();
		echo $header -> getFavicon ();
	?>

</head>
<body>
<div id="container">
    <header class="clearfix">
        <nav class="navbar navbar-default navbar-static-top"
             role="navigation">

            <div class="logo-advertisement" style="background: #fafafa;">
                <div class="container">

                    <div class="navbar-header">
                        <button type="button"
                                class="navbar-toggle collapsed"
                                data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand"
                           href="http://mediapesona.com/mediapromotion"><img
                                    src="images/logo.png"
                                    alt=""></a>
                    </div>

                    <div class="advertisement">
                        <div class="desktop-advert">
                            <span>Advertisement</span>
                            <img src="images/advertising.png"
                                 alt="">
                        </div>
                        <div class="tablet-advert">
                            <span>Advertisement</span>
                            <img src="images/advertising.png"
                                 alt="">
                        </div>
                    </div>
                </div>
            </div>
        </nav>

    </header>
    <!-- End Header -->

    <!-- ticker-news-section
			================================================== -->
    <section class="ticker-news">
        <div class="container">
            <div class="ticker-news-box">
                <span class="breaking-news">breaking news</span>
                <!--                <span class = "new-news" >baru</span >-->
                <ul id="js-news">
					<?php
						$util -> setDefaultTimeZone ( "Asia/Bangkok" );
						$date_time_today = $util -> setRegisterDate ( $util -> getDateTimeToday () );
						
						$query             = "SELECT * FROM tbl_breaking_news WHERE regdate = ?";
						$breaking_news_dat = $db -> getAllValue ( $query , [ $date_time_today ] );
						
						foreach ( $breaking_news_dat as $breaknewsdat )
						{
							echo "<li class = \"news-item\" >";
							echo "<strong><span class = \"time-news\" >" . $breaknewsdat[ 'date_time' ]
							     . "</span ></strong>";
							echo "<strong style=\"color:#212121;\"><i>" . $breaknewsdat[ 'content' ] . "</i><strong>";
							echo "</li >";
						}
					?>

                </ul>
            </div>
        </div>
    </section>
    <!-- End ticker-news-section -->

    <!-- block-wrapper-section
			================================================== -->
    <section class="block-wrapper">
        <div class="container">
            <div class="row">
				<?php
					require_once ( 'components/content_left_read.php' );
					require_once ( 'components/content_right_read.php' );
				?>
            </div>

        </div>
    </section>
	<?php
		require_once ( 'components/footer.php' );
	?>

</div>
<!-- End Container -->

<?php
	echo $footer -> getJQuery ();
	echo $footer -> getAllScript ();
?>

</body>
</html>

<script type="text/javascript">
	const login_page = 'auth/'
	
	var initApp = function ()
	{
		var username = getCookies ( 'mp_journalist' )
		console.log ( 'data cookies :' + username )
		
		if ( username == null || username == '' )
		{
			$ ( '#form_comment' ).css ( 'display' , 'none' )
			$ ( '#login_reader' ).css ( 'display' , 'block' )
		}
		else
		{
			$ ( '#form_comment' ).css ( 'display' , 'block' )
			$ ( '#login_reader' ).css ( 'display' , 'none' )
		}
		
		statisticReadNews ()
		$ ( '#comment_login_btn' ).click ( gotoCommentLoginPage )
		$ ( '#comment_btn' ).click ( giveComment )
	}
	
	function giveComment ()
	{
		var comment = $ ( '#comment' ).val ()
		var id_berita = $ ( '#idberita' ).val ()
		
		$.ajax
		 ( {
			   type     : 'POST' ,
			   url      : 'API_mediapesona/api_mediapesona' ,
			   dataType : 'JSON' ,
			   data     : 'type=reqsubmitcomment' + '&comment=' + comment + '&id_berita=' +
			              id_berita ,
			   cache    : false ,
			   success  : function ( JSONObject )
			   {
				   for ( var key in JSONObject )
				   {
					   if ( JSONObject.hasOwnProperty ( key ) )
					   {
						   if ( JSONObject[ key ][ 'type' ] === 'ressubmitcomment' )
						   {
							   if ( JSONObject[ key ][ 'state' ] === 'true' )
							   {
								   alert ( 'Komen berhasil disubmit' )
								   $ ( '#comment' ).val ( '' )
								   document.location.reload ()
							   }
							   else
							   {
								   alert ( 'Komen tidak berhasil disubmit' )
							   }
						   }
					   }
				   }
			   } ,
		   } )
		return false
	}
	
	function getCookies ( cname )
	{
		var name = cname + '='
		var decodedCookie = decodeURIComponent ( document.cookie )
		var ca = decodedCookie.split ( ';' )
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
		return ''
	}
	
	function gotoCommentLoginPage ()
	{
		var id_berita = $ ( '#idberita' ).val ()
		console.log ( id_berita )
		
		var d = new Date ()
		d.setTime ( d.getTime () + (1 * 24 * 60 * 60 * 1000) )
		var expires = 'expires=' + d.toUTCString ()
		document.cookie = 'mp_pages' + '=' + id_berita + ';' + expires + ';path=/'
		
		document.location.href = login_page
	}
	
	function statisticReadNews ()
	{
		var id_berita = $ ( '#idberita' ).val ()
		
		$.ajax
		 ( {
			   type     : 'POST' ,
			   url      : 'API_mediapesona/api_mediapesona' ,
			   dataType : 'JSON' ,
			   data     : 'type=reqstareadnews' + '&id_berita=' + id_berita ,
			   cache    : false ,
			   success  : function ( JSONObject )
			   {

//				for (var key in JSONObject)
//				{
//					if (JSONObject[key]["type"] === "resstareadnews")
//					{
//						if(JSONObject[key]["state"] === "")
//						{
//
//						}
//					}
//
//				}
				
			   } ,
		   } )
		return false
	}
	
	$ ( document ).ready ( initApp )
</script>