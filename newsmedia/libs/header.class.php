<?php

class Header
{

    private $data;

    public function getMetaInformation()
    {
        $data = "<meta charset=\"utf-8\">";
        $data .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1\">";
        $data .= "<meta name=\"description\" content=\"-\">";
        $data .= "<meta name=\"saldinata bobby ardani\" content=\"maufutsal admin platform\">";

        return $data;
    }

    public function getXUACimpatible()
    {
        return $data = "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
    }

    public function getTitle()
    {
        return $data = "<title>News - MediaPesona</title>";
    }

    public function getFavicon()
    {
        return $data = "<link rel=\"shortcut icon\" href=\"images/favicon/favicon_mediapesona.ico\">";
    }

    public function getLink()
    {
        $data = "<link href=\"http://fonts.googleapis.com/css?family=Lato:300,400,700,900,400italic\" type=\"text/css\">";
        $data .= "<link href=\"../../../maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css\" rel=\"stylesheet\">";
        $data .= "<link href=\"css/bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/jquery.bxslider.css\" media=\"screen\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/font-awesome.css\" media=\"screen\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/magnific-popup.css\" media=\"screen\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/owl.carousel.css\" media=\"screen\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/owl.theme.css\" media=\"screen\">";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/ticker-style.css\"/>";
        $data .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\" media=\"screen\">";
        return $data;
    }
}

?>
