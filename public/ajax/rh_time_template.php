<?php
    require_once '../init.php';
?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fas fa-user-edit"></i></span>&nbsp;
                <h2><?php echo $ui_cadastre; ?></h2>
            </div>

            <div class="panel-container show">
                <!-- TOP FILTER OR INSTANCE -->
                <div class="panel-content">
                    <form id="filtro">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label required" for="validationCustom01">First name</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Codex" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label required" for="validationCustom02">Last name</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Lantern" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="validationCustomUsername">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    </div>
                                    <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required="">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label required" for="validationCustom01">Birthdatee</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Codex" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label required" for="validationCustom02">Country</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Lantern" required="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="validationCustomUsername">Gender</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    </div>
                                    <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END TOP FILTER OR INSTANCE -->

                <!-- TABS MENUS -->
                <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                    <div class="panel-toolbar pr-3 align-self-end">
                        <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true">Tipos Documento</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true">Delegações</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true">Trabalho Temporário</a>
                            </li>
                        </ul>
                    </div>                    
                </div>
                <!-- END TABS MENU -->

                <!-- TABS CONTENT -->
                <div class="panel-container show">
                    <div class="panel-content">

                        <div class="tab-content">

                            <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                                Tab #1
                            </div>

                            <div class="tab-pane fade" id="Tab2" role="tabpanel">
                                Tab #2
                                <div class="panel-tag">
                                        To remove Sub-Tab borders, please remove custom class <code>.boxSubTab.</code><br>Also remove this div <code>.panel-tag</code>.
                                </div>

                                <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                    <div class="panel-toolbar pr-3 align-self-end">
                                        <ul id="panel-tab-2-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#Tab21" role="tab" aria-selected="true">#2-1</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#Tab22" role="tab" aria-selected="true">#2-2</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="panel-container show boxSubTab">
                                    <div class="panel-content">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="Tab21" role="tabpanel">
                                                Tab #2.1
                                            </div>
                                            <div class="tab-pane fade" id="Tab22" role="tabpanel">
                                                Tab #2.2
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="Tab3" role="tabpanel">
                                Tab #3
                            </div>

                        </div>                    
                    </div>                    

                </div>                
                <!-- TABS CONTENT -->

            </div>
        </div>
    </div>
</div>

<script>
        $(document).ready(function () {

        });
</script>
