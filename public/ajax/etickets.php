<?php
    require_once '../init.php';
    echo '<link href="assets/js/dragtable-master/dragtable.css" rel="stylesheet">';
    echo '<link href="assets/js/bootstrap-table/extensions/fixed-columns/bootstrap-table-fixed-columns.css" rel="stylesheet">';
    echo '<link href="assets/js/summernote/summernote-bs4.css" rel="stylesheet">';
?>
<style>
    #customSignature {
        border-top: 1px solid #d3d3d378;
    }

    .myOption {
        margin-left: -10px;
        font-size: 1.2em;
        margin-right: 3px;
    }

    i.fa.fa-fw.fa-inbox {
        margin-right: 6px;
        margin-top: 3px;
    }
    #content > div.inbox-nav-bar.no-content-padding > h1 > div {
        margin-left: 4px;
    }
    #WEB_ETICKETS_wrapper {
        margin-top: 34px;
    }
    /* HIDE EXTRA + REFRESH :: ACCESSIBLE BY MENU OPTION */
    #eTicker > span, #refresh_WEB_ETICKETS {
        display: none !important;
    }
    /*    #refresh_WEB_ETICKETS {
            margin-top: -12px;
            margin-right: 6px;
        }*/

    #content > div.inbox-nav-bar.no-content-padding > h1 {
        display: flex;
    }

    #otherExtras {
        width: 36px;
        height: 20px;
        font-weight: bold;
        font-size: 13px;
        padding: 0px .844rem;
    }

    #send > i {
        margin-left:5px;
    }
    .col-md-11.div-error {
        display: block;
        position: absolute;
        left: 122px;
        top: 1px;
    }

    .div-error {
        margin: 9px 0px 0px 0px;
        position: fixed;
        left: 135px;
        width: 50%;
        font-weight: 300;
        background-color: white;
        padding-left: 10px!important;
    }

    .error-block {
        display: block;
        font-size: 11px;
        color: #b94a48;
        font-style: italic;
        text-align: initial;
        padding-top: 3px;
    }

    #eticketContent > div.etc > h2:not(:first-child) {
        border-top: 1.5px dashed #d3d3d3;
        padding-top: 6px;
    }

    .note-editor.note-frame, .note-editor.note-airframe {
        margin-top: 1rem;
    }

    #eTicket-compose-form > div.inbox-message.no-padding > div.note-editor.note-frame.card > div.note-editing-area > div.note-editable.card-block {
        text-align: left;
    }

    #eticketContent > h2 > span {
        margin-left: 15px!important;
    }

    .email-open-header>span {
        font-size: 10px;
        font-weight: 400;
        padding: 3px 5px;
        letter-spacing: normal;
        text-transform: uppercase;
        vertical-align: middle;
        line-height: 33px;
        background: #acacac;
        margin-left: 1.5rem;
    }


    .inbox-compose-footer {
        padding: 10px;
        background: #f5f5f5;
        text-align: start;
        margin-top: -1px!important;
        border-radius: 4px;
        border: 1px solid #00000032;
    }

    button.note-btn {
        height: 32px;
        border: none;
        box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.4);
        transition: all 0.4s;
    }


    #newEticket > div:nth-child(1) {
        border-bottom: 1px solid #bfbfbf;
        margin-right: 0.09rem;
        margin-left: 0.09rem;
    }

    .email-open-header {
        text-align: start;
        margin-bottom: 0px;
    }

    .ml-8 {
        margin-left: 8% !important;
    }
    /* BEGIN DROPZONE */
    #fileUploadZone {
        max-width: 89.59%!important;
        min-height: 173px;
        margin-left: 13px;
        max-height: 100px!important;
        overflow: auto;
        margin-bottom: 5px;
        margin-top: 5px;
        padding: 0px 0px 0px 0px;
        text-align: initial;
    }

    #fileUploadZone > div.dz-default.dz-message {
        margin-top: 5%;
        font-size: 1.2em;
        font-weight: 500 !important;
        font-style: italic !important;
        color: #969696 !important;
    }
    .replythis {
        padding: 3px 12px 3px 8px;
        font-size: 12px;
        line-height: 1.5;
        height: 27px;
    }
    #f0_chosen > a:hover, #f1_chosen > a:hover, #f2_chosen > a:hover, #f3_chosen > a:hover, #f4_chosen > a:hover, #f5_chosen > a:hover{
        background-color: rgba(106,126,181,.1)!important;
    }

    .dropzone .dz-preview .dz-progress {
        opacity: 1;
        z-index: 1000;
        pointer-events: none;
        position: absolute;
        height: 16px;
        left: 50%;
        top: 50%;
        margin-top: -8px;
        width: 80px;
        margin-left: -40px;
        background: rgba(255,255,255,.9);
        -webkit-transform: scale(1);
        border-radius: 8px;
        overflow: hidden;
    }

    .dz-progress {
        opacity: 0 !important;
    }

    .show {
        display: block !important;
    }
    #inbox-content > div.inbox-side-bar > h6:nth-child(2) {
        margin-top: 2rem;
    }

    ul {
        list-style: none;
        padding: 0;
        /*    margin: 0px 0px 20px 0px;*/
        margin-block-start: 1em;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        /*    padding-inline-start: 40px;*/
    }
    .inbox-side-bar h6 {
        font-weight: 400;
        font-size: 11px;
        display: block;
        padding: 0 15px;
        text-transform: uppercase;
        color: #838383;
        margin: 10px 0;
        line-height: normal;
    }
    .inbox-menu-lg {
        list-style: none;
        padding: 0;
        margin: 0 0 20px;
    }
    .inbox-side-bar h6 a {
        font-size: 14px;
        margin-top: -2px;
    }
    .inbox-menu-lg li a {
        display: block;
        padding: 6px 15px 7px;
        font-size: 13px;
        color: #333;
    }
    .inbox-menu-lg li.active a {
        font-weight: 700;
        background: #f0f0f0;
        border-bottom: 1px solid #e7e7e7;
        color: #3276b1;
    }
    .pull-right {
        float: right;
    }
    .txt-color-darken {
        color: #404040!important;
    }
    #filter-options li {
        margin-bottom: 10px;
    }
    #filter-options div.chosen-container {
        margin-left: 12px;
        max-width: 175px;
    }

    .inbox-info-bar em {
        position: absolute;
        top: 11px;
        right: 20px;
        text-align: right;
        font-style: normal;
    }

    /***************/
    #email-compose-form > div.inbox-message.no-padding > div.note-editor.note-frame.panel.panel-default > div.note-toolbar.panel-heading > div.note-btn-group.btn-group.note-para > div.note-btn-group.btn-group.open > ul {
        height: 44px !important;
    }

    .inbox-side-bar {
        /*        min-height: 900px;
                height: 100%;*/
        min-height: 82vh;
        position: absolute;
        background: #fff;
        display: block;
        width: 200px;
        padding: 10px 0 10px 14px;
        -webkit-overflow-scrolling: touch;
        z-index: 1;
    }
    .inbox-body.no-content-padding {
        margin-top: 0;
        background: #fff;
        overflow: unset;
    }

    .inbox-body .table-wrap-quad {
        background: #fff;
        padding: 10px 14px 7px;
        position: relative;
        margin-left: 200px;
        /*    overflow-x: hidden;*/
        /*
            min-height: 500px;
        */
    }
    #eticketContent {
        background-color: white;
        margin-bottom: 90px;
    }
    #newEticket {
        display: block;
        margin-bottom: 25px;
        padding: 10px 10px!important;
    }
    .email-reply-text>div, .email-reply-text>h2 {
        border-left: 1px solid #d6d6d6;
        padding-left: 10px;
        margin-left: 50px;
        color: black;
        margin-top: 0px;
        padding-top: 12px;
    }

    div.note-toolbar.btn-toolbar {
        padding: 0px 0px 15px 5px;
    }

    .select2-search-choice-close:before {
        font-family: "Font Awesome 5 Pro";
        content: '\f057';
        font-weight: 600;
    }

    /* ROW */
    .flex-container {
        display: flex;
        flex-direction: column;
        resize: vertical;
        min-height: 82vh;
    }
    .flex {
        display: flex;
        flex-direction: row;
    }
    .gutter.gutter-vertical {
        height: 18px;
        margin: 5px 2px;
        -ms-flex-negative: 0;
        flex-shrink: 0;
        -webkit-box-flex: 0;
        -ms-flex-positive: 0;
        flex-grow: 0;
        border: 1px solid #f8f8f8;
        background-color: #f8f8f8;
        cursor: row-resize;
        z-index: 1;
    }
    .gutter.gutter-vertical:hover, .gutter.gutter-vertical:focus {
        background-color: #e6e6e6;
    }
    /* END ROW */

    /*    #loading {
            display: contents;
            height: 18px!important;
        }*/

    .btn-group {
        height: 18px;
    }
    .mr-10 {
        margin-right: 10%;
    }

    .fadein, .fadeout {
        opacity: 0;
        -moz-transition: opacity 0.8s ease-in-out;
        -o-transition: opacity 0.8s ease-in-out;
        -webkit-transition: opacity 0.8s ease-in-out;
        transition: opacity 0.8s ease-in-out;
    }
    .fadein {
        opacity: 1;
    }

    #et-Filter > i {
        margin-right: -12px;
    }

    #filter-options li {
        margin-bottom: 10px;
    }

    #filter-options select, #filter-options input {
        max-width: 94%;
        margin-left: 6%;
        margin-right: 1%;
        padding-left: 8px;
        border-radius: 5px!important;
    }

    select.form-control {
        color: #80808096;
    }
    select.form-control:focus /*, select.form-control:hover*/ {
        color: inherit;
        border-color: #66afe9;
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
    }
    #new-eticket {
        padding: 10px 10px!important;
    }
    .load {
        margin-left: 0px !important;
        margin-top: -7px;
    }

    .dataTables_scrollHead, .dataTables_scrollBody {
        font-family: "Open Sans",Arial,Helvetica,Sans-Serif;
        font-size: 13px;
    }

    table.dataTable.quadtable-simple > thead > tr > th {
        font-weight: 700;
        border-bottom: 1px solid #dddddd59;
        background-color: #f7f7f7;
        /*        background-color: #fff;*/
    }

    .table-striped > tbody > tr:nth-of-type(even) {
        background-color: #f9f9f96e;    }

    .table-striped > tbody > tr:last-child td {
        border-bottom: 1px solid rgb(221, 221, 221);
    }

    .table-striped > tbody > tr:hover, .table-striped > tbody > tr.even:hover {
        background-color: #ecf3f88c !important;
    }

    .no-content-padding {
        margin: -14px 0px -3px 0px;
    }
    span.switchSpan_WEB_ETICKETS {
        margin-top: -12px !important;
        margin-bottom: 12px !important;
        margin-right: 10px !important;
    }

    #eTicker > div.dt-buttons > a.dt-button.buttons-excel.buttons-html5.btn.btn-default.btn-xs {
        margin-top: -8px !important;
    }

    #eTicker {
        margin: -34px 0 0 0;
        z-index: 999;
    }
    #WEB_ETICKETS_dtAdvancedSearch {
        display: none;
    }

    #filter-options div.form-group {
        margin-bottom: 10px;
    }

    #filter-options div.chosen-container {
        margin-left: 12px;
        max-width: 175px;
    }

    /* CHOSEN "DEFAULT" STATUS :: NONE SELECTED */
    div.chosen-container > a.chosen-single-with-deselect.chosen-default > span, div.chosen-container > a.chosen-single.chosen-default  > span {
        font-weight: 400;
        font-size: 11px;
        color: #3897e6;
    }

    /* CHOSEN WITH FILTER OPTION CHOSEN */
    div.chosen-container > a.chosen-single-with-deselect > span {
        font-weight: 500;
        font-size: 12px;
        color: #b15d31;
    }


    #f6::placeholder, #f7::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
        font-weight: 400;
        font-size: 11px;
        color: #3897e6;
        opacity: 1; /* Firefox */
    }

    #f6:-ms-input-placeholder, #f7:-ms-input-placeholder { /* Internet Explorer 10-11 */
        font-weight: 400;
        font-size: 11px;
        color: #3897e6;
    }

    #f6::-ms-input-placeholder, #f7::-ms-input-placeholder { /* Microsoft Edge */
        font-weight: 400;
        font-size: 11px;
        color: #3897e6;
    }

    #exeQry, #clsQry {
        padding: 4px 3px 4px 3px;
        margin-top: 5px;
        float: right;
    }
    #clsQry {
        margin-right:10px;
    }
    .mtb-10 {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    li.select2-search-choice {
        border-radius: 4px;
    }

    .not_seen {
        font-weight: bold;
    }

    .not_seen > sup {
        margin-left: 5px;
        color: orange;
        font-size: 1.1em;
    }
    #WEB_ETICKETS_wrapper > img {
        display: none !important;
    }


    div.inbox-download > ul > li:hover > div > a > span > i:before {
        content: '\f56d';
        font-family: "Font Awesome 5 Pro";
        font-weight: 800 !important;
    }

    sup.attach {
        top: -8px;
        left: 17px;
        font-size: 95%;
    }

    sup.attach > span {
        background-color: #6610f2a6;
        padding: 3px 5px 2px 4px;
        font-weight: bolder;
        color: #fff;
    }
    sup.daySimple {
        top: -11px;
        left: 3px;
        font-size: .85em;
        font-weight: normal !important;
        font-style: italic !important;
        color: #969696 !important;
    }

    sup.day {
        top: -8px;
        left: 21px;
        font-size: 95%;
    }
    sup.day > span {
        /*    background-color: #6610f2;*/
        font-weight: bolder;
        color: #fff;
        padding: 5px 5px 3px 5px;
    }
    /* INSERT DISABLED */
    #WEB_ETICKETS_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead > div > table > thead > tr > th > button.tblCreateBut {
        display: none !important;
    }

    /* Reply ICON */
    button.replythis > i {
        margin-right: 8px;
    }

    /*OPENED*/

    .inbox-compose-footer, .inbox-download, .inbox-info-bar, .inbox-body {
        margin-top: 1rem;
        margin-right: 0px;
        position: relative;
    }
    .inbox-body {
        margin-top: 5px;
    }
    .inbox-download, .eticket-body {
        padding: 15px 0px 8px 0px;
        /*        border-bottom: 1px solid #bfbfbf;*/
    }

    .inbox-info-bar {
        padding: 0px 0px 0px 0px;
        /*        border-bottom: 1px solid #bfbfbf;*/
    }
    #eticketContent > div.inbox-info-bar > div > div.col-sm-3.text-right > div > button > i {
        padding-right: 8px;
    }
    .from_ {
        margin-right: 10px;
    }
    .distribuition > div:not(.last) {
        margin-bottom: 5px;
    }
    .distribuition > div > span {
        font-weight: bold;
    }
    .ref_date {
        margin-left: 2%;
        font-style: italic;
        font-weight: 100!important;
        color: #c79121!important;
    }
    #eticketContent > h2 > span {
        margin-left: 15px!important;
    }
    .inbox-download {
        padding-bottom: 8px;
        max-width: 66vw;
        overflow-x: auto;
    }
    .inbox-download-list {
        display: flex;
        margin-top: 12px!important;
    }

    div.well.well-sm {
        background-color: #e1e1e145;
        border-radius: 5px;
        box-shadow: 0 0 0 1px rgba(0,0,0,0.04), 0 4px 8px 0 rgba(0,0,0,0.20);
        min-width: 155px;
        max-width: 146px;
        min-height: 105px;
        max-height: 105px;
        overflow: hidden;
        padding: 10px 10px 10px 10px;
    }

    div.well.well-sm > span > i {
        font-size: 50px;
        color: #3b9ff3;
    }

    .inbox-download-list li {
        margin: 0 20px 0 0;
    }

    div.inbox-download > ul li > div > a {
        margin-top: 3px;
    }

    div.inbox-download > ul li > div > a > span {
        font-size: 30px;
        color: #3b9ff3;
    }
    div.inbox-download > ul li > div > span {
        display: list-item;
        font-size: smaller;
        padding: 6px 2px 0px 0px;
        position: absolute;
        word-break: break-all;
        max-width: inherit;
        overflow: hidden;
        white-space:nowrap;
        text-overflow:ellipsis;
    }

    .fileName, .fileSize {
        display:inline
    }
    .fileName {
        font-size: smaller;
        padding: 6px 2px 0px 0px;
        position: absolute;
        word-break: break-all;
        /* max-width: inherit; */
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        position: inherit;
        max-width: 100px;
    }
    .fileSize {
        font-size: smaller;
        padding: 6px 2px 0px 0px;
        position: absolute;
        word-break: break-all;
        /* max-width: inherit; */
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        position: inherit;

        ul.inbox-download-list li:hover {
            background: #fff;
            border-color: silver;
        }
        /* END OPENED*/

        /* COMPOSED */

        .mtb-10 {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        /*    .inbox-compose-footer, .inbox-download, .inbox-info-bar, .inbox-message {
                margin-right: 0px;
            }
            #fc0_chosen,#fc1_chosen,#fc2_chosen,#fc3_chosen {
                max-height: 32px;
                z-index: 999;
            }

            ul.myErrorClass, input.myErrorClass, textarea.myErrorClass, select.myErrorClass {
                border-width: 1px !important;
                border-style: solid !important;
                border-color: #cc0000 !important;
                background-color: #f3d8d8 !important;
                background-image: url(http://goo.gl/GXVcmC) !important;
                background-position: 50% 50% !important;
                background-repeat: repeat !important;
            }
            ul.myErrorClass input {
                color: #666 !important;
            }
            label.myErrorClass {
                color: red;
                font-size: 11px;
                    font-style: italic;
                display: block;
            }
            .div-error {
                margin: 9px 0px 0px 0px;
                position: fixed;
                left: 135px;
                width: 50%;
                font-weight: 300;
                background-color: white;
                padding-left: 10px!important;
            }
            .error-block {
                display: block;
                font-size: 11px;
                color: #b94a48;
                font-style: italic;
            }

            #fileUploadZone {
                max-width: 90%!important;
                min-height: 173px;
                margin-left: 4px;
                max-height: 100px!important;
                overflow-x: hidden;
                margin-bottom: 5px;
                margin-top: 5px;
                padding: 0px 0px 0px 0px;
            }
            div.dz-default.dz-message {
                margin-top: 6%;
            }
            h2.email-open-header {
                border-bottom: 0px !important;
                text-align: start;
                margin-left: -11px;
            }
             E-TICKET TITLE
            #newEticket > div:nth-child(1) {
                border-bottom: 1px solid #bfbfbf;
            }

            #newEticket .row:after, #newEticket .row:before {
                content: " ";
                display: table;
            }


        #eTicket-compose-form {
            display:block;
            width: 100%;
        }
        #eTicket-compose-form row {
            width: 100;
            display:contents
        }
            @media (min-width: 768px) {
                .form-horizontal .control-label {
                    text-align: right;
                    margin-bottom: 0;
                    padding-top: 7px;
                }
            }
        */
        /* END COMPOSED */
    </style>

    <div style="display:none;">
        <br>
        <br>
        Thanks,<br>
        <strong>Pedro Mengo de Abreu</strong><br>
        <small>Partner, Chief Executive Officer</small><br>
        <br>
        QUAD SYSTEMS, Sistemas de Informação QSSI, Lda.<br>
        <small>
            Av. Boavista 3523, 5º - Sala 505 -  Edifício Aviz<br>
            4100-139 Porto - Portugal<br>
            <br>
            Telef: +351 224 908 331<br>
            Telm: +351 936 909 871<br>
            Skype: pedro.mengo.abreu-quad<br>
            <br>
            <a href="https://quad-systems.com">www.quad-systems.com</a>
            <br>
            This message contains information that may be privileged or confidential and is the property of the QUAD Systems, Sistemas de Informação. It is intended only for the person to whom it is addressed. If you are not the intended recipient, you are not authorized to read, print, retain, copy, disseminate, distribute, or use this message or any part thereof. If you receive this message in error, please notify the sender immediately and delete all copies of this message.
        </small>
    </div>

    <div id="signature" style="display:none;">
        <br>
        <br>
        Thanks,<br>
        <strong>Sadi Orlaf</strong>
        <br>
        <br>
        <small>
            General Manager - Finance Department <br>
            231 Ajax Rd, Detroit MI - 48212, USA
            <br>
            <i class="fa fa-phone"> (313) 647 6471</i>
        </small>
        <br>
        <img src="img/logo-blacknwhite.png" height="20" width="auto" style="margin-top:7px; padding-right:9px; border-right:1px dotted #9B9B9B;">
    </div>

    <div class="inbox-nav-bar no-content-padding">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-fw fa-inbox"></i> <?php echo $ui_etickets; ?>&nbsp;
            <div>
                <button id="otherExtras" type="button" class="btn btn-primary btn-xs waves-effect waves-themed dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                <div class="dropdown-menu dropright">
                    <button id="exportReport" class="dropdown-item" type="button"><i class="far fa-cloud-download myOption"></i>&nbsp;&nbsp;<?= $ui_export_short ?></button>
                    <button id="refreshData" class="dropdown-item" type="button"><i class="fas fa-sync myOption"></i>&nbsp;&nbsp;<?= $ui_refresh ?></button>
                    <button id="customSignature" class="dropdown-item" type="button"><i class="far fa-file-signature myOption"></i>&nbsp;&nbsp;<?= $ui_signature ?></button>
                </div>
            </div>
        </h1>
    </div>

    <div id="inbox-content" class="inbox-body no-content-padding">
        <!-- LEFT NAV -->
        <div class="inbox-side-bar">
            <a href="javascript:void(0);" id="new-eticket" class="btn btn-primary btn-block waves-effect waves-themed"> <strong><i class="fas fa-inbox-out fa-lg mr-10"></i><?php echo mb_strtoupper($ui_new_eticket, 'UTF-8'); ?></strong> </a>
            <h6> <?php echo $ui_eticket_folders_title; ?> <a href="javascript:void(0);" rel="tooltip" title="" data-placement="right" data-original-title="Refresh" class="pull-right txt-color-darken"><i class="fa fa-refresh"></i></a></h6>
            <ul class="inbox-menu-lg">
                <li class="active ripple grey">
                    <a class="inbox-load todos" href="javascript:void(0);"> <?php echo $ui_all; ?> </a>
                </li>
                <li class="ripple grey">
                    <a class="inbox-load abertos" href="javascript:void(0);"> <?php echo $ui_open_eticket; ?> </a>
                </li>
                <li class="ripple grey">
                    <a class="inbox-load fechados" href="javascript:void(0);"> <?php echo $ui_close_eticket; ?></a>
                </li>
            </ul>

            <h6> <?php echo $ui_eticket_filters_title; ?> <a id="et-Filter" href="javascript:void(0);" class="pull-right txt-color-darken"><i id="icn" class="fa fa-plus"></i></a></h6>
            <ul id="filter-options" class="inbox-menu-sm fadeout hide">
                <form>
                    <li>
                        <div class="form-group">
                            <select id="f0" class="form-control input-sm chosen filter" title="<?php echo $ui_priority; ?>" data-placeholder="<?php echo $ui_priority; ?>">
                                <option value="" selected></option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="form-group">
                            <select id="f1" class="form-control input-sm chosen filter" title="<?php echo $ui_eticket_category; ?>" data-placeholder="<?php echo $ui_eticket_category; ?>">
                                <option></option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="form-group">
                            <select id="f2" class="form-control input-sm chosen filter" title="<?php echo $ui_eticket_request_type; ?>" data-placeholder="<?php echo $ui_eticket_request_type; ?>">
                                <option></option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="form-group">
                            <select id="f3" class="form-control input-sm chosen filter" title="<?php echo $ui_eticket_process; ?>" data-placeholder="<?php echo $ui_eticket_process; ?>">
                                <option></option>
                            </select>
                        </div>
                    </li>
                    <li class="dragtable">
                        <div class="form-group">
                            <select id="f4" class="form-control input-sm chosen filter" title="<?php echo $ui_eticket_issuer; ?>" data-placeholder="<?php echo $ui_eticket_issuer; ?>">
                                <option></option>
                            </select>
                        </div>
                    </li>
                    <li class="dragtable">
                        <div class="form-group">
                            <select id="f5" class="form-control input-sm chosen filter" title="<?php echo $ui_eticket_receiver; ?>" data-placeholder="<?php echo $ui_eticket_receiver; ?>">
                                <option></option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="form-group">
                            <input id="f6" class="form-control input-sm filter" title="<?php echo $ui_eticket_subject; ?>" placeholder="<?php echo $ui_eticket_subject; ?>">
                        </div>
                    </li>
                    <li class="dragtable">
                        <div class="form-group">
                            <input id="f7" class="form-control input-sm filter" title="<?php echo $ui_eticket_id; ?>" placeholder="<?php echo $ui_eticket_id; ?>">
                        </div>
                    </li>
                    <li class="dragtable" style="display:flex;margin-left: 11px;">
                        <button id="clsQry" type="button" class="btn btn-sm btn-primary btn-block waves-effect waves-themed hide">
                            <i class="fas fa-times"></i>&nbsp;
                            <?php echo $ui_reset_filter; ?>
                        </button>
                        <button id="exeQry" type="button" class="btn btn-sm btn-primary btn-block waves-effect waves-themed hide">
                            <i class="fas fa-search"></i>&nbsp;
                            <?php echo $ui_search; ?>
                        </button>
                    </li>
                </form>
            </ul>

            <!--div class="air air-bottom inbox-space">
                3.5GB of <strong>10GB</strong>
                <a href="javascript:void(0);" rel="tooltip" title="" data-placement="top" data-original-title="Empty Spam" class="pull-right txt-color-darken"><i class="fa fa-trash-o fa-lg"></i></a>
                <div class="progress progress-micro">
                        <div class="progress-bar progress-primary" style="width: 34%;"></div>
                </div>
            </div-->
        </div>
        <!-- END LEFT NAV -->

        <!-- CONTENT -->
        <div class="eticketList">
            <!--                    <div class="table-wrap custom-scroll animated fast fadeInRight">-->
            <div class="table-wrap-quad animated fast fadeInRight">
                <div id="view" class="flex-container" style="display: flex; padding-left: 10px;/* resize: vertical; overflow:hidden; height:930px;*/">
                    <div id="r1" class="flex" style="display: contents;overflow: hidden;flex-basis: calc(95.4545% - 5px);z-index: 0;
                         max-height: 910px !important;min-height: 20px !important;background-color: transparent !important;">
 <!--                        <h1 id="loading" class="load table-wrap-quad custom-scroll animated fast fadeInRight quadWait"><i class="far fa-cog fa-spin"></i> Loading...</h1>-->
                        <div id="eTicker">
                            <a id="WEB_ETICKETS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-sm btn-primary toRight hide waves-effect waves-themed" href="#"><?php echo $ui_query; ?></a>
                            <table id="WEB_ETICKETS" class="table responsive table-striped table-hover nowrap quadtable-simple"></table>
                        </div>

                    </div>

                    <div id="r2" class="flex" style="display: contents;flex-direction: column;max-height:910px!important; min-height:20px!important;">
                        <div id="newEticket" class="btn btn-block fs-md waves-effect waves-themed">
                        </div>
                        <div id="eticketContent"></div>
                    </div>
                </div>

            </div>
        </div>
        <!-- END CONTENT -->
        <div class="row show-grid">
            <div></div>
        </div>
        <div class="row show-grid">
            <div></div>
        </div>
    </div>


<!--Modal: Signature -->
<div class="modal fade" id="mySignature" role="dialog">
    <style>
        #mySignature div.modal-header > button.close {
            font-size: 1.5rem;
            cursor: pointer;
            opacity: .5;
            transition: 0.3s;
        }
        #mySignature div.modal-header > button.close:hover {
            color: #ff4341 !important;
            opacity: .9 !important;
        }
        #mySignature > div > div.modal-content {
            width: 40vw;
        }
        #mySignature > div > div.modal-content > div.modal-header {
            display: block;
            border-bottom: 1px solid #00000014;
        }
        #mySignature > div > div > div.modal-body {
            padding: 0rem 1.25rem 0rem 1.25rem;
        }
        #mySignature > div > div > div.modal-body > div > div.note-popover.popover.in.note-image-popover.bottom {
            display: none !important;
        }
    </style>

    <div id="mySigContent" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="far fa-file-signature"></i>&nbsp;&nbsp;<?=$ui_signature?></h4>
            </div>
            <div class="modal-body" style="overflow-x: hidden;">
                <form id="mySigEdition" class="form-horizontal" novalidate="novalidate"></form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $ui_close;?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="saveSignature"><?php echo $ui_save;?></button>
            </div>
        </div>
    </div>
    <script>
        /* SUMMERNOTE EDITOR */
        loadScript("assets/js/summernote/summernote-bs4.js", function() {
                var y = "<?php echo @$_SESSION['lang']; ?>", editorLang = 'en-US' /* Default */,
                    mySignature = "<?=$_user->ASSINATURA?>";
                //Destroy Instância antes de Criar (língua pode mudar no entretanto)
                $('#mySigEdition').summernote('destroy');

                /* TODO :: DEFINE GLOBAL PROTOCOL TO INDEX FILES ACCORDING TO CURRENT LANGUAGE */
                if (y === 'pt') {
                    editorLang = 'pt-PT';
                }
                var resource = "assets/js/summernote/lang/summernote-" + editorLang +  ".js";
                    loadScript(resource, function () {
                        $('#mySigEdition').summernote({
                            //XSS protection for CodeView :: https://summernote.org/deep-dive/#xss-protection-for-codeview
                            codeviewFilter: false,
                            codeviewIframeFilter: true,
                            //END XSS protection for CodeView
                            height: 300,
                            focus: true,
                            tabsize: 2,
                            toolbar: [
                                ['style', ['style']],
                                ['font', ['bold', 'underline', 'clear']],
                                ['fontname', ['fontname']],
                                ['color', ['color']],
                                ['height', ['height']],
                                ['table', ['link', 'picture']],
                                ['view', ['codeview']]
                            ],
                            lang: editorLang, /* default: 'en-US' */
                            callbacks: {
                                onInit: function() {
                                    //INJECT HTML SIGNATURE (if available)
                                    $('#mySigEdition').summernote('code', mySignature);

                                    //Custom BUTTON for TOOLTIP
                                    if ( !$('#makeSnote').length ) {
                                        var noteBtn = '<button id="makeSnote" type="button" class="note-btn btn btn-light btn-sm infoTooltip" data-html="true" data-toggle="tooltip" data-trigger="hover" data-original-title="' + "<?=$hint_summernote_br?>" +'" tabindex="-1"><i class="fas fa-info"></i></button>';
                                        var fileGroup = '<div class="note-btn-group btn-group" style="float:right;">' + noteBtn + '</div>';
                                        $(fileGroup).appendTo( $('#mySigContent div.note-toolbar') );
                                        // Button tooltips
                                        $('#makeSnote').tooltip({container: 'body', placement: 'bottom'});

                                        // Button events
                                        //$('#makeSnote').click(function(event) {
                                        //});
                                    }
                                }
                            }
                        });
                    });

            //EVENT :: Save Signature to DB
            $('#saveSignature').on('click', function() {
                var usr_id = "<?=$_user->ID?>", usr="<?=$_user->UTILIZADOR?>", now_ = hoje("seconds"),
                    new_signature_ = $('#mySigContent > div > div.modal-body > div > div.note-editing-area > div.note-editable.card-block').html(),
                    prv_signature = "<?=$_user->ASSINATURA?>";

                //ASSINATURA data to pass to INSERT on quad_controller.php
                var data = {
                    "table": "WEB_ADM_UTILIZADORES",
                    "dbAlias": "A1",
                    "pk": {
                        "ID": {"type": "number"}
                    },
                    "workflow": false,
                    "operation": "UPDATE",
                    "operacao": "UPDATE",
                    "columnsArray": JSON.stringify([
                        {"db": "ID", "prv_value": usr_id , "nxt_value": usr_id , "diagnostic": "", "datatype": "sequence"},
                        {"db": "ASSINATURA", "prv_value": prv_signature, "nxt_value": new_signature_, "diagnostic": "", "datatype": ""},
                        {"db": "CHANGED_BY", "prv_value": "", "nxt_value": usr, "diagnostic": "", "datatype": ""},
                        {"db": "DT_UPDATED", "prv_value": "", "nxt_value": now_, "diagnostic": "", "datatype": "datetime"}
                    ])
                };


                //UPDATE "ASSINATURA"
                $.ajax({
                    type: "POST",
                    url: pn + '/data-source/quad_controller.php',
                    data: data,
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    cache: false,
                    async: true,
                    beforeSend: function () {
                    },
                    success: function (data) {
                        var dados = JSON.parse(data).data[0];
                        console.log(dados);
                        //$('#newEticket').hide("slow").html('');
                    }
                });
            });
        });
    </script>
