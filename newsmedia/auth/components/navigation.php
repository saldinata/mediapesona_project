<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-light navbar-border">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu hidden-md-up float-xs-left">
                    <a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs">
                        <i class="ft-menu font-large-1"></i></a>
                </li>
                <li class="nav-item">
                    <a href="main" class="navbar-brand">
                        <img alt="stack admin logo" src="app-assets/images/logo/stack-logo.png" class="brand-logo">
                        <h4 class="brand-text">MediaPesona</h4>
                    </a>
                </li>
                <li class="nav-item hidden-md-up float-xs-right">
                    <a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container">
                        <i class="fa fa-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content container-fluid">
            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
                <ul class="nav navbar-nav">
                    <li class="nav-item hidden-sm-down">
                        <a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs">
                            <i class="ft-menu"></i>
                        </a>
                    </li>

                    <li class="nav-item hidden-sm-down">
                        <a href="#" class="nav-link nav-link-expand">
                            <i class="ficon ft-maximize"></i>
                        </a>
                    </li>
                </ul>
                
                <ul class="nav navbar-nav float-xs-right">                    
                    <li class="dropdown dropdown-user nav-item">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link">
                            <span class="avatar avatar-online">
                                <img src="app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i>
                            </span>
                            <span class="user-name"><?php echo $full_name; ?></span>
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-right">
<!--                            <a href="#" class="dropdown-item">
                                <i class="ft-user"></i> Edit Profile
                            </a>
                            
                            <a href="#" class="dropdown-item">
                                <i class="ft-mail"></i> My Inbox
                            </a>
                            
                            <a href="#" class="dropdown-item">
                                <i class="ft-check-square"></i> Task
                            </a>
                            
                            <a href="#" class="dropdown-item">
                                <i class="ft-comment-square"></i> Chats
                            </a>-->
                            
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item" id="logout_btn">
                                <i class="ft-power"></i> Keluar
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>