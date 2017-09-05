<?php

class Header
{

    private $data;

    public function getMetaInformation()
    {
        $data = "<meta charset=\"utf-8\">";
        $data .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
        $data .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1\">";
        $data .= "<meta name=\"description\" content=\"-\">";
        $data .= "<meta name=\"mediapesona system\" content=\"mediapesona journalist\">";

        return $data;
    }

    public function getKeyword()
    {
        return $data = "<meta name=\"keywords\" content=\"mediapesona journalist, journalist, iklan Indonesia\">";
    }

    public function getAuthorInfo()
    {
        return $data = "<meta name = \"Saldinata Bobby Ardani\" content = \"MediaPesona Developer\">";
    }

    public function getXUACimpatible()
    {
        return $data = "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
    }

    public function getTitle()
    {
        return $data = "<title>MediaPesona Journalist</title>";
    }

    public function getFavicon()
    {
	    return $data = "<link rel=\"shortcut icon\" href=\"../images/favicon/favicon_mediapesona.ico\">";
    }

    public function getLink()
    {
        $data = "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/bootstrap.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/fonts/feather/style.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/fonts/font-awesome/css/font-awesome.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/fonts/flag-icon-css/css/flag-icon.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/vendors/css/extensions/pace.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/vendors/css/forms/icheck/icheck.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/vendors/css/forms/icheck/custom.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/bootstrap-extended.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/app.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/colors.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/core/menu/menu-types/vertical-menu.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/core/menu/menu-types/vertical-overlay-menu.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/pages/login-register.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"assets/css/style.css\">";
        return $data;
    }

    public function getWebFont()
    {
        return $data = "<link href=\"https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i\" rel=\"stylesheet\">";
    }

    public function getMainLink()
    {
        $data = "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/bootstrap.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/fonts/feather/style.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/fonts/font-awesome/css/font-awesome.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/fonts/flag-icon-css/css/flag-icon.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/vendors/css/extensions/pace.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/vendors/css/forms/icheck/icheck.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/vendors/css/forms/icheck/custom.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/vendors/css/charts/morris.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/vendors/css/extensions/unslider.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/vendors/css/weather-icons/climacons.min.css\">";

        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/vendors/css/forms/selects/select2.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css\">";

        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/bootstrap-extended.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/app.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/colors.min.css\">";

        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/core/menu/menu-types/vertical-menu.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/core/menu/menu-types/vertical-overlay-menu.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/core/colors/palette-climacon.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/core/colors/palette-gradient.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/fonts/simple-line-icons/style.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/fonts/meteocons/style.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app-assets/css/pages/users.min.css\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"assets/css/style.css\">";

        return $data;
    }

    public function getJquery()
    {
        return $data = "<script src=\"app-assets/vendors/js/vendors.min.js\" type=\"text/javascript\"></script>";
    }

}

?>
