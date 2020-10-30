/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$.navAsAjax = true;
$.intervalArr = [];
$.root_ = $('body');

// localização do breadcrumb
bread_crumb = $('#ribbon ol.breadcrumb');

/* IF CALL WAS issued by Portal V1 AND has interface attached -> RUN IT */
var JS_GO_URL = '';
        
/*
 * These elements are ignored during DOM object deletion for ajax version 
 * It will delete all objects during page load with these exceptions:
 */
var ignore_key_elms = '';
//var ignore_key_elms = ["#header, #left-panel, #right-panel, #main, div.page-footer, #shortcut, #divSmallBoxes, #divMiniIcons, #divbigBoxes, #voiceModal, script, .ui-chatbox"];

var root = this,
        /*
         * DEBUGGING MODE
         * debugState = true; will spit all debuging message inside browser console.
         * The colors are best displayed in chrome browser.
         */
        debugState = true,
        debugStyle = 'font-weight: bold; color: #00f;',
        debugStyle_green = 'font-weight: bold; font-style:italic; color: #46C246;',
        debugStyle_red = 'font-weight: bold; color: #ed1c24;',
        debugStyle_warning = 'background-color:yellow',
        debugStyle_success = 'background-color:green; font-weight:bold; color:#fff;',
        debugStyle_error = 'background-color:#ed1c24; font-weight:bold; color:#fff;';


/*
 * MISCELANEOUS DOM READY FUNCTIONS
 * Description: fire with jQuery(document).ready...
 */
initApp.domReadyMisc = function () {

    // ACTIVITY :: QUAD PROCESS
    // ajax drop
    $('#activity').off('click');
    $('#activity').on('click',function (e) {
        var $this = $(this);
        /* After click the notification button, they are reseted to zero
        if ($this.find('.badge').hasClass('bg-color-red')) {
            $this.find('.badge').removeClassPrefix('bg-color-');
            $this.find('.badge').text("0");
        }
        */
console.log('#1 ATIVITY CLICK');
       
        if (!$this.next('.ajax-dropdown').is(':visible')) {
            $this.next('.ajax-dropdown').fadeIn(150);
            //Upload processes running
            Processo.listProcessos(".notification-body");
            Processo.startTimer();
            $this.addClass('active');
        } else {
            $this.next('.ajax-dropdown').fadeOut(150);
            Processo.stopTimer();
            $this.removeClass('active');
        }
        var theUrlVal = $this.next('.ajax-dropdown').find('.btn-group > .active > input').attr('id');

        //clear memory reference
        $this = null;
        theUrlVal = null;

        e.preventDefault();
    });

    $('input[name="activity"]').change(function () {
        var $this = $(this);

        url = $this.attr('id');
        container = $('.ajax-notifications');

        loadURL(url, container);

        //clear memory reference
        $this = null;
    });

    // NOTIFICATION IS PRESENT
    // Change color of lable once notification button is clicked

    $this = $('#activity > .badge');

    if (parseInt($this.text()) > 0) {
        $this.addClass("bg-color-red bounceIn animated");

        //clear memory reference
        $this = null;
    }

    // Delete Processes registry button clicked
    var el = document.getElementById('clearProcesses');
    $(el).off('click');
    $(el).on('click', function(){
        Processo.stopTimer();
        Processo.clearData();
        Processo.updateView();
        if ( $('#activity').next('.ajax-dropdown').is(':visible') ) {
            Processo.listProcessos('.notification-body');
            $('#activity').trigger('click');
        }                   
    });

};
/* ~ END: MISCELANEOUS DOM */


/*
 * DOCUMENT LOADED EVENT
 * Description: Fire when DOM is ready
 */
jQuery(document).ready(function () {
    initApp.domReadyMisc();
});

/*
 * INITIALIZE FORMS
 * Description: Select2, Masking, Datepicker, Autocomplete
 */
