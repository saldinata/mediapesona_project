<?php

class Footer
{

    private $data = null;

    public function getJQuery()
    {
        return $data = "<script type = \"text/javascript\" src = \"js/jquery.min.js\"></script>";
    }

    public function getAllScript()
    {
        $data = "<script type=\"text/javascript\" src=\"js/jquery.migrate.js\"></script>";
        $data .= "<script type=\"text/javascript\" src=\"js/jquery.bxslider.min.js\"></script>";
        $data .= "<script type=\"text/javascript\" src=\"js/jquery.magnific-popup.min.js\"></script>";
        $data .= "<script type=\"text/javascript\" src=\"js/bootstrap.min.js\"></script>";
        $data .= "<script type=\"text/javascript\" src=\"js/jquery.ticker.js\"></script>";
        $data .= "<script type=\"text/javascript\" src=\"js/jquery.imagesloaded.min.js\"></script>";
        $data .= "<script type=\"text/javascript\" src=\"js/jquery.isotope.min.js\"></script>";
        $data .= "<script type=\"text/javascript\" src=\"js/owl.carousel.min.js\"></script>";
        $data .= "<script type=\"text/javascript\" src=\"js/retina-1.1.0.min.js\"></script>";
        $data .= "<script type=\"text/javascript\" src=\"js/plugins-scroll.js\"></script>";
        $data .= "<script type=\"text/javascript\" src=\"js/script.js\"></script>";
        return $data;
    }
	
	public function getScriptLogin()
	{
		return $data =
			"<script type=\"text/javascript\" src=\"assets/js/script_facebook.js\"></script> ";
	}

}
?>