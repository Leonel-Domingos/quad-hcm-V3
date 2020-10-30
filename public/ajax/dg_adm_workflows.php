<?php
    require_once '../init.php';
?>

<style>
    a {
        color: #3276b1;
    }    
    
    .editable-click, a.editable-click, a.editable-click:hover {
        text-decoration: none;
        border-bottom: dashed 1px #08c;
    }
    .popover-header {
        margin: 0;
        padding: 8px 14px;
        font-size: 13px;
        background-color: #f7f7f7;
        border-bottom: 1px solid #ebebeb;
        border-radius: 2px 2px 0 0;
        margin-bottom: 12px;
        font-weight: 400;
        text-align: left;
    }
    .popover-title {
        margin: 0;
        padding: 8px 14px;
        font-size: 13px;
        background-color: #f7f7f7;
        border-bottom: 1px solid #ebebeb;
        border-radius: 2px 2px 0 0;
    }    
    
    .editable-checklist label {
        display: block;
        margin-bottom: .3em;
    }
    
    .editable-buttons.editable-buttons-bottom {
        display: block;
        margin-top: 1em;
/*    margin-top: 7px;*/
        margin-left: 0;
    }
    
    .editable-buttons.editable-buttons-bottom > .editable-submit {
        background-color: #3b9ff3;
        border-color: #3292E2;
        padding: 3px 6px 3px;
        width: 26px;
        height: 26px;
    }
    
    .editable-buttons.editable-buttons-bottom > .editable-cancel {
        margin-left: 7px;
        color: #333;
    background-color: #fff;
    border-color: #ccc;
        width: 26px;
        height: 26px;
    }    
/*    
.popover {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1010;
    display: none;
    max-width: 276px;
    padding: 1px;
    font-family: inherit;
    font-style: normal;
    font-weight: 400;
    letter-spacing: normal;
    line-break: auto;
    line-height: 1.42857143;
    text-align: left;
    text-align: start;
    text-decoration: none;
    text-shadow: none;
    text-transform: none;
    white-space: normal;
    word-break: normal;
    word-spacing: normal;
    word-wrap: normal;
    font-size: 13px;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0, 0, 0, .2);
    border-radius: 3px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
}

.popover-title {
    margin: 0;
    padding: 8px 14px;
    font-size: 13px;
    background-color: #f7f7f7;
    border-bottom: 1px solid #ebebeb;
    border-radius: 2px 2px 0 0;
}

h3 {
    display: block;
    font-size: 19px;
    font-weight: 400;
    margin: 20px 0;
    line-height: normal;
}

.popover.right > .arrow {
    top: 50%;
    left: -11px;
    margin-top: -11px;
    border-left-width: 0;
    border-right-color: #999;
    border-right-color: rgba(0, 0, 0, .25);
}

.popover > .arrow, .popover > .arrow:after {
    position: absolute;
    display: block;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
}

.popover > .arrow {
    border-width: 11px;
}
.popover > .arrow, .popover > .arrow:after {
    position: absolute;
    display: block;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
}

.popover.right > .arrow:after {
    content: " ";
    left: 1px;
    bottom: -10px;
    border-left-width: 0;
    border-right-color: #fff;
}

.popover > .arrow:after {
    border-width: 10px;
    content: "";
}

.popover-content {
    padding: 9px 14px;
}

.editableform-loading {
    background: url(../img/loading.gif) center center no-repeat;
    height: 25px;
    width: auto;
    min-width: 25px;
}

.editableform {
    margin-bottom: 0;
}

form {
    display: block;
    margin-top: 0em;
}

.editableform .control-group {
    margin-bottom: 0;
    white-space: nowrap;
}

@media (min-width: 768px)
.form-inline .form-group {
    display: inline-block;
    margin-bottom: 0;
    vertical-align: middle;
}
.editableform .control-group {
    margin-bottom: 0;
    white-space: nowrap;
}
.editable-input {
    vertical-align: top;
    display: inline-block;
    width: auto;
    white-space: normal;
    zoom: 1;
    *display: inline;
}
@media (min-width: 768px)
.form-inline .form-control {
    display: inline-block;
    width: auto;
    vertical-align: middle;
}
.form-control {
    box-shadow: none!important;
    -webkit-box-shadow: none!important;
    -moz-box-shadow: none!important;
}
.form-control, .input-lg, .input-sm, .input-xs {
    border-radius: 0!important;
    -webkit-border-radius: 0!important;
    -moz-border-radius: 0!important;
}
.form-control {
    display: block;
    width: 100%;
    height: 32px;
    padding: 6px 12px;
    font-size: 13px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.editable-error-block {
    max-width: 300px;
    margin: 5px 0 0;
    width: auto;
    white-space: normal;
}
.help-block {
    display: block;
    margin-top: 5px;
    margin-bottom: 10px;
    color: #737373;
}
.popover-content:last-child {
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}


    .editable-container.popover {
        width: auto;
    }
    
.editable-container.editable-popup {
    max-width: none!important;
}

.popover.right {
    margin-left: 10px;
}
.fade.in {
    opacity: 1;
}    
*/
</style>
<div id="calendario"></div> 

<script type="text/javascript">
        pageSetUp();

        var pagefunction = function () {

            function carrega_dados() {
                //$('#xpto :input').prop("disabled", true);
//            var loadingHtml = '<table class="">' +
//                        '    <tr class="hdr-scale">' +
//                        '        <td class="hdr-scale">&nbsp;</td>' +
//                        '    </tr>' +
//                        '    <tr class="myLoading">' +
//                        '        <td>' +
//                        '            <h1 id="loading" class="table-wrap custom-scroll animated fast fadeInRight quadWait"><i class="far fa-cog fa-spin"></i> Loading...</h1>' +
//                        '        </td>' +
//                        '    </tr>' +
//                        '</table>';
//
//            $("#calendario").html(loadingHtml);

                $.ajax({
                    url: "ajax/dg_adm_workflows_details.php",
                    type: "POST",
                    //data: ,
                    async: true,
                    cache: false,
                    success: function (html_) {
                        $("#calendario").html(html_); //.slideDown(250);  
                    }
                });

            }

            carrega_dados();
        };
        pagefunction();
        //runAllForms();
        var pagedestroy = function () {
        }
</script>