function runAllForms() {
    
    showQuadMenu();
    /*
     * BOOTSTRAP SLIDER PLUGIN
     * Usage:
     * Dependency: js/plugin/bootstrap-slider
     */
    if ($.fn.slider) {
        $('.slider').slider();
    }

    /*
     * SELECT2 PLUGIN
     * Usage:
     * Dependency: js/plugin/select2/
     */
    if ($.fn.select2) {
        $('select.select2').each(function () {
            var $this = $(this),
                    width = $this.attr('data-select-width') || '100%';
            //, _showSearchInput = $this.attr('data-select-search') === 'true';
            $this.select2({
                //showSearchInput : _showSearchInput,
                allowClear: true,
                width: width
            });

            //clear memory reference
            $this = null;
        });
    }

    /*
     * MASKING
     * Dependency: js/plugin/masked-input/
     */
    if ($.fn.mask) {
        $('[data-mask]').each(function () {

            var $this = $(this),
                mask = $this.attr('data-mask') || 'error...',
                mask_placeholder = $this.attr('data-mask-placeholder') || 'X';

            $this.mask(mask, {
                placeholder: mask_placeholder
            });

            //clear memory reference
            $this = null;
        });
    }

    /*
     * AUTOCOMPLETE
     * Dependency: js/jqui
     */
    if ($.fn.autocomplete) {
        $('[data-autocomplete]').each(function () {

            var $this = $(this),
                    availableTags = $this.data('autocomplete') || ["The", "Quick", "Brown", "Fox", "Jumps", "Over", "Three", "Lazy", "Dogs"];

            $this.autocomplete({
                source: availableTags
            });

            //clear memory reference
            $this = null;
        });
    }

    /*
     * JQUERY UI DATE
     * Dependency: js/libs/jquery-ui-1.10.3.min.js
     * Usage: <input class="datepicker" />
     * https://api.jqueryui.com/1.10/datepicker/
     */
    if ($.fn.datepicker) {
        $('.datepicker').each(function () {

            var $this = $(this),
                dataDateFormat = $this.attr('data-dateformat') || 'yy-mm-dd';

            $this.datepicker({
                dateFormat: dataDateFormat,
                prevText: '<i class="fas fa-chevron-left"></i>',
                nextText: '<i class="fas fa-chevron-right"></i>',
            });

            //clear memory reference
            $this = null;
        });
        
        // nesta versão não existe setDefaults
        $.datepicker.setDefaults($.datepicker.regional[JS_LANG]);
        
        /* https://github.com/trentrichardson/jQuery-Timepicker-Addon/find/master */
        if (JS_LANG === 'pt') {
            if ($.fn.timepicker) {
                $.timepicker.regional['pt'] = {
                        timeOnlyTitle: 'Escolha uma hora',
                        timeText: 'Hora',
                        hourText: 'Horas',
                        minuteText: 'Minutos',
                        secondText: 'Segundos',
                        millisecText: 'Milissegundos',
                        microsecText: 'Microssegundos',
                        timezoneText: 'Fuso horário',
                        currentText: 'Agora',
                        closeText: 'Fechar',
                        timeFormat: 'HH:mm',
                        timeSuffix: '',
                        amNames: ['a.m.', 'AM', 'A'],
                        pmNames: ['p.m.', 'PM', 'P'],
                        isRTL: false                
                };
                $.timepicker.setDefaults($.timepicker.regional[JS_LANG]);
            }
        }
    }

    /*
     * JQUERY UI DATETIMEPICKER -- datepicker extension
     * Dependency: jqueryui 
     * Usage: <input class="dateTimePickerShort" />
     * https://trentrichardson.com/examples/timepicker/
     */
    
    if ($.fn.datetimepicker) {
        
        $('.dateTimePicker').each(function () {
            var $this = $(this);
            
            $this.datepicker({
                timeFormat: quadConfig.dateTimePickerTimeFormat,
                dateFormat: quadConfig.datePickerFormat,
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                timeInput: true
            });
            
            //clear memory reference
            $this = null;
        });

        $('.dateTimePickerShort').each(function () {
            var $this = $(this);
            
            $this.datepicker({
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                timeFormat: quadConfig.dateTimePickerTimeFormatShort,
                dateFormat: quadConfig.datePickerFormat,
                timeInput: true
            });
            
            //clear memory reference
            $this = null;
        });

        $('.dateTimePickerTimeFormatShort').each(function () {
            var $this = $(this);
            
            $this.datepicker({
                timeOnly: true,
                timeInput: true,
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                timeFormat: quadConfig.dateTimePickerTimeFormatShort
            });
            
            //clear memory reference
            $this = null;
        });

        $('.dateYearMonth').each(function () {
            var $this = $(this);
            
            $this.datepicker({
                dateFormat: quadConfig.dateYearMonth,
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                constrainInput: false
            });
            
            //clear memory reference
            $this = null;
        });
        
    }
        
    
    /*
     * AJAX BUTTON LOADING TEXT
     * Usage: <button type="button" data-loading-text="Loading..." class="btn btn-xs btn-default ajax-refresh"> .. </button>
     */
    $('button[data-loading-text]').on('click', function () {
        var btn = $(this);
        btn.button('loading');
        setTimeout(function () {
            btn.button('reset');
            //clear memory reference
            btn = null;
        }, 3000);

    });

}
/* ~ END: INITIALIZE FORMS */

/*
 * INITIALIZE CHARTS
 * Description: Sparklines, PieCharts
 */
