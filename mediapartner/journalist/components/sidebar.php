<div data-scroll-to-active="true" class="main-menu menu-fixed menu-light menu-accordion">
    <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
            <li class=" navigation-header">
                <span>Menu</span>
                <i data-toggle="tooltip" data-placement="right" data-original-title="Menu" class=" ft-minus"></i>
            </li>

            <?php
            $getLevel = $util->decode($_COOKIE["mp_journalist_lvl"]);
            switch ($getLevel)
            {
                case "3":
                    ?>

                    <li class=" nav-item">
                        <a href="dashboard"><i class="ft-monitor"></i>
                            <span data-i18n="" class="menu-title">Dashboard</span>
                        </a>
                    </li>
    
                    <li class=" nav-item">
                        <a href="breaking_news"><i class="ft-monitor"></i>
                            <span data-i18n="" class="menu-title">Breaking News</span>
                        </a>
                    </li>

                    <li class=" nav-item">
                        <a href="approval_news"><i class="ft-monitor"></i>
                            <span data-i18n="" class="menu-title">Approval Berita</span>
                        </a>
                    </li>

                    <li class=" nav-item">
                        <a href="recarchieve_news"><i class="ft-monitor"></i>
                            <span data-i18n="" class="menu-title">Arsip Berita</span>
                        </a>
                    </li>

                    <?php
                    break;

                case "2":
                    ?>

                    <li class=" nav-item">
                        <a href="dashboard"><i class="ft-monitor"></i>
                            <span data-i18n="" class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class=" nav-item">
                        <a href="post_news"><i class="ft-monitor"></i>
                            <span data-i18n="" class="menu-title">Posting Berita</span>
                        </a>
                    </li>

                    <li class=" nav-item">
                        <a href="myarchieve_news"><i class="ft-monitor"></i>
                            <span data-i18n="" class="menu-title">Arsip Berita</span>
                        </a>
                    </li>

                    <li class=" nav-item">
                        <a href="#"><i class="ft-monitor"></i>
                            <span data-i18n="" class="menu-title">Point Reward</span>
                        </a>
                    </li>
                    <?php
                    break;


                default :
                    break;
            }
            ?>


        </ul>
    </div>
</div>