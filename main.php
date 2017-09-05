<?php
	
	require_once ( "libs/database.class.php" );
	
	$db = new Database();
	
	$query             = "SELECT * FROM tbl_social_media";
	$social_media_data = $db -> getAllValue ( $query );
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Mediapesona Indonesia</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Responsive Photography HTML5 Website Template">
    <meta name="keywords"
          content="HTML5, CSS3, Bootsrtrap, Responsive, Photography, Portfolio, Template, Theme, Website, Themetorium"/>
    <meta name="author" content="themetorium.net">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/lightgallery/css/lightgallery.min.css">
    <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/vendor/ytplayer/css/jquery.mb.YTPlayer.min.css">
    <link rel="stylesheet" href="assets/vendor/animate.min.css">
    <link rel="stylesheet" href="assets/css/helper.css">
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/dark-style.css">
</head>

<body id="body" class="animsition tt-boxed header-transparent-on page-header-on tt-dark-style">
<header id="header" class="header-transparent header-show-hide-on-scroll menu-align-right">

</header>

<div id="body-content">
    <section id="page-header" class="ph-xlg bg-transparent">
        <div class="page-header-image parallax-bg-3 bg-image"
             style="background-image: url(assets/img/misc/page-header-bg-20.jpg);">
            <div class="cover bg-transparent-4-dark"></div>

        </div>
    </section>


    <section id="about-me-section">
        <div class="about-me-inner">
            <div class="split-box about-me">
                <div class="container-fluid">
                    <div class="row">
                        <div class="row-lg-height">

                            <div class="col-lg-6 col-lg-height split-box-image no-padding bg-image"
                                 style="background-image: url(assets/img/misc/pesonaindonesia.jpg); background-position: 50% 50%; background-color: #212121;">
                                <div class="sbi-height padding-height-85"></div>


                                <div class="intro-caption caption-animate intro-caption-xxlg center"
                                     style="background-color: rgba(132, 3, 3, 0.79);height: 100%;padding-top: 10px;">

                                    <div class="margin-top-30 margin-bottom-30" style="text-align: center;">
                                        <h1 class="intro-title" style="text-align: center;">Pesona Indonesia</h1>
                                        <p class="intro-description max-width-650"
                                           style="text-align: center; font-size: 13px;padding: 0px 50px 0px 50px;"">
                                        Discover Indonesia Digital Promotion in Indonesia
                                        </p>


                                        <a href="#" class="btn btn-primary margin-top-5 margin-right-10"
                                           style="background-color: #c60000;border-color: #c60000;" id="start_media">Baca
                                            Media</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-lg-height split-box-image no-padding bg-image"
                                 style="background-image: url(assets/img/misc/mediapartner.jpg); background-position: 50% 50%;">
                                <div class="sbi-height padding-height-85"></div>

                                <div class="intro-caption caption-animate intro-caption-xxlg center"
                                     style="background-color: rgba(0, 0, 0, 0.82); height: 100%;padding-top: 10px;">

                                    <div class="margin-top-30 margin-bottom-30" style="text-align: center;">
                                        <h1 class="intro-title" style="text-align: center;">Media Partner</h1>
                                        <p class="intro-description max-width-650"
                                           style="text-align: center; font-size: 13px;padding: 0px 50px 0px 50px;">
                                            An exclusive cooperation between your organisation and selected media that
                                            brings mutually beneficial publicity.
                                        </p>


                                        <a href="#" class="btn btn-primary margin-top-5 margin-right-10"
                                           style="background-color: #c60000;border-color: #c60000;" id="start_business">Lihat
                                            Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="footer" class="footer-dark no-margin-top" style="padding: 0px;background-color: #c60000;">
        <div class="footer-inner">
            <div class="footer-container tt-wrap">
                <div class="row">
                    <div class="col-md-3">
                        <div id="footer-logo">
                            <a href="#" class="logo-dark"><img src="assets/img/logo mediapesona_putih.png"
                                                               alt="logo"></a>
                            <a href="#" class="logo-light"><img src="assets/img/logo mediapesona_putih.png" alt="logo"></a>
                            <a href="#" class="logo-dark-m"><img src="assets/img/logo mediapesona_putih.png" alt="logo"></a>
                            <a href="#" class="logo-light-m"><img src="assets/img/logo mediapesona_putih.png"
                                                                  alt="logo"></a>
                        </div>

                    </div> <!-- /.col -->

                    <div class="col-md-5" style="text-align: center; padding: 10% 0% 0% 0%">
                        <div class="footer-text">
                            <h4>- Pesona Media</h4>
                            <p>Memberikan makna tentang pesona periklanan di Indonesia</p>
                        </div>
                    </div>

                    <div class="col-md-4" style="padding: 10% 3%;">
                        <div class="social-buttons" style="text-align:center;">
                            <ul>
								<?php
									foreach ( $social_media_data as $social_media_data )
									{
										echo " <li><a href=\"" . $social_media_data[ 'link' ] . "\"
                                       class=\"btn btn-social-min btn-default btn-rounded-full\"
                                       title=\"Follow me on " . $social_media_data[ 'social_media' ]
										     . "\" target=\"_blank\"><i class=\""
										     . $social_media_data[ 'icon' ] . "\"></i></a>
                                        </li>";
									}
								?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <a href="#body" class="scrolltotop sm-scroll" title="Scroll to top"><i class="fa fa-chevron-up"></i></a>

    </section>
</div>

<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendor/animsition/js/animsition.min.js"></script>
<script src="assets/vendor/jquery.easing.min.js"></script>
<script src="assets/vendor/isotope.pkgd.min.js"></script>
<script src="assets/vendor/imagesloaded.pkgd.min.js"></script>
<script src="assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
<script src="assets/vendor/jquery.mousewheel.min.js"></script>
<script src="assets/vendor/ytplayer/js/jquery.mb.YTPlayer.min.js"></script>
<script src="assets/vendor/lightgallery/js/lightgallery.min.js"></script>
<script src="assets/vendor/lightgallery/js/lightgallery-plugins.js"></script>
<script src="assets/js/theme.js"></script>

</body>
</html>

<script>
	
	var initApps = function ()
	{
		setDarkTheme ()
		$ ( "#start_media" ).click ( redirectToMedia )
		$ ( "#start_business" ).click ( redirectToBusiness )
	}
	
	
	function redirectToBusiness ()
	{
		document.location.href = "mediapartner/"
	}
	
	function redirectToMedia ()
	{
		document.location.href = "newsmedia/"
	}
	
	function setDarkTheme ()
	{
		$ ( "body" ).toggleClass ( "tt-dark-style" )
		$ ( "body" ).hasClass ( "tt-dark-style" ) ?
			(localStorage.setItem ( "darkstyle" ,
			                        "true" ),
				$ ( ".light-switcher" ).addClass ( "is-dark" )) :
			""
        /*(localStorage.setItem("darkstyle", "false"),
         $(".light-switcher").removeClass("is-dark"))*/
		
		var d = localStorage.getItem ( "darkstyle" )
		d == "true" ?
			($ ( "body" ).addClass ( "tt-dark-style" ),
				$ ( ".light-switcher" ).addClass ( "is-dark" )) :
			($ ( "body" ).removeClass ( "tt-dark-style" ),
				$ ( ".light-switcher" ).removeClass ( "is-dark" ))
	}
	
	$ ( document ).ready ( initApps )

</script>