function runAllCharts() {
    /*
     * SPARKLINES
     * DEPENDENCY: js/plugins/sparkline/jquery.sparkline.min.js
     * See usage example below...
     */

    /* Usage:
     * 		<div class="sparkline-line txt-color-blue" data-fill-color="transparent" data-sparkline-height="26px">
     *			5,6,7,9,9,5,9,6,5,6,6,7,7,6,7,8,9,7
     *		</div>
     */

    if ($.fn.sparkline) {

        // variable declarations:

        var barColor,
                sparklineHeight,
                sparklineBarWidth,
                sparklineBarSpacing,
                sparklineNegBarColor,
                sparklineStackedColor,
                thisLineColor,
                thisLineWidth,
                thisFill,
                thisSpotColor,
                thisMinSpotColor,
                thisMaxSpotColor,
                thishighlightSpotColor,
                thisHighlightLineColor,
                thisSpotRadius,
                pieColors,
                pieWidthHeight,
                pieBorderColor,
                pieOffset,
                thisBoxWidth,
                thisBoxHeight,
                thisBoxRaw,
                thisBoxTarget,
                thisBoxMin,
                thisBoxMax,
                thisShowOutlier,
                thisIQR,
                thisBoxSpotRadius,
                thisBoxLineColor,
                thisBoxFillColor,
                thisBoxWhisColor,
                thisBoxOutlineColor,
                thisBoxOutlineFill,
                thisBoxMedianColor,
                thisBoxTargetColor,
                thisBulletHeight,
                thisBulletWidth,
                thisBulletColor,
                thisBulletPerformanceColor,
                thisBulletRangeColors,
                thisDiscreteHeight,
                thisDiscreteWidth,
                thisDiscreteLineColor,
                thisDiscreteLineHeight,
                thisDiscreteThrushold,
                thisDiscreteThrusholdColor,
                thisTristateHeight,
                thisTristatePosBarColor,
                thisTristateNegBarColor,
                thisTristateZeroBarColor,
                thisTristateBarWidth,
                thisTristateBarSpacing,
                thisZeroAxis,
                thisBarColor,
                sparklineWidth,
                sparklineValue,
                sparklineValueSpots1,
                sparklineValueSpots2,
                thisLineWidth1,
                thisLineWidth2,
                thisLineColor1,
                thisLineColor2,
                thisSpotRadius1,
                thisSpotRadius2,
                thisMinSpotColor1,
                thisMaxSpotColor1,
                thisMinSpotColor2,
                thisMaxSpotColor2,
                thishighlightSpotColor1,
                thisHighlightLineColor1,
                thishighlightSpotColor2,
                thisFillColor1,
                thisFillColor2;

        $('.sparkline:not(:has(>canvas))').each(function () {
            var $this = $(this),
                    sparklineType = $this.data('sparkline-type') || 'bar';

            // BAR CHART
            if (sparklineType == 'bar') {

                barColor = $this.data('sparkline-bar-color') || $this.css('color') || '#0000f0';
                sparklineHeight = $this.data('sparkline-height') || '26px';
                sparklineBarWidth = $this.data('sparkline-barwidth') || 5;
                sparklineBarSpacing = $this.data('sparkline-barspacing') || 2;
                sparklineNegBarColor = $this.data('sparkline-negbar-color') || '#A90329';
                sparklineStackedColor = $this.data('sparkline-barstacked-color') || ["#A90329", "#0099c6", "#98AA56", "#da532c", "#4490B1", "#6E9461", "#990099", "#B4CAD3"];

                $this.sparkline('html', {
                    barColor: barColor,
                    type: sparklineType,
                    height: sparklineHeight,
                    barWidth: sparklineBarWidth,
                    barSpacing: sparklineBarSpacing,
                    stackedBarColor: sparklineStackedColor,
                    negBarColor: sparklineNegBarColor,
                    zeroAxis: 'false'
                });

                $this = null;

            }

            // LINE CHART
            if (sparklineType == 'line') {

                sparklineHeight = $this.data('sparkline-height') || '20px';
                sparklineWidth = $this.data('sparkline-width') || '90px';
                thisLineColor = $this.data('sparkline-line-color') || $this.css('color') || '#0000f0';
                thisLineWidth = $this.data('sparkline-line-width') || 1;
                thisFill = $this.data('fill-color') || '#c0d0f0';
                thisSpotColor = $this.data('sparkline-spot-color') || '#f08000';
                thisMinSpotColor = $this.data('sparkline-minspot-color') || '#ed1c24';
                thisMaxSpotColor = $this.data('sparkline-maxspot-color') || '#f08000';
                thishighlightSpotColor = $this.data('sparkline-highlightspot-color') || '#50f050';
                thisHighlightLineColor = $this.data('sparkline-highlightline-color') || 'f02020';
                thisSpotRadius = $this.data('sparkline-spotradius') || 1.5;
                thisChartMinYRange = $this.data('sparkline-min-y') || 'undefined';
                thisChartMaxYRange = $this.data('sparkline-max-y') || 'undefined';
                thisChartMinXRange = $this.data('sparkline-min-x') || 'undefined';
                thisChartMaxXRange = $this.data('sparkline-max-x') || 'undefined';
                thisMinNormValue = $this.data('min-val') || 'undefined';
                thisMaxNormValue = $this.data('max-val') || 'undefined';
                thisNormColor = $this.data('norm-color') || '#c0c0c0';
                thisDrawNormalOnTop = $this.data('draw-normal') || false;

                $this.sparkline('html', {
                    type: 'line',
                    width: sparklineWidth,
                    height: sparklineHeight,
                    lineWidth: thisLineWidth,
                    lineColor: thisLineColor,
                    fillColor: thisFill,
                    spotColor: thisSpotColor,
                    minSpotColor: thisMinSpotColor,
                    maxSpotColor: thisMaxSpotColor,
                    highlightSpotColor: thishighlightSpotColor,
                    highlightLineColor: thisHighlightLineColor,
                    spotRadius: thisSpotRadius,
                    chartRangeMin: thisChartMinYRange,
                    chartRangeMax: thisChartMaxYRange,
                    chartRangeMinX: thisChartMinXRange,
                    chartRangeMaxX: thisChartMaxXRange,
                    normalRangeMin: thisMinNormValue,
                    normalRangeMax: thisMaxNormValue,
                    normalRangeColor: thisNormColor,
                    drawNormalOnTop: thisDrawNormalOnTop

                });

                $this = null;

            }

            // PIE CHART
            if (sparklineType == 'pie') {

                pieColors = $this.data('sparkline-piecolor') || ["#B4CAD3", "#4490B1", "#98AA56", "#da532c", "#6E9461", "#0099c6", "#990099", "#717D8A"];
                pieWidthHeight = $this.data('sparkline-piesize') || 90;
                pieBorderColor = $this.data('border-color') || '#45494C';
                pieOffset = $this.data('sparkline-offset') || 0;

                $this.sparkline('html', {
                    type: 'pie',
                    width: pieWidthHeight,
                    height: pieWidthHeight,
                    tooltipFormat: '<span style="color: {{color}}">&#9679;</span> ({{percent.1}}%)',
                    sliceColors: pieColors,
                    borderWidth: 1,
                    offset: pieOffset,
                    borderColor: pieBorderColor
                });

                $this = null;

            }

            // BOX PLOT
            if (sparklineType == 'box') {

                thisBoxWidth = $this.data('sparkline-width') || 'auto';
                thisBoxHeight = $this.data('sparkline-height') || 'auto';
                thisBoxRaw = $this.data('sparkline-boxraw') || false;
                thisBoxTarget = $this.data('sparkline-targetval') || 'undefined';
                thisBoxMin = $this.data('sparkline-min') || 'undefined';
                thisBoxMax = $this.data('sparkline-max') || 'undefined';
                thisShowOutlier = $this.data('sparkline-showoutlier') || true;
                thisIQR = $this.data('sparkline-outlier-iqr') || 1.5;
                thisBoxSpotRadius = $this.data('sparkline-spotradius') || 1.5;
                thisBoxLineColor = $this.css('color') || '#000000';
                thisBoxFillColor = $this.data('fill-color') || '#c0d0f0';
                thisBoxWhisColor = $this.data('sparkline-whis-color') || '#000000';
                thisBoxOutlineColor = $this.data('sparkline-outline-color') || '#303030';
                thisBoxOutlineFill = $this.data('sparkline-outlinefill-color') || '#f0f0f0';
                thisBoxMedianColor = $this.data('sparkline-outlinemedian-color') || '#f00000';
                thisBoxTargetColor = $this.data('sparkline-outlinetarget-color') || '#40a020';

                $this.sparkline('html', {
                    type: 'box',
                    width: thisBoxWidth,
                    height: thisBoxHeight,
                    raw: thisBoxRaw,
                    target: thisBoxTarget,
                    minValue: thisBoxMin,
                    maxValue: thisBoxMax,
                    showOutliers: thisShowOutlier,
                    outlierIQR: thisIQR,
                    spotRadius: thisBoxSpotRadius,
                    boxLineColor: thisBoxLineColor,
                    boxFillColor: thisBoxFillColor,
                    whiskerColor: thisBoxWhisColor,
                    outlierLineColor: thisBoxOutlineColor,
                    outlierFillColor: thisBoxOutlineFill,
                    medianColor: thisBoxMedianColor,
                    targetColor: thisBoxTargetColor

                });

                $this = null;

            }

            // BULLET
            if (sparklineType == 'bullet') {

                var thisBulletHeight = $this.data('sparkline-height') || 'auto';
                thisBulletWidth = $this.data('sparkline-width') || 2;
                thisBulletColor = $this.data('sparkline-bullet-color') || '#ed1c24';
                thisBulletPerformanceColor = $this.data('sparkline-performance-color') || '#3030f0';
                thisBulletRangeColors = $this.data('sparkline-bulletrange-color') || ["#d3dafe", "#a8b6ff", "#7f94ff"];

                $this.sparkline('html', {
                    type: 'bullet',
                    height: thisBulletHeight,
                    targetWidth: thisBulletWidth,
                    targetColor: thisBulletColor,
                    performanceColor: thisBulletPerformanceColor,
                    rangeColors: thisBulletRangeColors

                });

                $this = null;

            }

            // DISCRETE
            if (sparklineType == 'discrete') {

                thisDiscreteHeight = $this.data('sparkline-height') || 26;
                thisDiscreteWidth = $this.data('sparkline-width') || 50;
                thisDiscreteLineColor = $this.css('color');
                thisDiscreteLineHeight = $this.data('sparkline-line-height') || 5;
                thisDiscreteThrushold = $this.data('sparkline-threshold') || 'undefined';
                thisDiscreteThrusholdColor = $this.data('sparkline-threshold-color') || '#ed1c24';

                $this.sparkline('html', {
                    type: 'discrete',
                    width: thisDiscreteWidth,
                    height: thisDiscreteHeight,
                    lineColor: thisDiscreteLineColor,
                    lineHeight: thisDiscreteLineHeight,
                    thresholdValue: thisDiscreteThrushold,
                    thresholdColor: thisDiscreteThrusholdColor

                });

                $this = null;

            }

            // TRISTATE
            if (sparklineType == 'tristate') {

                thisTristateHeight = $this.data('sparkline-height') || 26;
                thisTristatePosBarColor = $this.data('sparkline-posbar-color') || '#60f060';
                thisTristateNegBarColor = $this.data('sparkline-negbar-color') || '#f04040';
                thisTristateZeroBarColor = $this.data('sparkline-zerobar-color') || '#909090';
                thisTristateBarWidth = $this.data('sparkline-barwidth') || 5;
                thisTristateBarSpacing = $this.data('sparkline-barspacing') || 2;
                thisZeroAxis = $this.data('sparkline-zeroaxis') || false;

                $this.sparkline('html', {
                    type: 'tristate',
                    height: thisTristateHeight,
                    posBarColor: thisBarColor,
                    negBarColor: thisTristateNegBarColor,
                    zeroBarColor: thisTristateZeroBarColor,
                    barWidth: thisTristateBarWidth,
                    barSpacing: thisTristateBarSpacing,
                    zeroAxis: thisZeroAxis

                });

                $this = null;

            }

            //COMPOSITE: BAR
            if (sparklineType == 'compositebar') {

                sparklineHeight = $this.data('sparkline-height') || '20px';
                sparklineWidth = $this.data('sparkline-width') || '100%';
                sparklineBarWidth = $this.data('sparkline-barwidth') || 3;
                thisLineWidth = $this.data('sparkline-line-width') || 1;
                thisLineColor = $this.data('sparkline-linecolor') || '#ed1c24';
                thisBarColor = $this.data('sparkline-barcolor') || '#333333';

                $this.sparkline($this.data('sparkline-bar-val'), {
                    type: 'bar',
                    width: sparklineWidth,
                    height: sparklineHeight,
                    barColor: thisBarColor,
                    barWidth: sparklineBarWidth
                    //barSpacing: 5
                });

                $this.sparkline($this.data('sparkline-line-val'), {
                    width: sparklineWidth,
                    height: sparklineHeight,
                    lineColor: thisLineColor,
                    lineWidth: thisLineWidth,
                    composite: true,
                    fillColor: false

                });

                $this = null;

            }

            //COMPOSITE: LINE
            if (sparklineType == 'compositeline') {

                sparklineHeight = $this.data('sparkline-height') || '20px';
                sparklineWidth = $this.data('sparkline-width') || '90px';
                sparklineValue = $this.data('sparkline-bar-val');
                sparklineValueSpots1 = $this.data('sparkline-bar-val-spots-top') || null;
                sparklineValueSpots2 = $this.data('sparkline-bar-val-spots-bottom') || null;
                thisLineWidth1 = $this.data('sparkline-line-width-top') || 1;
                thisLineWidth2 = $this.data('sparkline-line-width-bottom') || 1;
                thisLineColor1 = $this.data('sparkline-color-top') || '#333333';
                thisLineColor2 = $this.data('sparkline-color-bottom') || '#ed1c24';
                thisSpotRadius1 = $this.data('sparkline-spotradius-top') || 1.5;
                thisSpotRadius2 = $this.data('sparkline-spotradius-bottom') || thisSpotRadius1;
                thisSpotColor = $this.data('sparkline-spot-color') || '#f08000';
                thisMinSpotColor1 = $this.data('sparkline-minspot-color-top') || '#ed1c24';
                thisMaxSpotColor1 = $this.data('sparkline-maxspot-color-top') || '#f08000';
                thisMinSpotColor2 = $this.data('sparkline-minspot-color-bottom') || thisMinSpotColor1;
                thisMaxSpotColor2 = $this.data('sparkline-maxspot-color-bottom') || thisMaxSpotColor1;
                thishighlightSpotColor1 = $this.data('sparkline-highlightspot-color-top') || '#50f050';
                thisHighlightLineColor1 = $this.data('sparkline-highlightline-color-top') || '#f02020';
                thishighlightSpotColor2 = $this.data('sparkline-highlightspot-color-bottom') ||
                        thishighlightSpotColor1;
                thisHighlightLineColor2 = $this.data('sparkline-highlightline-color-bottom') ||
                        thisHighlightLineColor1;
                thisFillColor1 = $this.data('sparkline-fillcolor-top') || 'transparent';
                thisFillColor2 = $this.data('sparkline-fillcolor-bottom') || 'transparent';

                $this.sparkline(sparklineValue, {
                    type: 'line',
                    spotRadius: thisSpotRadius1,
                    spotColor: thisSpotColor,
                    minSpotColor: thisMinSpotColor1,
                    maxSpotColor: thisMaxSpotColor1,
                    highlightSpotColor: thishighlightSpotColor1,
                    highlightLineColor: thisHighlightLineColor1,
                    valueSpots: sparklineValueSpots1,
                    lineWidth: thisLineWidth1,
                    width: sparklineWidth,
                    height: sparklineHeight,
                    lineColor: thisLineColor1,
                    fillColor: thisFillColor1

                });

                $this.sparkline($this.data('sparkline-line-val'), {
                    type: 'line',
                    spotRadius: thisSpotRadius2,
                    spotColor: thisSpotColor,
                    minSpotColor: thisMinSpotColor2,
                    maxSpotColor: thisMaxSpotColor2,
                    highlightSpotColor: thishighlightSpotColor2,
                    highlightLineColor: thisHighlightLineColor2,
                    valueSpots: sparklineValueSpots2,
                    lineWidth: thisLineWidth2,
                    width: sparklineWidth,
                    height: sparklineHeight,
                    lineColor: thisLineColor2,
                    composite: true,
                    fillColor: thisFillColor2

                });

                $this = null;

            }

        });

    }// end if

    /*
     * EASY PIE CHARTS
     * DEPENDENCY: js/plugins/easy-pie-chart/jquery.easy-pie-chart.min.js
     * Usage: <div class="easy-pie-chart txt-color-orangeDark" data-pie-percent="33" data-pie-size="72" data-size="72">
     *			<span class="percent percent-sign">35</span>
     * 	  	  </div>
     */

    if ($.fn.easyPieChart) {

        $('.easy-pie-chart').each(function () {
            var $this = $(this),
                    barColor = $this.css('color') || $this.data('pie-color'),
                    trackColor = $this.data('pie-track-color') || 'rgba(0,0,0,0.04)',
                    size = parseInt($this.data('pie-size')) || 25;

            $this.easyPieChart({
                barColor: barColor,
                trackColor: trackColor,
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: parseInt(size / 8.5),
                animate: 1500,
                rotate: -90,
                size: size,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }

            });

            $this = null;
        });

    } // end if

}
/* ~ END: INITIALIZE CHARTS */