</div>
<!--Modal: Signature-->



    <script type="text/javascript">
            pageSetUp();
    //    console.log('Last Seen: ' + last_seen);
            // PAGE RELATED SCRIPTS
            var pagefunction = function () {

                JS_NO_RECORDS_FOUND = "<?php echo $ui_no_etickets_found; ?>";
                var y = "<?php echo @$_SESSION['lang']; ?>", utilizador = "<?php echo @$_SESSION['utilizador']; ?>", tipo = '', where_status = [],
                        LAST_SEEN = "<?php echo @$_SESSION['ETICKET_LAST_SEEN']; ?>",
                        user_is_helpdesk = "<?= $_user->HELPDESK_SUPORTE ?>";
                console.log(LAST_SEEN);
                //Splitter :: JUST SEPARATOR
                if (1 === 1) {
                    /*
                     * GET FILTER's DATA
                     */
                    loadScript("assets/js/split-master/packages/splitjs/src/split.js", function () {
                        //https://github.com/nathancahill/split/tree/master/packages/split-grid#installation
                        //https://github.com/nathancahill/split/tree/master/packages/splitjs#options
                        try {
                            //ROWS
                            var spliterRow = Split(['#r1', '#r2'], {
                                direction: 'vertical', // 'vertical', 'horizontal'
                                cursor: 'row-resize', //row-resize',
                                sizes: [20, 80],
                                //minSize: [300, 300],
                                elementStyle: (dimension, size, gutterSize) => ({
                                        'flex-basis': `calc(${size}% - ${gutterSize}px)`,
                                    }),
                                //    gutterSize: 20,
                                gutterStyle: (dimension, gutterSize) => ({
                                        'flex-basis': `${gutterSize}px`,
                                    }),
                                //                onDragEnd: function() {
                                //                }
                            });
                        } catch (e) {
                            console.log(e);
                        }
                    });

                    // fix table height
                    tableHeightSize();

                    $(window).resize(function () {
                        tableHeightSize();
                    })
                    function tableHeightSize() {
                        if ($('body').hasClass('menu-on-top')) {
                            var menuHeight = 68;
                            // nav height

                            var tableHeight = ($(window).height() - 224) - menuHeight;
                            if (tableHeight < (320 - menuHeight)) {
                                $('.table-wrap').css('height', (320 - menuHeight) + 'px');
                            } else {
                                $('.table-wrap').css('height', tableHeight + 'px');
                            }
                        } else {
                            var tableHeight = $(window).height() - 224;
                            if (tableHeight < 320) {
                                $('.table-wrap').css('height', 320 + 'px');
                            } else {
                                $('.table-wrap').css('height', tableHeight + 'px');
                            }
                        }
                        //$('.table-wrap').css('height','auto');
                    }

                    // load delete row plugin and run pagefunction
                    loadScript("assets/js/delete-table-row/delete-table-row.min.js", function () {});
                }

    //            /*
    //             * LOAD INBOX MESSAGES
    //             */
    //            loadInbox();
    //            function loadInbox() {
    //                //Refresh Instance
    //                //Clean Bottom
    //            }

                //Signals UNREAD E-TICKETS since last time here...
                function unRead(val, row) {
                    if (LAST_SEEN) {

                        if (row['FROM_'] === utilizador) { //E-Ticket enviado pelo Próprio atualizado

                        }

                        if (row['DT_ABERTURA']) {
                            //NEW E-Tickets
                            if (Date.parse(row['DT_ABERTURA']) > Date.parse(LAST_SEEN)) {
                                return '<span class="not_seen">' + val + '<sup class="day"><i class="far fa-envelope"></i></sup>';
                            }
                        }

                        if (row['DT_UPDATED']) { //CHANGED E-Tickets (since last time user exited...)
                            if (Date.parse(row['DT_UPDATED']) > Date.parse(LAST_SEEN)) {
                                return '<span class="not_seen">' + val + '<sup class="day"><i class="far fa-inbox-in" style="color: #82c91e;"></i></sup></span>';
                            }
                        }
                    }
                    return val;
                }

                //E-TICKET LIST INSTANCE
                var optionsWEB_ETICKETS = {
                    "tableId": 'WEB_ETICKETS',
                    "table": "WEB_ETICKETS",
                    "pk": {
                        "primary": {
                            "ID_ETICKET": {"type": "number"}
                        }
                    }, // ESTADO != 'D' AND
                    "initialWhereClause": " (FROM_ LIKE '" + utilizador + "' OR TO_ LIKE '" + utilizador + "' OR CC LIKE '%" + utilizador + "%') ", //Default :: ABERTOS
                    "order_by": "COALESCE(DT_UPDATED,DT_INSERTED) DESC",
                    "scrollY": "258",
                    "recordBundle": 7,
                    "pageLenght": 7,
                    "tableCols": [
                        {
                            "responsivePriority": 1,
                            "data": null,
                            "className": "control toBottom toCenter",
                            "width": "1%",
                            "defaultContent": ''
                        }, {
                            "responsivePriority": 2,
                            "title": "<?php echo mb_strtoupper($ui_eticket_id, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_eticket_id; ?>", //Editor
                            "data": 'ID_ETICKET',
                            "name": 'ID_ETICKET',
                            "datatype": 'sequence',
                            "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                            "visible": true,
                            "className": "visibleColumn",
                            "render": function (val, type, row) {
                                return unRead(val, row);
                            }
                        }, {
                            /* INSTANCE FUNCTION */
                            "func": true,
                            "responsivePriority": 2,
                            "width": "1px",
                            "title": '<i class="far fa-paperclip"></i>', //Datatables
                            "label": '<i class="far fa-paperclip"></i>', //Editor
                            "data": 'WEB_TICKETS_NR_DOCS(ID_ETICKET)',
                            "name": 'WEB_TICKETS_NR_DOCS(ID_ETICKET)',
                            "type": "hidden",
                            "render": function (val, type, row) {
                                if (parseInt(val) > 0) {
                                    return '<i class="far fa-paperclip"></i>' + '<sup class="attach"><span class="badge border border-light rounded-pill position-absolute pos-bottom pos-right">' + val + '</span></sup>';
                                }
                                return '';
                            }
                        }, {
                            "responsivePriority": 3,
                            "title": "<?php echo mb_strtoupper($ui_eticket_subject, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_eticket_subject; ?>", //Editor
                            "data": 'ASSUNTO',
                            "name": 'ASSUNTO',
                            "className": "visibleColumn"
                                    //<i class="fas fa-paperclip"></i>
                        }, {
                            "responsivePriority": 4,
                            "title": "<?php echo mb_strtoupper($ui_open_by, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_open_by; ?>", //Editor
                            "data": 'FROM_',
                            "name": 'FROM_',
                            "className": "visibleColumn"
                        }, {
                            "responsivePriority": 5,
                            "title": "<?php echo mb_strtoupper($ui_open_dt, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_open_dt; ?>", //Editor
                            "data": 'DT_ABERTURA',
                            "name": 'DT_ABERTURA',
                            "datatype": 'datetime',
                            "className": "visibleColumn",
                            "render": function (val, type, row) {
                                var d = '', t_ = '';
                                if (row['DT_ABERTURA']) {
                                    d = new Date(row['DT_ABERTURA']).getDay();
                                    if (d == 1) {
                                        t_ = "<?php echo $ui_cal_monday_short; ?>";
                                    } else if (d == 2) {
                                        t_ = "<?php echo $ui_cal_tuesday_short; ?>";
                                    } else if (d == 3) {
                                        t_ = "<?php echo $ui_cal_wednesday_short; ?>";
                                    } else if (d == 4) {
                                        t_ = "<?php echo $ui_cal_thursday_short; ?>";
                                    } else if (d == 5) {
                                        t_ = "<?php echo $ui_cal_friday_short; ?>";
                                    } else if (d == 6) {
                                        t_ = "<?php echo $ui_cal_saturday_short; ?>";
                                    } else if (d == 0) {
                                        t_ = "<?php echo $ui_cal_sunday_short; ?>";
                                    }
                                    return val + '<sup class="daySimple">' + t_ + '</sup>';
                                    //return val + '<sup class="day"><span class="badge border border-light rounded-pill bg-success-700 position-absolute pos-bottom pos-right">' + t_  + '</span></sup>';
                                }
                                return val;
                            }
                        }, {
                            "responsivePriority": 6,
                            "title": "<?php echo mb_strtoupper($ui_last_intervener_usr, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_last_intervener_usr; ?>", //Editor
                            "data": null,
                            "name": '',
                            "className": "visibleColumn",
                            "defaultContent": '',
                            "attr": {
                                "class": "dateTimePicker seconds" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            },
                            "render": function (val, type, row) {
                                if (row['CHANGED_BY']) {
                                    return row['CHANGED_BY'];
                                }
                                return '';
                            }
                        }, {
                            "responsivePriority": 7,
                            "title": "<?php echo mb_strtoupper($ui_last_intervention_dt, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_last_intervention_dt; ?>", //Editor
                            "data": null,
                            "datatype": 'datetime',
                            "className": "visibleColumn",
                            "defaultContent": '',
                            "attr": {
                                "class": "dateTimePicker seconds" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            },
                            "render": function (val, type, row) {
                                var d = '', t_ = '';
                                if (row['DT_UPDATED']) {
                                    d = new Date(row['DT_UPDATED']).getDay();
                                    if (d == 1) {
                                        t_ = "<?php echo $ui_cal_monday_short; ?>";
                                    } else if (d == 2) {
                                        t_ = "<?php echo $ui_cal_tuesday_short; ?>";
                                    } else if (d == 3) {
                                        t_ = "<?php echo $ui_cal_wednesday_short; ?>";
                                    } else if (d == 4) {
                                        t_ = "<?php echo $ui_cal_thursday_short; ?>";
                                    } else if (d == 5) {
                                        t_ = "<?php echo $ui_cal_friday_short; ?>";
                                    } else if (d == 6) {
                                        t_ = "<?php echo $ui_cal_saturday_short; ?>";
                                    } else if (d == 0) {
                                        t_ = "<?php echo $ui_cal_sunday_short; ?>";
                                    }
                                    return row['DT_UPDATED'] + '<sup class="daySimple">' + t_ + '</sup>';
                                    //return row['DT_UPDATED'] + '<sup class="day"><span class="badge border border-light rounded-pill bg-success-700 position-absolute pos-bottom pos-right">' + t_  + '</span></sup>';
                                }
                                return '';
                            }
                        }, {
                            "responsivePriority": 1,
                            "title": "<?php echo mb_strtoupper($ui_ellapse_time, 'UTF-8'); ?>", //Datatables
                            "label": "", //Editor
                            "data": null,
                            "width": "1%",
                            "defaultContent": '',
                            "type": "hidden",
                            "render": function (val, type, row) {
                                if (row['ESTADO'] !== 'D') {
                                    return '<span class="discrete-info">' + ellapseTimeAbreviated(row['DT_ABERTURA'], row['DT_UPDATED']) + '</span>';
                                } else {
                                    //Se estiver Fechado tem de ter havido pelo menos uma RESPOSTA
                                    if (row['DT_ABERTURA'] !== null && row['DT_UPDATED'] !== null) {
                                        return '<span class="discrete-info">' + ellapseTimeAbreviated(row['DT_ABERTURA'], row['DT_UPDATED']) + '</span>';
                                    }
                                }
                                return null;
                            }
                        }, {
                            "responsivePriority": 8,
                            "title": "<?php echo mb_strtoupper($ui_priority, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_priority; ?>", //Editor
                            "data": 'PRIO_ATRIB',
                            "name": 'PRIO_ATRIB',
                            "type": "select",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'WEB_PRIO_HLPDSK',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['WEB_PRIO_HLPDSK'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "responsivePriority": 9,
                            "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_status; ?>", //Editor
                            "data": 'ESTADO',
                            "name": 'ESTADO',
                            "type": "select",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'WEB_ESTADO_HLPDSK',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['WEB_ESTADO_HLPDSK'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_eticket_process, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_eticket_process; ?>", //Editor
                            "data": 'PROCESSO',
                            "name": 'PROCESSO',
                            "type": "select",
                            "className": "none visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'WEB_PROCESSO_HLPDSK',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['WEB_PROCESSO_HLPDSK'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_eticket_request_type, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_eticket_request_type; ?>", //Editor
                            "data": 'TIPO_PEDIDO',
                            "name": 'TIPO_PEDIDO',
                            "type": "select",
                            "className": "none visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'WEB_TP_PEDIDO_HLPDSK',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['WEB_TP_PEDIDO_HLPDSK'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_eticket_category, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_eticket_category; ?>", //Editor
                            "data": 'CATEGORIA',
                            "name": 'CATEGORIA',
                            "type": "select",
                            "className": "none visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'WEB_CATEG_HLPDSK',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['WEB_CATEG_HLPDSK'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_description; ?>", //Editor
                            "data": 'DESCRICAO',
                            "name": 'DESCRICAO',
                            "type": 'textarea', //Editor
                            "className": "none visibleColumn",
                            "type": "hidden",
                            "visible": false,
                            "attr": {
                                "style": "max-width: 335px",
                            },
                            render: $.fn.dataTable.render.text() //SECURITY :: https://datatables.net/manual/security
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_eticket_requested_priority, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_eticket_requested_priority; ?>", //Editor
                            "data": 'PRIO_SOLICITADA',
                            "name": 'PRIO_SOLICITADA',
                            "type": "select",
                            "className": "none visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'WEB_PRIO_HLPDSK',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['WEB_PRIO_HLPDSK'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_eticket_priority_change_reason, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_eticket_priority_change_reason; ?>", //Editor
                            "data": 'JUSTIF_PRIO_ATRIB',
                            "name": 'JUSTIF_PRIO_ATRIB',
                            "type": 'textarea', //Editor
                            "className": "none visibleColumn",
                            "attr": {
                                "style": "max-width: 335px",
                            },
                            render: $.fn.dataTable.render.text() //SECURITY :: https://datatables.net/manual/security
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'INSERTED_BY',
                            "name": 'INSERTED_BY',
                            "type": "hidden", //Editor
                            "visible": false, //DataTables
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'DT_INSERTED',
                            "name": 'DT_INSERTED',
                            "type": "hidden", //Editor
                            "visible": false, //DataTables
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'CHANGED_BY',
                            "name": 'CHANGED_BY',
                            "type": "hidden", //Editor
                            "visible": false, //DataTables
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'DT_UPDATED',
                            "name": 'DT_UPDATED',
                            "type": "hidden", //Editor
                            "visible": false, //DataTables
                        }, {
                            "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                            "label": '',
                            "data": null,
                            "name": 'RECORD_HISTORY',
                            "type": "hidden",
                            "className": "none visibleColumn",
                            "render": function (val, type, row) {
                                return tablesRecordHistory(val, type, row);
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_eticket_to, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_eticket_to; ?>", //Editor
                            "data": 'TO_',
                            "name": 'TO_',
                            "className": "visibleColumn",
                            "visible": false,
                            "type": "hidden"
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_eticket_cc, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_eticket_cc; ?>", //Editor
                            "data": 'CC',
                            "name": 'CC',
                            "className": "visibleColumn",
                            "visible": false,
                            "type": "hidden"
    //                    }, {
    //                        "responsivePriority": 1,
    //                        "data": null,
    //                        "title": '<button class="btn btn-xs btn-success waves-effect waves-themed tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
    //                        "name": 'BUTTONS',
    //                        "type": "hidden",
    //                        //"width": "6%",
    //                        "className": "toBottom toCenter",
    //                        "render": function () {
    //                            if (user_is_helpdesk !== 'S') {
    //                                return WEB_ETICKETS.crudButtons(false, false, false);
    //                            } else {
    //                                return WEB_ETICKETS.crudButtons(false, true, false);
    //                            }
    //                        }
                        }
                    ],
                    "i18nEntries": {
                        uploadModalTitle: '<?php echo " " . $ui_file_management; ?>',
                        record: '<?php echo " " . $ui_records; ?>',
                        rowSelected: '<?php echo " " . $ui_rowSelected; ?>',
                        clickRow: '<?php echo " " . $ui_eticked_select; ?>'
                    },
                    "initComplete": function (settings) {
                        $("#loading").hide();
                        setTimeout(function () {
                            $("#WEB_ETICKETS_dtAdvancedSearch").hide();
                            loadLists();
                        }, 600);
                    }
                };

                //Se USER representar o SUPORTE, adquire condição de EDIÇÃO (para poder alterar PERIORIDADE)
                if (user_is_helpdesk === 'S') {
                    var edition_option = {
                        "responsivePriority": 1,
                        "data": null,
                        "title": '<button class="btn btn-xs btn-success waves-effect waves-themed tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                        "name": 'BUTTONS',
                        "type": "hidden",
                        //"width": "6%",
                        "className": "toBottom toCenter",
                        "render": function () {
                            return WEB_ETICKETS.crudButtons(false, true, false);
                        }
                    };
                    optionsWEB_ETICKETS.tableCols.push(edition_option);
                }
                WEB_ETICKETS = new QuadTable();
                WEB_ETICKETS.quadPrep = function () {}; //QUADPREP redefinition :: DISABLED
                WEB_ETICKETS.initTable($.extend({}, datatable_instance_defaults, optionsWEB_ETICKETS));

                //FILTER :: READ DOMAIN LISTS FROM INSTANCE
                function loadLists() {
                    var listas = ['WEB_PRIO_HLPDSK', 'WEB_CATEG_HLPDSK', 'WEB_TP_PEDIDO_HLPDSK', 'WEB_PROCESSO_HLPDSK'], output = '',
                            what = 'RV_ABBREVIATION';
                    for (var i = 0, list_data = []; i < listas.length; i++) {
                        output = '';
                        list_data = initApp.joinsData[ listas[i] ];

                        _.map(list_data, function (o, idx) {
                            output += "<option value='" + o['RV_LOW_VALUE'] + "'>" + o[what] + "</option>";
                        });
                        $('#f' + i).append(output);
                    }
                    var listas = ['ACTIVE_USERS', 'ALL_USERS'], output = '';
                    for (var i = 0, idx = 4, list_data = []; i < listas.length; i++) {
                        $('#f' + idx).html('');
                        output = '<option value=""></option>';
                        list_data = initApp.joinsData[ listas[i] ];
                        _.map(list_data, function (o, idx) {
                            if (o['UTILIZADOR'] !== utilizador) {
                                if (o['HELPDESK_SUPORTE']) {
                                    output += '<option value="' + o['ID'] + '" data-type="' + o['HELPDESK_SUPORTE'] + '">' + o['UTILIZADOR'] + '</option>';
                                } else {
                                    output += '<option value="' + o['ID'] + '">' + o['UTILIZADOR'] + '</option>';
                                }
                            } else {
                                tipo = o['HELPDESK_SUPORTE'];
                                output += '<option data-exclude="yes" value="' + o['ID'] + '" data-type="' + o['HELPDESK_SUPORTE'] + '">' + o['UTILIZADOR'] + '</option>';
                            }
                        });
                        $('#f' + idx).append(output);
                        idx = idx + 1;
                    }
                }

                //"FOLDER" Event
                $('.inbox-menu-lg li').click(function (e) {
                    e.preventDefault()
                    $that = $(this);
                    $that.parent().find('li').removeClass('active');
                    $that.addClass('active');
                });

                //SHOW E-TICKET CONTENT
                $(document).on('click', "#WEB_ETICKETS > tbody > tr", function (ev) {
                    var masterRow = $(this), msg = '',
                            masterRecord = WEB_ETICKETS.tbl.row('.selected').data();
                    if (masterRecord) {
                        $('#newEticket').hide("slow").html('');
                        $('#eticketContent').removeClass('email-reply-text').html(''); //.fadeIn("slow");
                        loadURL(pn + "ajax/eticket-opened.php", $('#eticketContent'));
                        $('#eticketContent').show("slow");
                    } else {
                        $('#newEticket').hide("slow").html(''); //If "reply" is "on"...
                        $('#eticketContent').hide("slow").html(''); //Clear "history"
                    }
                });

                //REFRESH E-TICKET LIST
                $(document).on('click', '#refresh_WEB_ETICKETS', function () {
                    var masterRecord = WEB_ETICKETS.tbl.row('.selected').data();
                    if (masterRecord) {
                        WEB_ETICKETS.tbl.rows().deselect();
                        $('#eticketContent').hide("slow").html('');
                    }

                    setTimeout(function () {
                        $("#WEB_ETICKETS_dtAdvancedSearch").hide();
                    }, 300);
                });

                /*
                 * E-TICKECTS "FOLDER" CONDITIONS: Opened, Closed
                 */
                $(".inbox-load").click(function () {
                    if ($(this).hasClass('abertos')) {
                        $('#eticketContent').hide("slow").html('')
                        where_status = [{"name": "ESTADO", "value": " != D"}];
                    } else if ($(this).hasClass('fechados')) {
                        $('#eticketContent').hide("slow").html('')
                        where_status = [{"name": "ESTADO", "value": " = D"}];
                    } else { //Todos
                        //alert('todos');
                        $('#eticketContent').hide("slow").html('')
                        where_status = '';
                    }
                    refreshQuadTable(WEB_ETICKETS, where_status);
                });

                //Instance FILTERS EXECUTE_QUERY
                $('#exeQry').on('click', function () {
                    $('#eticketContent').hide("slow").html('');
                    //Folder CONDITION
                    var fold_ = $("ul.inbox-menu-lg  li.active > a");
                    if (fold_.hasClass('abertos')) {
                        where_status = [{"name": "ESTADO", "value": " != D"}];
                    } else if (fold_.hasClass('fechados')) {
                        where_status = [{"name": "ESTADO", "value": " = D"}];
                    } else {
                        where_status = [];
                    }

                    //Prioridade
                    if (el = $('#f0').val()) {
                        where_status.push({"name": "", "value": " COALESCE(PRIO_ATRIB,PRIO_SOLICITADA) = '" + el + "'", "overrideName": true});
                    }
                    //Categoria
                    if (el = $('#f1').val()) {
                        where_status.push({"name": "CATEGORIA", "value": " = " + el + ""});
                    }
                    //Tp. Pedido
                    if (el = $('#f2').val()) {
                        where_status.push({"name": "TIPO_PEDIDO", "value": " = " + el + ""});
                    }
                    //Processo
                    if (el = $('#f3').val()) {
                        where_status.push({"name": "TIPO_PEDIDO", "value": " = " + el + ""});
                    }
                    //Emissor
                    if (el = $('#f4').val()) {
                        where_status.push({"name": "FROM_", "value": " = " + el + ""});
                    }
                    //Destinatário
                    if (el = $('#f5').val()) {
                        where_status.push({"name": "", "value": "TO_ LIKE(%" + el + "%)", "overrideName": true});
                    }
                    //ASSUNTO
                    if (el = $('#f6').val()) {
                        where_status.push({"name": "", "value": "UPPER(ASSUNTO) LIKE(%" + el.toUpperCase() + "%)", "overrideName": true});
                    }
                    //ID-ETICKET
                    if (el = $('#f7').val()) {
                        where_status.push({"name": "", "value": "UPPER(ID_ETICKET) LIKE(%" + el.toUpperCase() + "%)", "overrideName": true});
                    }

                    //console.log(where_status);
                    refreshQuadTable(WEB_ETICKETS, where_status);
                });

                $('#clsQry').on('click', function () {
                    //Folder CONDITION
                    var fold_ = $("ul.inbox-menu-lg  li.active > a");
                    if (fold_.hasClass('abertos')) {
                        where_status = [{"name": "ESTADO", "value": " != 'D'"}];
                    } else if (fold_.hasClass('fechados')) {
                        where_status = [{"name": "ESTADO", "value": " = 'D'"}];
                    } else {
                        where_status = [];
                    }

                    //Prioridade
                    $('#f0').val('');
                    //Categoria
                    $('#f1').val('');
                    //Tp. Pedido
                    $('#f2').val('');
                    //Processo
                    $('#f3').val('');
                    //Emissor
                    $('#f4').val('');
                    //Destinatário
                    $('#f5').val('');
                    //ASSUNTO
                    $('#f6').val('');
                    //ID-ETICKET
                    $('#f7').val('');

                    var options = {
                        no_results_text: "_RESULTS_VARIABLE",
                        placeholder_text_single: " ",
                        allow_single_deselect: true,
                        search_contains: true
                    };

                    setTimeout(function () {
                        var elms = $('#filter-options select.chosen');
                        elms.chosen(options);
                        elms.trigger("chosen:updated");
                    }, 100);
                    auto_hide();

                    //console.log(where_status);
                    refreshQuadTable(WEB_ETICKETS, where_status);

                });

                //CREATE NEW E-Ticket
                $("#new-eticket").click(function () {
                    $(".SmallBox").remove();
                    WEB_ETICKETS.tbl.rows().deselect();
                    $('#eticketContent').addClass('email-reply-text').hide("slow");
                    $('#eticketContent').hide("slow");
                    loadURL(pn + "ajax/eticket-compose.php", $('#newEticket'));
                    $('#newEticket').show("slow");
                });

                //E-Ticket :: FILTER SHOW/HIDE
                $('#et-Filter').on('click', function (e) {
                    var me = $('#icn'), op = $('#filter-options');
                    if (op.hasClass('fadeout')) {
                        me.removeClass('fadeout fa-plus').addClass("fa-minus fadein");
                        op.removeClass('fadeout hide').addClass("fadein show");
                    } else {
                        me.removeClass('fadeout fa-minus').addClass("fa-plus fadein");
                        op.removeClass('fadein show').addClass("fadeout hide");
                    }
                });

                /* IF FILTER HAS VALUE SHOW "FIND" BUTTON, HIDE otherwhise */
                $('#filter-options :input.filter').on('change', function (e) {
                    auto_hide();
                });

                //SHOW HIDE FILTER CONTROLLER
                function auto_hide() {
                    var elms = $('#filter-options :input.filter'), show = false;
                    for (i = 0; i < elms.length; i++) {
                        //console.log( elms[i].attributes.id.value + '=>' + elms[i].value );
                        if (elms[i].value) {
                            show = true;
                            break;
                        }
                    }
                    if (show) {
                        $('#exeQry').removeClass('hide').fadeIn(1100).addClass('show');
                        $('#clsQry').removeClass('hide').fadeIn(1100).addClass('show');
                    } else {
                        $('#clsQry').fadeOut(1100);
                        $('#exeQry').fadeOut(1100);
                        setTimeout(function () {
                            $('#exeQry').removeClass('show').addClass('hide');
                            $('#clsQry').removeClass('show').addClass('hide');
                        }, 1100);
                    }
                    console.log('AUTO HIDE');
                }
            };
            //End pagefunction

            $(document).ready(function () {
                pagefunction();
                var options = {
                    no_results_text: "_RESULTS_VARIABLE",
                    placeholder_text_single: " ",
                    allow_single_deselect: true,
                    search_contains: true
                };

                setTimeout(function () {
                    var elms = $('#filter-options select.chosen');
                    elms.chosen(options);
                    elms.trigger("chosen:updated");
                }, 1000);

                $.ajax({
                    type: "POST",
                    //url: pn+"/data-source/quad_sse_tester.php",
                    url: pn + "/data-source/quad_sse.php",
                    dataType: 'html',
                    data: {
                        "from": 'a',
                        "to": 'b'
                    },
                    cache: true,
                    async: true,
                    success: function (data) {
                        console.log('App...');
                        console.log(data);
                        //Inicialização de variável GLOBAL
                        //last_seen = data;
                    },
                    error: function (xhr, status, thrownError, error) {
                        console.log('Error ' + url + ' ' + xhr.status + ' ' + thrownError + ' ');
                    }
                });

                $(document).on('click', '#exportReport', function () {
                    $('#eTicker > div.dt-buttons.btn-group.flex-wrap > button').trigger('click');
                });
                $(document).on('click', '#refreshData', function () {
                    $('#refresh_WEB_ETICKETS').trigger('click');
                });

                $(document).on('click', '#customSignature', function () {
                    $('#mySignature').modal({show:true});
                });
            });

            var pagedestroy = function () {
                JS_NO_RECORDS_FOUND = "<?php echo $ui_no_records_found; ?>";
                $('#eTicketBody').summernote('destroy');
                $('#filter-options select.chosen').chosen("destroy");
            }
    </script>
