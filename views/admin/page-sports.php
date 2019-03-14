<div class="col-md-10 col-md-offset-1">
    <div class="card">
        <div class="card-header" data-background-color="red">
                <div class="row">
                    <div class="col-md-2">
                        <center><i class="el el-dribbble el-5x"></i></center>
                    </div>
                    <div class="col-md-10">
                        <h4 class="title">Sports Information Management</h4>
                        <p class="category">This is the section where current sports are displayed and managed</p>
                    </div>
                </div>
        </div>
        <div class="card-content">
            <div class="row">
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-pills-icons nav-pills-red nav-stacked nav-pills-danger" role="tablist">
                        <li class="sportsTablist active" id="listsports">
                            <a href="#list" role="tab" data-toggle="tab"><i class="el el-dribbble"></i> Sports List</a>
                        </li>
                        <li class="sportsTablist" id="createsports">
                            <a href="#create" role="tab" data-toggle="tab"><i class="el el-edit"></i> Sport Enlistment</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="list">
                                <div id="tbl_sports"></div>
                        </div>
                        <div class="tab-pane" id="create">
                                <form id="sportForm" method="post" action="javascript:void(0);">
                                        <input type="hidden" id="sportId" name="id">
                                        <input type="hidden" name="controller" id="controller" value="updateInsert">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Sport Name"  id="sportNameField" name="addSportName" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea placeholder="Sport Description" name="addSportDesc" id="sportDescField" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Score/Minutes per set"  id="minSessionField" name="addMinSession" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Num of Sets/ Quarters"  id="numSessionField" name="addNumSession" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-danger btn-block">Save Sport</button>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