function showWorkers(val) {
    var cnt = 0, field = document.getElementById("processCtrl");
    if (field !== null) { //Only runs after authentication (skips on LOGIN)
        try {
            cnt = Processo.counter();
        }
        catch(err) {
            cnt = 0
        }        
        field.textContent = cnt;
        /*
        if (cnt > 0) {
            field.style.display = 'block';
        } else {
            field.style.display = 'none';
        }
        */
    }
    
}

/*
 * QUAD::E-TICKET'S LAST ACCESS REGISTRY
 * Description: When user ENTERS e-Tickect it SAVES that time for query COUNTER reference 
 * on future new or updated E-Tickets -> managed by home.php
 */
function eTickets_Logger (from_url, to_url) {
    from_url = from_url ? from_url : 'Login';
    var loggerController = pn +'/data-source/e-tickets_controller.php';

    //Se houve uma mudança de perfil "dentro de um interface" ignoramos a mudança uma vez que não houve alteração do interface
    //PERFIL CHANGE: /js/quad/quad_lib.js -> $(document).on('click', '#profile_change li', ...
    if (from_url === to_url) {
        return;
    }    
    if ( (from_url.indexOf("etickets.php") > 0) || (to_url.indexOf("etickets.php") > 0) ) {
        var dados = {
            "from": from_url,
            "to": to_url
        };

        $.ajax({
            type: "POST",
            url: loggerController,
            dataType: 'html',
            data: dados,
            cache: true,  
            async: true,
            success: function (data) {
                console.log('App...');
                console.log( data );
            },
            error: function (xhr, status, thrownError, error) {
                console.error('Error requesting' + url + ' ' + xhr.status + ' ' + thrownError + ' ');
            }        
        });
    }    
    return;
}

