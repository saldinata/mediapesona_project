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
?>

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
             role="navigation" style="background: rgb(248, 248, 248);">

            <div class="logo-advertisement" style="background: rgba(2, 2, 2, 0.07);">
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

                        <a class="navbar-brand" href="http://mediapesona.com">
                            <img src="../assets/img/logo.png" alt="">
                        </a>
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
			
			<?php
				require_once ( 'components/menu_navigation.php' );
			?>
        </nav>
    </header>


    <section class="heading-news" style="padding-top:0px; background-color: #1b1a1a;">
        <div class="iso-call heading-news-box ">
			
			<?php
				$counter = (int) 0;
				
				$util -> setDefaultTimeZone ( "Asia/Bangkok" );
				$date_today      = ( $util -> changeFormatDateFromDateTimetoDate ( ( $util -> getDateAfterToday
					( $util -> getDateToday () ,
					  1 ) ) ) ) . " 00:00:00";
				$date_5_days_ago = ( $util -> getDateBeforeToday ( $date_today ,
				                                                   10000 ) ) . " 00:00:00";
				
				$query
					= "SELECT * FROM tbl_berita
                  INNER JOIN tbl_statistic_comment_news
                  ON tbl_berita.id_berita=tbl_statistic_comment_news.id_berita
                  WHERE tbl_berita.date_publish BETWEEN ? AND ? ORDER BY tbl_statistic_comment_news.nominal DESC";
				
				$top_rev_dat = $db -> getAllValue ( $query ,
				                                    [ $date_5_days_ago ,
				                                      $date_today ] );
				
				foreach ( $top_rev_dat as $top_review )
				{
					$id_berita     = $top_review[ 'id_berita' ];
					$comment_stats = $act -> getStaComNews ( $id_berita );
					
					$query        = "SELECT * FROM tbl_berita WHERE id_berita=?";
					$news_data    = $db -> getValue ( $query ,
					                                  [ $id_berita ] );
					$title_news   = $news_data[ 'judul_berita' ];
					$date_publish = $util -> changeFormatDateFromNumberToString ( $news_data[ 'date_publish' ] );
					
					$url =  $img_directory.$news_data[ 'thumbnail' ];
					
					if ( $counter == 0 )
					{
						echo "<div class = \"news-post image-post default-size\" >";
						echo "<img src = \"$url\" alt = \"\" height = \"210px\" >";
						echo "<div class = \"hover-box\" >";
						echo "<div class = \"inner-hover\" >";
						//echo "<a class = \"category-post travel\" href = \"read?id=$id_berita\" >Travel</a >";
						echo "<h2 ><a href = \"read?id=$id_berita\" >" . $title_news . "</a ></h2 >";
						echo "<ul class = \"post-tags\" >";
						echo "<li ><i class = \"fa fa-clock-o\" ></i ><span >" . $date_publish . "</span ></li >";
						echo "<li ><a href = \"#\" >";
						echo "<i class = \"fa fa-comments-o\" ></i ><span >" . $comment_stats . "</span ></a ></li >";
						echo "</ul >";
						echo "</div >";
						echo "</div >";
						echo "</div >";
						echo "\r\n\n";
					}
					
					if ( $counter == 1 )
					{
						echo "<div class = \"news-post image-post snd-size\" >";
						echo "<img src = \"$url\" alt = \"\" height = \"420px\" >";
						echo "<div class = \"hover-box\" >";
						echo "<div class = \"inner-hover\" >";
						//echo "<a class = \"category-post travel\" href = \"#\" >Travel</a >";
						echo "<h2 ><a href = \"read?id=$id_berita\" >" . $title_news . "</a ></h2 >";
						echo "<ul class = \"post-tags\" >";
						echo "<li ><i class = \"fa fa-clock-o\" ></i ><span >" . $date_publish . "</span ></li >";
						echo "<li ><a href = \"#\" ><i class = \"fa fa-comments-o\" ></i ><span >" . $comment_stats .
						     "</span ></a ></li >";
						echo "</ul >";
						echo "</div >";
						echo "</div >";
						echo "</div >";
						echo "\r\n\n";
					}
					
					if ( $counter > 1 AND $counter < 9 )
					{
						echo "<div class = \"news-post image-post\" >";
						echo "<img src = \"$url\" alt = \"\" height = \"210px\">";
						echo "<div class = \"hover-box\" >";
						echo "<div class = \"inner-hover\" >";
						//echo "<a class = \"category-post food\" href = \"#\" >food &amp; Health</a >";
						echo "<h2 ><a href = \"read?id=$id_berita\" >" . $title_news . "</a ></h2 >";
						echo "<ul class = \"post-tags\" >";
						echo "<li ><i class = \"fa fa-clock-o\" ></i ><span >" . $date_publish . "</span ></li >";
						echo "<li ><a href = \"#\" ><i class = \"fa fa-comments-o\" ></i ><span >" . $comment_stats .
						     "</span ></a ></li >";
						echo "</ul >";
						echo "</div >";
						echo "</div >";
						echo "</div >";
						echo "\r\n\n";
					}
					
					$counter = $counter + 1;
				}
			
			?>

        </div>
    </section>
	
	
	<?php
		require_once ( 'components/breaking_news.php' );
	?>


    <section class="features-today"
             style="background: rgba(27, 27, 27, 0.02); border-top: 1px solid #d1d1d1; border-bottom: 1px solid rgba(0, 0, 0, 0.15);">
        <div class="container">

            <div class="title-section" style="margin-top: 40px;">
                <h1><span>Terbaru</span></h1>
            </div>

            <div class="features-today-box owl-wrapper">
                <div class="owl-carousel"
                     data-num="4">
					<?php
						
						$date_today      = ( $util -> changeFormatDateFromDateTimetoDate ( ( $util -> getDateAfterToday (
								$util -> getDateToday () ,
								1 ) ) ) ) . " 00:00:00";
						$date_5_days_ago = ( $util -> getDateBeforeToday ( $date_today ,
						                                                   10000 ) ) . " 00:00:00";
						
						
						$id_state    = "1";
						$query = "SELECT * FROM tbl_berita
                                  WHERE id_state=? AND date_publish BETWEEN ? AND ? AND tbl_berita.id_category<=5
                                  ORDER BY id_berita DESC";
						$latest_data = $db -> getAllValue (
							$query ,
							[
								$id_state ,
								$date_5_days_ago ,
								$date_today ,
							] );
						
						foreach ( $latest_data as $latest_data )
						{
							$id_berita = $latest_data[ 'id_berita' ];
							$id_user   = $latest_data[ 'id_user_kontributor' ];
							$fullname  = $auth -> getFullName ( $id_user );
							
							echo "<div class=\"item news-post standard-post\">";
							echo "<div class=\"post-gallery\">";
							echo "<img src=\"" . $img_directory.$latest_data[ 'thumbnail' ] . "\"
                                    alt=\"\" height=\"150\" width=\"150\">";
							//echo "<a class=\"category-post world\"
							// href=\"#\">Music</a>";
							echo "</div>";
							echo "<div class=\"post-content\">";
							echo "<h2><a href=\"read?id=$id_berita\" style=\"color: #353535;\">"
							     . $latest_data[ 'judul_berita' ] . "</a></h2>";
							echo "<ul class=\"post-tags\">";
							echo "</ul>";
							echo "</div>";
							echo "</div>";
						}
					
					?>
                </div>
            </div>

        </div>
    </section>


    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
					<?php
						require_once ( 'components/content_left.php' );
					?>
                </div>

                <div class="col-sm-4">
					<?php
						require_once ( 'components/content_right.php' );
					?>
                </div>

            </div>

        </div>
    </section>
	
	
	<?php
		require_once ( 'components/footer.php' );
	?>

</div>
<?php
	echo $footer -> getJQuery ();
	echo $footer -> getAllScript ();
?>
</body>
</html>