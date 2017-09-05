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
	require_once ( 'libs/header.class.php' );
	require_once ( 'libs/footer.class.php' );

	$db     = new Database();
	$util   = new Utility();
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
                <div class = "content-body" ><section class = "flexbox-container" >
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
                                        <span >Daftar Akun</span >
                                    </p >
                                    <div class = "card-block" >
<!--                                        <form class="form-horizontal">-->
                                            <fieldset class = "form-group position-relative has-icon-left" >
                                                <input type = "text"
                                                       class = "form-control"
                                                       id = "fullname"
                                                       placeholder = "Full Name"
                                                       required >
                                                <div class = "form-control-position" >
                                                    <i class = "ft-edit" ></i >
                                                </div >
                                            </fieldset >
                                            <fieldset class = "form-group position-relative has-icon-left" >
                                                <input type = "text"
                                                       class = "form-control"
                                                       id = "email"
                                                       placeholder = "Email"
                                                       required >
                                                <div class = "form-control-position" >
                                                    <i class = "ft-mail" ></i >
                                                </div >
                                            </fieldset >
                                            <fieldset class = "form-group position-relative has-icon-left" >
                                                <input type = "text"
                                                       class = "form-control"
                                                       id = "username"
                                                       placeholder = "Username"
                                                       required
                                                       readonly >
                                                <div class = "form-control-position" >
                                                    <i class = "ft-user" ></i >
                                                </div >
                                            </fieldset >
                                            <fieldset class = "form-group position-relative has-icon-left" >
                                                <input type = "password"
                                                       class = "form-control"
                                                       id = "password"
                                                       placeholder = "Enter Password"
                                                       required >
                                                <div class = "form-control-position" >
                                                    <i class = "fa fa-key" ></i >
                                                </div >
                                            </fieldset >
                                            <fieldset class = "form-group" >
                                                <select class = "form-control"
                                                        id = "level" >
                                                    <option >Pilihan Level</option >
	                                                <?php
		                                                $query      =
			                                                "SELECT * FROM tbl_level";

		                                                $level_data =
			                                                $db->getAllValue ($query);

		                                                foreach ( $level_data as
		                                                          $level_data )
		                                                {
			                                                $show_data =
				                                                $level_data['level'] === 'admin' || $level_data['level'] === 'sponsor' || $level_data['level'] === 'redaktur' ? "" : "<option value=" . "\"" . $level_data['id_level'] . "\"" . ">" . $level_data['level'] . "</option>";

			                                                echo $show_data;
		                                                }
	                                                ?>
                                                </select >
                                            </fieldset >

                                            <a href = "#"
                                               class = "btn btn-social btn-min-width mr-1 mb-1 btn-facebook btn-block"
                                               style = "background-color: #393a39; text-align: center"
                                               id = "register_btn" >
	                                            <i class = "fa fa-file-text-o" ></i > Daftar Akun
                                            </a >

                                            <a href = "#"
                                               class = "btn btn-social btn-min-width mr-1 mb-1 btn-facebook btn-block"
                                               style = "background-color: #8eaa29; text-align: center"
                                               id = "login_page" >
	                                            <i class = "fa fa-caret-left" ></i > Kembali ke Laman Login
                                            </a >

<!--                                        </form>-->
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
	    $("#login_page").click(gotoLoginPage);
	    $("#register_btn").click(startRegister);
	    $("#email").change(copyToFieldUsername);
    };


    function copyToFieldUsername()
    {
	    console.log(document.getElementById("email").value);
	    $("#username").val(document.getElementById("email").value);
    }

    function startRegister()
    {

	    var fullname = $("#fullname").val();
	    var email    = $("#email").val();
	    var username = $("#username").val();
	    var password = $("#password").val();
	    var level    = $("#level option:selected").val();

	    $.ajax
	    ({
		    type    : 'POST',
		    url     : 'API_journalist/api_journalist.php',
		    dataType: 'JSON',
		    data    : 'type=reqreguser' + '&fullname=' + fullname + '&email=' + email +
		              '&username=' + username + '&password=' + password + "&level=" +
		              level,
		    cache   : false,
		    success : function (JSONObject)
		    {
			    for (var key in JSONObject)
			    {
				    if (JSONObject.hasOwnProperty(key))
				    {
					    if (JSONObject[key]["type"] === "resreguser")
					    {
						    if (JSONObject[key]["state"] === "true")
						    {
							    alert("registrasi berhasil");
							    $("#fullname").val("");
							    $("#email").val("");
							    $("#username").val("");
							    $("#password").val("");
						    }
						    else
						    {
							    alert(
								    "Registrasi gagal. Mungkin alamat email telah digunakan. Mohon periksa kembali pengetikan Anda. Apabila Anda telah terdaftar, Anda dapat menggunakan layanan lupa password");
						    }

					    }
				    }
			    }
		    }
	    });
    }

    function gotoLoginPage()
    {
	    document.location.href = login_page;
    }


    $(document).ready(initApp);
</script >