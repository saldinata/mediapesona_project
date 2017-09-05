<?php

	/**
	 * spl_autoload_register cannot in server.
	 * I think server is not PHP v.7 enviroment. So it will be available on PHP v.7
	 * enviroment :
	 */

	/*
		spl_autoload_register (function ($class_name)
		{
			require_once ( 'libs/' . $class_name . '.class.php' );
		});
	*/

	require_once ( 'libs/database.class.php' );
	require_once ( 'libs/utility.class.php' );
	require_once ( 'libs/phpmailer.class.php' );
	require_once ( 'libs/authentication.class.php' );
	require_once ( 'libs/header.class.php' );
	require_once ( 'libs/footer.class.php' );

	$db     = new Database();
	$util   = new Utility();
	$mail   = new PHPMailer();
	$auth   = new Authentication($db , $util , $mail);
	$header = new Header();
	$footer = new Footer();

?>
<html lang = "en"
      data-textdirection = "ltr"
      class = "loading" >
    <head >
        <?php
	        echo $header->getMetaInformation ();
	        echo $header->getKeyword ();
	        echo $header->getXUACimpatible ();
	        echo $header->getTitle ();
	        echo $header->getAuthorInfo ();
	        echo $header->getFavicon ();
	        echo $header->getWebFont ();
	        echo $header->getLink ();
        ?>
    </head >


    <body data-open = "click"
          data-menu = "vertical-menu"
          data-col = "1-column"
          class = "vertical-layout vertical-menu 1-column bg-full-screen-image blank-page blank-page" >
        <div class = "app-content content container-fluid" >
            <div class = "content-wrapper" >
                <div class = "content-header row" >
                </div >

                <div class = "content-body" >
	                <section class = "flexbox-container" >
                        <div class = "col-md-4 offset-md-4 col-xs-10 offset-xs-1 box-shadow-3 p-0" >
                            <div class = "card border-grey border-lighten-3 px-1 py-1 m-0" >

	                            <div class = "card-header no-border" >
                                    <div class = "card-title text-xs-center" >
                                        <img src = "app-assets/images/logo/stack-logo-dark.png"
                                             alt = "branding logo" >
                                    </div >
                                </div >

                                <div class = "card-body collapse in" >
                                    <p class = "card-subtitle line-on-side text-muted text-xs-center font-small-3 mx-2 my-1" >
	                                    <span >Lupa Password</span >
                                    </p >

                                    <div class = "card-block" >
                                        <fieldset class = "form-group position-relative has-icon-left" >
                                            <input type = "text"
                                                   class = "form-control"
                                                   id = "email"
                                                   placeholder = "Alamat Email"
                                                   autocomplete = "off" >
                                            <div class = "form-control-position"
                                                 style = "top:15px;" >
                                                <i class = "ft-mail" ></i >
                                            </div >
                                        </fieldset >

                                        <a href = "#"
                                           class = "btn btn-social btn-min-width mr-1 mb-1 btn-facebook btn-block"
                                           style = "background-color: #898898;
                                           text-align: center; border : none;"
                                           ;
                                           id = "send_btn" >
                                            <i class = "fa fa-paper-plane-o"
                                               style = "font-size: 1.0em;" ></i >
	                                        Kirim
                                        </a >


                                       <a href = "#"
                                          class = "btn btn-social btn-min-width mr-1 mb-1 btn-facebook btn-block"
                                          style = "background-color: #8eaa29;
                                          text-align: center; border : none;"
                                          ;
                                          id = "login_btn" >
                                            <i class = "fa fa-caret-left" ></i > Kembali ke Laman Login
                                       </a >

                                    </div >

                                </div >
                            </div >
                        </div >
                    </section >

                </div >
            </div >
        </div >
        <?php
	        echo $footer->getAllScript ();
        ?>
    </body >
</html >

<script type = "text/javascript" >

    const login_page = "login";

    var initApp = function ()
    {
	    $("#login_btn").click(gotoLoginPage);
	    $("#send_btn").click(sendPassByEmail);
    };

    function gotoLoginPage()
    {
	    document.location.href = login_page;
    }

    function sendPassByEmail()
    {
    	console.log('clicked');
	    var email = $("#email").val();

	    $.ajax
	    ({
		    type    : "POST",
		    url     : "API_journalist/api_journalist.php",
		    data    : "type=reqsendresetpass" + "&email=" + email,
		    dataType: "JSON",
		    cache   : false,
		    success : function (JSONObject)
		    {
			    for (var key in JSONObject)
			    {
				    if (JSONObject.hasOwnProperty(key))
				    {
					    if (JSONObject[key]["type"] === "ressendresetpass")
					    {
						    if (JSONObject[key]["state"] === "true")
						    {
							    document.location.href = login_page;
						    }
						    else
						    {
							    alert("Mohon maaf, alamat email tidak terdaftar");
						    }
					    }
				    }
			    }
		    }
	    });
	    return false;
    }

    $(document).ready(initApp);
</script >