/*
 * UPDATE BREADCRUMB
 */
function drawBreadCrumb(opt_breadCrumbs) {
    var a = $("nav li.active > a"),
            b = a.length;

    bread_crumb.empty(),
            bread_crumb.append($("<li class='breadcrumb-item'>Home</li>")), a.each(function () {
            bread_crumb.append($("<li class='breadcrumb-item'></li>").html($.trim($(this).clone().children(".badge").remove().end().text()))), --b || (document.title = bread_crumb.find("li:last-child").text())
    });

    // Push breadcrumb manually -> drawBreadCrumb(["Users", "John Doe"]);
    // Credits: Philip Whitt | philip.whitt@sbcglobal.net
    if (opt_breadCrumbs != undefined) {
        $.each(opt_breadCrumbs, function (index, value) {
            bread_crumb.append($("<li class='breadcrumb-item'></li>").html(value));
            document.title = bread_crumb.find("li:last-child").text();
        });
    }
}

/*
 * PAGE SETUP
 * Description: fire certain scripts that run through the page
 * to check for form elements, tooltip activation, popovers, etc...
 */
function pageSetUp() {

    //Repõe por defeito o menu de navegação
    showQuadMenu();
    
    //Scrolling TABS :: Tem problemas se houver TABS e SUB-TABS (NESTED tabs NOT SUPPORTED)
    // BOOTSTRAP ALTERNATIVE (DROPDOWN):: https://getbootstrap.com/docs/3.3/javascript/#tabs
    //    setTimeout(function () {
    //        $("ul.nav.nav-tabs").scrollingTabs();
    //    }, 1000);
    
    if (!myapp_config.isMobile) {
        // is desktop

        // activate tooltips
        //$("[rel=tooltip], [data-rel=tooltip]").tooltip();
        
        // activate popovers
        //$("[rel=popover], [data-rel=popover]").popover();

        // activate popovers with hover states
        //$("[rel=popover-hover], [data-rel=popover-hover]").popover({
        //    trigger: "hover"
        //});

        setTimeout(function(){

            // Extensão da whitelist para o sanitize das tooltip e popover
            $.fn.popover.Constructor.Default.whiteList.table = [];
            $.fn.popover.Constructor.Default.whiteList.tr = [];
            $.fn.popover.Constructor.Default.whiteList.td = [];
            $.fn.popover.Constructor.Default.whiteList.th = [];
            $.fn.popover.Constructor.Default.whiteList.div = [];
            $.fn.popover.Constructor.Default.whiteList.tbody = [];
            $.fn.popover.Constructor.Default.whiteList.thead = [];
            $.fn.popover.Constructor.Default.whiteList.select = [];
            $.fn.popover.Constructor.Default.whiteList.option = ['value'];
            $.fn.popover.Constructor.Default.whiteList.input = [];
            $.fn.popover.Constructor.Default.whiteList.label = [];
            $.fn.popover.Constructor.Default.whiteList.button = [];
            
            if ((void 0 !== $.fn.tooltip && $('[data-toggle="tooltip"]').length ? 
                    $('[data-toggle="tooltip"]').tooltip() : console.log("OOPS! bs.tooltip is not loaded"), 
                 void 0 !== $.fn.popover && $('[data-toggle="popover"]').length)) {
                $('[data-toggle="popover"]').popover({ sanitize: true }); // Nesta versão esta já é a opção por defeito
                //$('[data-toggle="popover"]').popover({ sanitize: !1 });
            } 
            
            // para garantir a compatibilidade com a versão anterior da plataforma, no que às tooltips diz respeito...
            if ((void 0 !== $.fn.tooltip && $('[rel="tooltip"]').length ? 
                    $('[rel="tooltip"]').tooltip() : console.log("OOPS! bs.tooltip is not loaded"), 
                 void 0 !== $.fn.popover && $('[rel="popover"]').length)) {
                $('[data-toggle="popover"]').popover({ sanitize: true }); // Nesta versão esta já é a opção por defeito
                //$('[data-toggle="popover"]').popover({ sanitize: !1 });
            } 
            
        },1000);


        // activate inline charts
        runAllCharts();

        // run form elements
        runAllForms();

    } else {
        // is mobile

        // activate popovers
      //  $("[rel=popover], [data-rel=popover]").popover();

        // activate popovers with hover states
      //  $("[rel=popover-hover], [data-rel=popover-hover]").popover({
      //      trigger: "hover"
     //   });

        // activate inline charts
        runAllCharts();

        // run form elements
        runAllForms();
    }
    
    /* Signal processes running */
    showWorkers();    
    
    /* QUADTABLES scroll body control :: HACK */
    /* MOUSE*/
/*    
    setTimeout(function () {
        
        $( 'div.dataTables_scrollBody' ).on( 'wheel mousewheel DOMMouseScroll', function ( e ) {
            setTimeout( function() {
                //console.log('scrolling...');
                //https://stackoverflow.com/questions/7600454/how-to-prevent-page-scrolling-when-scrolling-a-div-element
                // Other OPTION: https://stackoverflow.com/questions/4770025/how-to-disable-scrolling-temporarily
                var e0 = e.originalEvent,
                    delta = e0.wheelDelta || -e0.detail;

                this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
                e.preventDefault();
            }, 100);
        });
        //
        //https://stackoverflow.com/questions/25204282/mousewheel-wheel-and-dommousescroll-in-javascript
        // The flag that determines whether the wheel event is supported.
        var supportsWheel = false;

        // The function that will run when the events are triggered.
        function DoSomething (e) {
          // Check whether the wheel event is supported.
          if (e.type == "wheel") supportsWheel = true;
          else if (supportsWheel) return;

          // Determine the direction of the scroll (< 0 → up, > 0 → down).
          var delta = ((e.deltaY || -e.wheelDelta || e.detail) >> 10) || 1;
        }

        // Add the event listeners for each event.
        document.addEventListener('wheel', DoSomething);
        document.addEventListener('mousewheel', DoSomething);
        document.addEventListener('DOMMouseScroll', DoSomething);              
    }, 10);
*/
    /*
     * QUADSYSTEMS :: Auto scroll mechanism
     * IF TAB LINK belongs to an UL with class [scroll] and the a link has an attribute data-down="450"(px) IT WOULD automatic scroll down 450px.
     * If a link misses data-down attribute it would SCROLL to the TOP of the page
     */
/*    
    $('ul.scroll li > a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        //var target = $(e.target).attr("href") // activated tab
        var y = $(this).data('down');
        if (y === undefined) {
            $('html, body').delay(100).animate({scrollTop: '0px'}, 600, "linear" );
        } else {
            $('html, body').delay(100).animate({scrollTop: y+'px'}, 600, "linear");
        }
    });            
*/    
    /* ~ END: DELETE MODEL DATA ON HIDDEN */    
    
}

