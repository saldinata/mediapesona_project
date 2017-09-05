<?php

class Footer {
    
    private $data = NULL;
    
    public function getAllScript()
    {
        $data =
            "<script src=\"app-assets/vendors/js/vendors.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/vendors/js/forms/validation/jqBootstrapValidation.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/vendors/js/forms/icheck/icheck.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/js/core/app-menu.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/js/core/app.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/js/scripts/customizer.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/js/scripts/forms/form-login-register.min.js\" type=\"text/javascript\"></script>";
        
        return $data;
    }
    
    public function getAllMainScript()
    {
        $data =
            "<script src=\"app-assets/vendors/js/tables/jquery.dataTables.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js\" type=\"text/javascript\"></script>";
        
        $data .= "<script src=\"http://maps.googleapis.com/maps/api/js?key=AIzaSyBDkKetQwosod2SZ7ZGCpxuJdxY3kxo5Po\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/vendors/js/charts/gmaps.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/vendors/js/forms/icheck/icheck.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/vendors/js/extensions/jquery.knob.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/vendors/js/charts/raphael-min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/vendors/js/charts/morris.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/vendors/js/charts/jquery.sparkline.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/vendors/js/extensions/unslider-min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/vendors/js/charts/echarts/echarts.js\" type=\"text/javascript\"></script>";
        
        $data .= "<script src=\"app-assets/js/core/app-menu.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/js/core/app.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/js/scripts/customizer.min.js\" type=\"text/javascript\"></script>";
        
        $data .= "<script src=\"app-assets/js/scripts/pages/dashboard-fitness.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/vendors/js/forms/select/select2.full.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/js/scripts/forms/select/form-select2.min.js\" type=\"text/javascript\"></script>";
        
        $data .= "<script src=\"app-assets/js/scripts/tables/datatables/datatable-basic.min.js\" type=\"text/javascript\"></script>";
        
        $data .= "<script src=\"app-assets/js/scripts/modal/components-modal.min.js\" type=\"text/javascript\"></script>";
        
        return $data;
    }
    
    /*
    public function getScriptDataTable()
    {
        $data = "<script src=\"app-assets/vendors/js/vendors.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/vendors/js/tables/jquery.dataTables.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/js/core/app-menu.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/js/core/app.min.js\" type=\"text/javascript\"></script>";
        $data .= "<script src=\"app-assets/js/scripts/customizer.min.js\" type=\"text/javascript\"></script>";

        $data .= "<script src=\"app-assets/js/scripts/tables/datatables/datatable-basic.min.js\" type=\"text/javascript\"></script>";
        return $data;
    }
    */
    
    public function getScriptLogin()
    {
        return $data =
            "<script type=\"text/javascript\" src=\"assets/js/script_facebook.js\"></script> ";
    }
    
}

?>

