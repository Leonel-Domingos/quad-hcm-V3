<?php if (defined('GOOGLE_ANALYTICS_ID') && GOOGLE_ANALYTICS_ID !== '') : ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= GOOGLE_ANALYTICS_ID ?>"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag()
    {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', '<?= GOOGLE_ANALYTICS_ID ?>');

</script>
<?php endif ?>
<!-- base vendor bundle: 
             DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
                        + pace.js (recommended)
                        + jquery.js (core)
                        + jquery-ui-cust.js (core)
                        + popper.js (core)
                        + bootstrap.js (core)
                        + slimscroll.js (extension)
                        + app.navigation.js (core)
                        + ba-throttle-debounce.js (core)
                        + waves.js (extension)
                        + smartpanels.js (extension)
                        + src/../jquery-snippets.js (core) 
                        + Timepicker                       -->
<script src="<?= ASSETS_URL ?>/js/vendors.bundle.js"></script>
<script src="<?= ASSETS_URL ?>/js/app.bundle.js"></script>

<!-- ATUALIZAR VERSÕES -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/i18n/jquery-ui-i18n.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="<?= ASSETS_URL ?>/js/jquery.validate/jquery.validate.min.js"></script>
<script src="<?= ASSETS_URL ?>/js/jquery.validate/additional-methods.min.js"></script>