/*
 * APP AJAX REQUEST SETUP
 * Description: Executes and fetches all ajax requests also
 * updates navigation elements to active
 */
if ($.navAsAjax) {    
    // fire this on page load if nav exists
    if ($('nav').length) {
        checkURL();
    }

    $(document).on('click', 'nav a[href!="#"]', function (e) {
        e.preventDefault();
        var $this = $(e.currentTarget);
        // if parent is not active then get hash, or else page is assumed to be loaded
        if (!$this.parent().hasClass("active") && !$this.attr('target')) {

            // update window with hash
            // you could also do here:  thisDevice === "mobile" - and save a little more memory

            if ($.root_.hasClass('mobile-view-activated')) {
                $.root_.removeClass('hidden-menu');
                $('html').removeClass("hidden-menu-mobile-lock");
                window.setTimeout(function () {
                    if (window.location.search) {
                        window.location.href =
                                window.location.href.replace(window.location.search, '')
                                .replace(window.location.hash, '') + '#' + $this.attr('href');
                    } else {
                        window.location.hash = $this.attr('href');
                    }
                }, 150);
                // it may not need this delay...
            } else {
                if (window.location.search) {
                    window.location.href =
                            window.location.href.replace(window.location.search, '')
                            .replace(window.location.hash, '') + '#' + $this.attr('href');
                } else {
                    window.location.hash = $this.attr('href');
                }
            }

            // clear DOM reference
            // $this = null;
        } else { //ADDED BY PMA :: Nodes with FORMS
            //If Current FORM !== FORM on NODE => Call NODE FORM
            if ( $this.attr('href').length && ( window.location.hash.replace('#','') !== $this.attr('href') ) ) {

                if ($.root_.hasClass('mobile-view-activated')) {
                    $.root_.removeClass('hidden-menu');
                    $('html').removeClass("hidden-menu-mobile-lock");
                    window.setTimeout(function () {
                        if (window.location.search) {
                            window.location.href =
                                    window.location.href.replace(window.location.search, '')
                                    .replace(window.location.hash, '') + '#' + $this.attr('href');
                        } else {
                            window.location.hash = $this.attr('href');
                        }
                    }, 150);
                    // it may not need this delay...
                } else {
                    if (window.location.search) {
                        window.location.href =
                                window.location.href.replace(window.location.search, '')
                                .replace(window.location.hash, '') + '#' + $this.attr('href');
                    } else {
                        window.location.hash = $this.attr('href');
                    }
                }
            }            
        }
    });

    // fire links with targets on different window
    $(document).on('click', 'nav a[target="_blank"]', function (e) {
        e.preventDefault();
        var $this = $(e.currentTarget);

        window.open($this.attr('href'));
        window.location.hash = "";        
        
    });

    // fire links with targets on same window
    $(document).on('click', 'nav a[target="_top"]', function (e) {
        e.preventDefault();
        var $this = $(e.currentTarget);

        window.location = ($this.attr('href'));
    });

    // all links with hash tags are ignored
    $(document).on('click', 'nav a[href="#"]', function (e) {
        console.log('APP ignore this...');
        e.preventDefault();
    });

    // DO on hash change
    $(window).on('hashchange', function () {
        checkURL();
    });
}

