<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <title><?php echo $Headers->Title ?></title>

    <!-- <link rel="apple-touch-icon" href="<?php # echo base_url('apple-touch-icon.png') ?>"> -->
    <link rel="shortcut icon" href="<?php echo base_url('favicon.ico') ?>">

    <!-- Global CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/animate.css/animate.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/bootstrap-sweetalert/lib/sweet-alert.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>">
    <link rel='stylesheet' href="<?php echo base_url('assets/vendors/Waves/dist/waves.min.css') ?>">
    <?php
    /*
    | -------------------------
    | # Page Specific CSS Files
    | -------------------------
    */
    if( isset($Headers->CSS) ) echo $Headers->CSS;


    // FOR CSS FILES
    $css = '';
    $handle = '';
    $file = '';
    $url = 'assets/css/';
    // open the "css" directory
    if ($handle = opendir( $url ) ) {
        // list directory contents
        while (false !== ($file = readdir($handle))) {
            // only grab file names
            if (is_file($url . $file)) {
                // insert HTML code for loading Javascript files
                $css .= '<link rel="stylesheet" href="' . base_url($url . $file) . '"/>' . "\n";
            }
        }
        closedir($handle);
        echo $css;
    } ?>
    <script>
        //////////////////////
        // Global Variables //
        //////////////////////
        var base_url = function (segments) {
            return "<?php echo base_url(); ?>" + segments;
        }
    </script>
</head>
<body>
    <noscript>
        Javascript Must be Enabled to use this Application.
    </noscript>

    <header id="header">
        <ul class="header-inner">
            <li id="menu-trigger" data-trigger="#sidebar">
                <div class="line-wrap">
                    <div class="line top"></div>
                    <div class="line center"></div>
                    <div class="line bottom"></div>
                </div>
            </li>

            <li class="logo hidden-xs">
                <a href="<?php echo base_url(); ?>"><?php echo $Headers->Page_Title ?></a>
            </li>

            <li class="pull-right">
                <ul class="top-menu">
                    <li id="toggle-width">
                        <div class="toggle-switch">
                            <input id="tw-switch" type="checkbox" hidden="hidden">
                            <label for="tw-switch" class="ts-helper"></label>
                        </div>
                    </li>
                    <li id="top-search">
                        <a class="tm-search" href=""></a>
                    </li>

                    <li class="dropdown">
                        <a data-toggle="dropdown" class="tm-settings" href=""></a>
                        <ul class="dropdown-menu dm-icon pull-right">
                            <li class="hidden-xs">
                                <a data-action="fullscreen" href=""><i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen</a>
                            </li>
                            <li>
                                <a data-action="clear-localstorage" href=""><i class="zmdi zmdi-delete"></i> Clear Local Storage</a>
                            </li>
                            <li>
                                <a href=""><i class="zmdi zmdi-face"></i> Privacy Settings</a>
                            </li>
                            <li>
                                <a href=""><i class="zmdi zmdi-settings"></i> Other Settings</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Top Search Content -->
        <?php $this->load->view('partials/search') ?>
    </header>