<?php

chdir(__DIR__);
require_once '../const.php';

$_title = 'Installation - SmartAdmin v4.4.6';
$_head = '';

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
    <body>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper alt">
            <!-- BEGIN Page Content -->
            <!-- the #js-page-content id is needed for some plugins to initialize -->
            <main id="js-page-content" role="main" class="page-content">
                <div class="h-alt-f d-flex flex-column align-items-center justify-content-center text-center">
                    <h1 class="page-error color-fusion-500">
                        SmartAdmin for PHP
                        <small class="fw-500">
                            Version 4.4.6
                        </small>
                    </h1>
                    <h3 class="fw-500 mb-5">
                        Database Configuration
                    </h3>
                    <?php if (!empty($_db_error)) : ?>
                    <div class="alert alert-danger alert-dismissible p-2 mb-4">
                        <?= $_db_error ?>
                    </div>
                    <?php endif ?>
                    <h5>The page you're trying to open requires your database configured. <br>Please review the following and update your <code>.env</code> file accordingly.</h5>
                    <h5>For more information about installing SmartAdmin, please head over to the <a href="<?= APP_URL ?>/docs_general.php#database">installation guide</a></h5>
                    <div class="text-left h4 w-50">
                        <?php

                        $command = 'DB_HOST=<span class="text-danger">'.DB_HOST.'</span>'.EOL;
                        $command .= 'DB_USER=<span class="text-danger">'.DB_USER.'</span>'.EOL;
                        $command .= 'DB_PASSWORD=<em class="text-muted">hidden</em>'.EOL;
                        $command .= 'DB_NAME=<span class="text-danger">'.DB_NAME.'</span>'.EOL;
                        $command .= 'DB_PORT=<span class="text-danger">'.DB_PORT.'</span>'.EOL;
                        $command .= EOL.'<em class="text-muted">#...</em>';

                        ?>
                        <div class="markdown-body p-0 mt-4">
                            <pre><code><?= $command ?></code></pre>
                        </div>
                    </div>
                    <h6 class="mt-4">If you're having issues installing SmartAdmin, visit our <a href="https://support.gotbootstrap.com/t/php" target="_blank">Support Forum</a> to get help.</h6>
                </div>
            </main>
            <!-- END Page Content -->
            <!-- BEGIN Page Footer -->
            <footer class="page-footer" role="contentinfo">
                <div class="d-flex align-items-center flex-1 text-muted">
                    <span class="hidden-md-down fw-700">2020 © SmartAdmin for PHP by&nbsp;<a href='https://smartadmin.lodev09.com' class='text-primary fw-500' title='smartadmin.lodev09.com' target='_blank'>@lodev09</a></span>
                </div>
            </footer>
            <!-- END Page Footer -->
        </div>
        <!-- END Page Wrapper -->
        <!-- BEGIN Colors -->
        <!-- BEGIN Color profile -->
        <!-- this area is hidden and will not be seen on screens or screen readers -->
        <!-- we use this only for CSS color refernce for JS stuff -->
        <p id="js-color-profile" class="d-none">
            <span class="color-primary-50"></span>
            <span class="color-primary-100"></span>
            <span class="color-primary-200"></span>
            <span class="color-primary-300"></span>
            <span class="color-primary-400"></span>
            <span class="color-primary-500"></span>
            <span class="color-primary-600"></span>
            <span class="color-primary-700"></span>
            <span class="color-primary-800"></span>
            <span class="color-primary-900"></span>
            <span class="color-info-50"></span>
            <span class="color-info-100"></span>
            <span class="color-info-200"></span>
            <span class="color-info-300"></span>
            <span class="color-info-400"></span>
            <span class="color-info-500"></span>
            <span class="color-info-600"></span>
            <span class="color-info-700"></span>
            <span class="color-info-800"></span>
            <span class="color-info-900"></span>
            <span class="color-danger-50"></span>
            <span class="color-danger-100"></span>
            <span class="color-danger-200"></span>
            <span class="color-danger-300"></span>
            <span class="color-danger-400"></span>
            <span class="color-danger-500"></span>
            <span class="color-danger-600"></span>
            <span class="color-danger-700"></span>
            <span class="color-danger-800"></span>
            <span class="color-danger-900"></span>
            <span class="color-warning-50"></span>
            <span class="color-warning-100"></span>
            <span class="color-warning-200"></span>
            <span class="color-warning-300"></span>
            <span class="color-warning-400"></span>
            <span class="color-warning-500"></span>
            <span class="color-warning-600"></span>
            <span class="color-warning-700"></span>
            <span class="color-warning-800"></span>
            <span class="color-warning-900"></span>
            <span class="color-success-50"></span>
            <span class="color-success-100"></span>
            <span class="color-success-200"></span>
            <span class="color-success-300"></span>
            <span class="color-success-400"></span>
            <span class="color-success-500"></span>
            <span class="color-success-600"></span>
            <span class="color-success-700"></span>
            <span class="color-success-800"></span>
            <span class="color-success-900"></span>
            <span class="color-fusion-50"></span>
            <span class="color-fusion-100"></span>
            <span class="color-fusion-200"></span>
            <span class="color-fusion-300"></span>
            <span class="color-fusion-400"></span>
            <span class="color-fusion-500"></span>
            <span class="color-fusion-600"></span>
            <span class="color-fusion-700"></span>
            <span class="color-fusion-800"></span>
            <span class="color-fusion-900"></span>
        </p>
        <!-- END Color profile -->
        <!-- END Colors -->
        <?php include_once APP_PATH.'/includes/js.php'; ?>
    </body>
</html>