/*
 * CHECK TO SEE IF URL EXISTS
 */
function checkURL() {
    //get the url by removing the hash
    //var url = location.hash.replace(/^#/, '');
    var url = location.href.split('#').splice(1).join('#');
    
    if (url.toUpperCase().includes("HTTP")) {
        if (debugState) {
            root.root.console.log("New window with URL: %c" + url, debugStyle);
        }
    }
    else {
        //BEGIN: IE11 Work Around
        if (!url) {

            try {
                var documentUrl = window.document.URL;
                if (documentUrl) {
                    if (documentUrl.indexOf('#', 0) > 0 && documentUrl.indexOf('#', 0) < (documentUrl.length + 1)) {
                        url = documentUrl.substring(documentUrl.indexOf('#', 0) + 1);
                    }
                }
            } catch (err) {
            }
        }
        //END: IE11 Work Around

        container = $('#content');
        // Do this if url exists (for page refresh, etc...)

        if (url) {
            // remove all active class
            $('nav li.active').removeClass("active");
            // match the url and add the active class
            $('nav li:has(a[href="' + url + '"])').addClass("active");
            var title = ($('nav a[href="' + url + '"]').attr('title'));

            // change page title from global var
            document.title = (title || document.title);

            // debugState
            if (debugState) {
                root.console.log("Page title: %c " + document.title, debugStyle_green);
            }

            // parse url to jquery
            loadURL(url + location.search, container);

        } else {

            // grab the first URL from nav
            var $this = $('nav > ul > li:first-child > a[href!="#"]');

            //update hash
            window.location.hash = $this.attr('href');

            //clear dom reference
            $this = null;

        }
    }
}

/*
 * LOAD AJAX PAGES
 */
