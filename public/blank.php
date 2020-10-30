<?php

require_once 'init.php';

$_title = 'Page Title - Category - SmartAdmin v4.4.6';
$_active_nav = 'blank';
$_head = '	<!-- You can add your own stylesheet here to override any styles that comes before it
		<link rel="stylesheet" media="screen, print" href="'.ASSETS_URL.'/css/your_styles.css">-->
';
$_description = 'Insert page description or punch line';

?>
<!DOCTYPE html>
<!-- 
Template Name:: SmartAdmin PHP 7 Responsive WebApp - Template built with Bootstrap 4 and PHP 7
Version: 4.4.6
Author: Jovanni Lo
Website: https://smartadmin.lodev09.com
Purchase: https://wrapbootstrap.com/theme/smartadmin-php-7-responsive-webapp-WB05M9585
License: You must have a valid license purchased only from wrapbootstrap.com (link above) in order to legally use this theme for your project.
-->
<html lang="en">
    <?php include_once APP_PATH.'/includes/head.php'; ?>
    <body class="mod-bg-1 ">
        <?php include_once APP_PATH.'/includes/theme.php'; ?>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">
                <?php include_once APP_PATH.'/includes/nav.php'; ?>
                <div class="page-content-wrapper">
                    <?php include_once APP_PATH.'/includes/header.php'; ?>
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
                            <li class="breadcrumb-item">Category</li>
                            <li class="breadcrumb-item">Sub-category</li>
                            <li class="breadcrumb-item active">Page Title</li>
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol>
                        <div class="subheader">
                            <h1 class="subheader-title">
                                <i class='subheader-icon fal fa-globe'></i> Blank Page <span class='fw-300'>SubTitle</span> <sup class='badge badge-primary fw-500'>STICKER</sup>
                                <small>
                                    Insert page description or punch line
                                </small>
                            </h1>
                            <!-- 
        Right content on content header
        A nice area to add graphs or buttons -->
                            <div class="subheader-block">
                                Right Subheader Block
                            </div>
                        </div>
                        <div class="alert alert-primary">
                            <div class="d-flex flex-start w-100">
                                <div class="mr-2 hidden-md-down">
                                    <span class="icon-stack icon-stack-lg">
                                        <i class="base base-6 icon-stack-3x opacity-100 color-primary-500"></i>
                                        <i class="base base-10 icon-stack-2x opacity-100 color-primary-300 fa-flip-vertical"></i>
                                        <i class="ni ni-blog-read icon-stack-1x opacity-100 color-white"></i>
                                    </span>
                                </div>
                                <div class="d-flex flex-fill">
                                    <div class="flex-fill">
                                        <span class="h5">Pro Tip!</span>
                                        <p>
                                            If you don't know where to start, this is a good page to start your application. It comes with the basics to get you started. Contains a good inline documentation and waypoints to guide you with your project. Use this area of the page as an attention grabber. Users are likely to respond or pay attention when you involve a color icon along with your information (as displayed here on the left).
                                        </p>
                                        <p class="m-0">
                                            Follow a slogal with a useful link or call to action <a href="#" target="_blank">Call to action >></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Your main content goes below here: -->
                        <div class="row">
                            <div class="col-xl-6">
                                <div id="panel-1" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Ambiente
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                It stash and was even had of collection the latest story still every or times derive come way. Travelling business ill. Helplessly starting didn't should he her bad will so through audiences to the supported congress, if card with was way allows century quarter the control village for of payload.
                                            </div>
<p>
# informação do utilizador conetado
<?php var_dump($_user);?>

# perfil selecionado
<?php var_dump($_user->get_current_profile());?>


# foto
<?= $_user->get_user_thumbnail()?>
</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div id="panel-1" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Panel <span class="fw-300"><i>Title</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
# informação das línguas disponíveis
<?php var_dump($app->get_langs());?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            VARIÁVEIS PHP
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                Utilizadas dentro do código PHP
                                            </div>

                                            <table
                                                <tr><td>ROOT_PATH</td><td><?php echo ROOT_PATH;?></td></tr>
                                                <tr><td>PUBLIC_PATH</td><td><?php echo PUBLIC_PATH;?></td></tr>
                                                <tr><td>LANG_PATH</td><td><?php echo LANG_PATH;?></td></tr>
                                                <tr><td>DS</td><td><?php echo DS;?></td></tr>
                                                <tr><td>EOL</td><td><?php echo EOL;?></td></tr>

                                                <tr><td>DOCUMENT_ROOT</td><td><?php echo DOCUMENT_ROOT;?></td></tr>
                                                <tr><td>SERVER_NAME</td><td><?php echo SERVER_NAME;?></td></tr>
                                                <tr><td>SERVER_URL</td><td><?php echo SERVER_URL;?></td></tr>
                                                <tr><td>SERVER_REQUEST</td><td><?php echo SERVER_REQUEST;?></td></tr>

                                                <tr><td>REQUEST_URI</td><td><?php echo REQUEST_URI;?></td></tr>
                                                <tr><td>REQUEST_METHOD</td><td><?php echo REQUEST_METHOD;?></td></tr>

                                                <tr><td>APP_PATH</td><td><?php echo APP_PATH;?></td></tr>
                                                <tr><td>APP_URL</td><td><?php echo APP_URL;?></td></tr>

                                                <tr><td>APP_LOGS_PATH</td><td><?php echo APP_LOGS_PATH;?></td></tr>
                                                <tr><td>APP_ARCHIVE_PATH</td><td><?php echo APP_ARCHIVE_PATH;?></td></tr>
                                                <tr><td>APP_CACHE_PATH</td><td><?php echo APP_CACHE_PATH;?></td></tr>
                                                <tr><td>APP_TMP_PATH</td><td><?php echo APP_TMP_PATH;?></td></tr>

                                                <tr><td>ASSETS_URL</td><td><?php echo ASSETS_URL;?></td></tr>
                                                <tr><td>ASSETS_PATH</td><td><?php echo ASSETS_PATH;?></td></tr>
                                                <tr><td>DOCS_PATH</td><td><?php echo DOCS_PATH;?></td></tr>
                                                <tr><td>INCLUDES_PATH</td><td><?php echo INCLUDES_PATH;?></td></tr>

                                                <tr><td>API_URL</td><td><?php echo API_URL;?></td></tr>
                                                <tr><td>AJAX_URL</td><td><?php echo AJAX_URL;?></td></tr>
                                            </table>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- END Page Content -->
                    <?php include_once APP_PATH.'/includes/footer.php'; ?>
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <?php include_once APP_PATH.'/includes/extra.php'; ?>
        <?php include_once APP_PATH.'/includes/js.php'; ?>
        <!--This page contains the basic JS and CSS files to get started on your project. If you need aditional addon's or plugins please see scripts located at the bottom of each page in order to find out which JS/CSS files to add.-->
    </body>
</html>
