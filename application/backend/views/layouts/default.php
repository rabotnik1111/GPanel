<!DOCTYPE html>
<html lang="en">
    <head>
<!--
    GPanel v0.1
    CodeIgniter Administrator Panel
    Repository: https://github.com/ngodina/GPanel
-->
        <meta charset="UTF-8">
        <title>GPanel - CodeIgniter Administrator Panel</title>
        <link rel="stylesheet" href="<?=base_url();?>assets/lib/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/css/main.css"/>
        <link rel="stylesheet" href="<?=base_url();?>assets/lib/Font-Awesome/css/font-awesome.css"/>
        <link rel="stylesheet" href="<?=base_url();?>assets/lib/switch/static/stylesheets/bootstrap-switch.css">
        
        <link rel="stylesheet" href="<?=base_url();?>assets/css/theme.css">

        <script src="<?=base_url();?>assets/lib/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=base_url();?>assets/lib/jquery-2.0.3.min.js"><\/script>')</script> 
        
    </head>
    <body>
        <div id="wrap">

            <div id="top">
                <!-- .navbar -->
                <nav class="navbar navbar-inverse navbar-static-top" >
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <header class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="<?=base_url();?>settings" class="navbar-brand"><img src="<?=base_url();?>assets/img/logo.png" alt=""></a>
                    </header>


                    <div class="topnav">

                        <div class="btn-toolbar">
                            <div class="btn-group">
                                <a data-placement="bottom" data-original-title="Show / Hide Sidebar" data-toggle="tooltip" class="btn btn-success btn-sm" id="changeSidebarPos">
                                    <i class="icon-resize-horizontal"></i>
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="<?=base_url();?>auth/logout" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom" class="btn btn-metis-1 btn-sm">
                                    <i class="icon-off"></i>
                                </a>
                            </div>
                        </div>


                    </div>






                    <!-- /.topnav -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <!-- .nav -->
                        <ul class="nav navbar-nav">
                            <?php foreach ($top_menu as $item) { ?>
                            <li <?php if ($item['url'] == $active) {?>class="active"<?php } ?>><a href="<?=base_url().$item['url'];?>"><?=$item['name'];?></a></li>
                            <?php } ?>
                        </ul>
                        <!-- /.nav -->
                    </div>
                </nav>
                <!-- /.navbar -->


            </div>
            <!-- /#top -->

            <div id="left">
                <!-- #menu -->
                <ul id="menu" class="collapse">
                    <li class="nav-header">Menu</li>
                    <li class="nav-divider"></li>
                    <?php foreach ($left_menu as $item) { ?>
                        <li <?php if ($item['url'] == $active) {?>class="active"<?php } ?>><a href="<?=base_url().$item['url'];?>"><i class="<?=$item['icon'];?>"></i> <?=$item['name'];?></a></li>
                    <?php } ?>
                </ul>
                <!-- /#menu -->
            </div>
            <!-- /#left -->

            <div id="content">
                <div class="outer">
                    <div class="inner">


                        <?=$template['body'];?>

                    </div>
                    <!-- end .inner -->
                </div>
                <!-- end .outer -->
            </div>
            <!-- end #content -->



        </div>
        <!-- /#wrap -->


        <div id="footer">
            <p>2013 &copy; GPanel - CodeIgniter Administrator Panel</p>
        </div>


        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>-->
        <script src="<?=base_url();?>assets/js/ckeditor/ckeditor.js"></script>
        <script src="<?=base_url();?>assets/lib/bootstrap/js/bootstrap.js"></script>
        <script src="<?=base_url();?>assets/lib/switch/static/js/bootstrap-switch.min.js"></script>
        <script src="<?=base_url();?>assets/js/main.js"></script>

    </body>
</html>