function loadURL(url, container) {
    
    if (debugState) {
        root.root.console.log("Loading URL: %c" + url, debugStyle);
    }
    
    /* IF CALL WAS issued by Portal V1 AND has interface attached -> RUN IT */
    if (JS_GO_URL.length > 0) {
        url = JS_GO_URL;
        console.log('Called by Portal V1');
    }
    
    $.ajax({
        type: "GET",
        url: url,
        dataType: 'html',
        cache: true, // (warning: setting it to false will cause a timestamp and will call the request twice)
        beforeSend: function () {
            //IE11 bug fix for googlemaps (delete all google map instances)
            //check if the page is ajax = true, has google map class and the container is #content
            if ($.navAsAjax && $(".google_maps")[0] && (container[0] == $("#content")[0])) {

                // target gmaps if any on page
                var collection = $(".google_maps"),
                        i = 0;
                // run for each	map
                collection.each(function () {
                    i++;
                    // get map id from class elements
                    var divDealerMap = document.getElementById(this.id);

                    if (i == collection.length + 1) {
                        // "callback"
                    } else {
                        // destroy every map found
                        if (divDealerMap)
                            divDealerMap.parentNode.removeChild(divDealerMap);

                        // debugState
                        if (debugState) {
                            root.console.log("Destroying maps.........%c" + this.id, debugStyle_warning);
                        }
                    }
                });

                // debugState
                if (debugState) {
                    root.console.log("✔ Google map instances nuked!!!");
                }

            } //end fix

            // cluster destroy: destroy other instances that could be on the page 
            // this runs a script in the current loaded page before fetching the new page
            if ($.navAsAjax && (container[0] == $("#content")[0])) {

                /*
                 * The following elements should be removed, if they have been created:
                 *
                 *	colorList
                 *	icon
                 *	picker
                 *	inline
                 *	And unbind events from elements:
                 *	
                 *	icon
                 *	picker
                 *	inline
                 *	especially $(document).on('mousedown')
                 *	It will be much easier to add namespace to plugin events and then unbind using selected namespace.
                 *	
                 *	See also:
                 *	
                 *	http://f6design.com/journal/2012/05/06/a-jquery-plugin-boilerplate/
                 *	http://keith-wood.name/pluginFramework.html
                 */

                // this function is below the pagefunction for all pages that has instances
                if (typeof pagedestroy == 'function') {

                    try {
                        pagedestroy();

                        if (debugState) {
                            root.console.log("✔ Pagedestroy()");
                        }
                    } catch (err) {
                        pagedestroy = undefined;

                        if (debugState) {
                            root.console.log("! Pagedestroy() Catch Error > "+ err);
                        }
                    }

                }

                // destroy all inline charts
                if ($.fn.sparkline && $("#content .sparkline")[0]) {
                    $("#content .sparkline").sparkline('destroy');

                    if (debugState) {
                        root.console.log("✔ Sparkline Charts destroyed!");
                    }
                }

                if ($.fn.easyPieChart && $("#content .easy-pie-chart")[0]) {
                    $("#content .easy-pie-chart").easyPieChart('destroy');

                    if (debugState) {
                        root.console.log("✔ EasyPieChart Charts destroyed!");
                    }
                }
                // end destory all inline charts

                // destroy form controls: Datepicker, select2, autocomplete, mask, bootstrap slider
                if ($.fn.select2 && $("#content select.select2")[0]) {
                    $("#content select.select2").select2('destroy');

                    if (debugState) {
                        root.console.log("✔ Select2 destroyed!");
                    }
                }

                if ($.fn.datepicker && $('#content .datepicker')[0]) {
                    $('#content .datepicker').off();
                    $('#content .datepicker').remove();

                    if (debugState) {
                        root.console.log("✔ Datepicker destroyed!");
                    }
                }

                if ($.fn.cropper && $('#content .imagecropper')[0]) {
                    $("#content .imagecropper").cropper('destroy');
                    if (debugState) {
                        root.console.log("✔ Image Cropper destroyed!");
                    }
                }

                if ($.fn.summernote && $('#content .summernote')[0]) {
                    $("#content .summernote").summernote('destroy');
                    if (debugState) {
                        root.console.log("✔ Summernote destroyed!");
                    }
                }
                
                if ($.fn.smartWizard && $('#content .smartwizard')[0]) {
                    $("#content .smartwizard").smartWizard("reset");
                    $("#content .smartwizard").remove();
                    if (debugState) {
                        root.console.log("✔ SmartWizard destroyed!");
                    }
                }

                if ($.fn.colorpicker && $('#content .colorpicker-element')[0]) {
                    $("#content .colorpicker-element").colorpicker("destroy");
                    if (debugState) {
                        root.console.log("✔ Colorpicker destroyed!");
                    }
                }
                
                if ($.fn.dropzone && $('#content .dropzone')[0]) {
                    $("#content .dropzone").dropzone("destroy");
                    if (debugState) {
                        root.console.log("✔ Dropzone destroyed!");
                    }
                }
                
                if ($.fn.inputmask && $('#content [data-inputmask]')[0]) {
                    $("#content [data-inputmask]").inputmask("remove");
                    if (debugState) {
                        root.console.log("✔ InputMask destroyed!");
                    }
                }
                
                if ($.fn.ionRangeSlider && $('#content .rangeslider')[0]) {
                    $("#content .rangeslider").inputmask("remove");
                    if (debugState) {
                        root.console.log("✔ Ion Range Slider destroyed!");
                    }
                }
                
                // end destroy form controls

            }
            // end cluster destroy

            // empty container and var to start garbage collection (frees memory)

            pagefunction = null;

            container.removeData().html("");
            container.empty(); //Added by PMA
            
//            // place cog
//
//            //$('.ajax-loading-animation').show();
            // Only draw breadcrumb if it is main content material
            if (container[0] == $("#content")[0]) {
//
//                // clear everything else except these key DOM elements
//                // we do this because sometime plugins will leave dynamic elements behind
//                $('body').find('> *').filter(':not(' + ignore_key_elms + ')').empty().remove();
//
//                // draw breadcrumb
                  drawBreadCrumb();
//
//                // scroll up
////                $("html").animate({
////                    scrollTop: 0
////                }, "fast");
            }
            // end if
        },
        success: function (data) {
            
            // dump data to container
            container.html(data);
            
            // clear data var
            data = null;
            container = null;

        },
        error: function (xhr, status, thrownError, error) {
            container.html('<h4 class="alert alert-primary"><i class="fa fa-exclamation"></i> Error requesting <span class="txt-color-red">' + url + '</span>: ' + xhr.status + ' <span style="text-transform: capitalize;">' + thrownError + '</span></h4>');
        },
        async: true
    });
    
    /* IF CALL WAS issued by Portal V1, WE MUST CLEAN JS_GO URL, in order subsequent navigations inside Portal V2 would work as usual */
    if (JS_GO_URL.length > 0) {
        JS_GO_URL = '';
        console.log('Called by Portal V1 RESETED!!');
    }
    
    //QUAD :: E-Ticket's Last Access
    //eTickets_Logger (previous_url, url);
    //Previous URL UPDATED
    previous_url = url;
}

/*
 * HELPFUL FUNCTIONS
 * We have included some functions below that can be reused on various occasions
 * 
 * Get param value
 * example: alert( getParam( 'param' ) );
 */
function getParam(name) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regexS = "[\\?&]" + name + "=([^&#]*)";
    var regex = new RegExp(regexS);
    var results = regex.exec(window.location.href);
    if (results == null)
        return "";
    else
        return results[1];
}

