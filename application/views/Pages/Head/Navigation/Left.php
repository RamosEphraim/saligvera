    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?=base_url()?>login">R.Y.Saligvera Construction and Supply Corporation</a>

            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
                <li><a class="sidebar-mobile-opposite-toggle"><i class="icon-menu"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li>
                    <a class="sidebar-control sidebar-main-hide hidden-xs" data-popup="tooltip" title="Hide main" data-placement="bottom" data-container="body">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>
            </ul>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li class="dropdown dropdown-user">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <span><?=$userdetails['firstname'].' '.$userdetails['surname']?></span>
                            <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="<?=base_url()?>Head/AccountSettings"><i class="icon-cog5"></i> Account settings</a></li>
                            <li><a href="<?=base_url()?>Head/Logout"><i class="icon-switch2"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
            <!-- Main sidebar -->
            <div class="sidebar sidebar-main">
                <div class="sidebar-content">
                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">

                            <ul class="navigation navigation-main navigation-accordion">
                                <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                                <li class="<?= $nav == 'Project Lists' ? 'active' : '' || $nav == 'View Project' ? 'active' : '' ?>"><a href="<?=base_url()?>Head"><i class="icon-construction"></i> <span>Projects</span></a></li>
                                <li class="<?= $nav == 'Accounts' ? 'active' : '' || $nav == 'Edit Account' ? 'active' : ''?>"><a href="<?=base_url()?>Head/Accounts"><i class="icon-users"></i> <span>Accounts</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /main navigation -->
                </div>
            </div>
            <!-- /main sidebar -->  