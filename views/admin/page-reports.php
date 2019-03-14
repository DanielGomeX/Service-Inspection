<?php include ('config/config.php'); ?>
<?php include('library/lib_global.php');
$global = new lib_global(); ?>
<div class="col-md-10 col-md-offset-1">
    <div class="card">
        <div class="card-header" data-background-color="red">
            <div class="row">
                    <div class="col-md-2">
                        <center><i class="el el-graph el-5x"></i></center>
                    </div>
                    <div class="col-md-10">
                        <h4 class="title">Reports Management</h4>
                        <p class="category">This is the section where you can generate summary and main reports</p>
                    </div>
                </div>
        </div>
        <div class="card-content">
            <div class="row">
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-pills-icons nav-pills-red nav-stacked nav-pills-danger" role="tablist">
                        <li class="reportTablist active" id="infoReports">
                            <a href="#main" role="tab" data-toggle="tab"><i class="el el-star"></i> Main Reports</a>
                        </li>
                         <li class="reportTablist" id="summaryReports">
                            <a href="#summary" role="tab" data-toggle="tab"><i class="el el-briefcase"></i> General Reports</a>
                        </li>
                       
                    </ul>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                         <div class="tab-pane active" id="main">
                                        <div class="col-md-12">
                                            <div class="row">
                                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                                          <center><h1 class="redtext">1</h1></center>
                                                    </div>
                                                    <div class="col-md-10 col-sm-10">
                                                            <h5 style="text-align: center;font-weight: 800;" class="redtext">Match Main Report</h5>
                                                            <p>This report generates the match log of the certain match in accordance with the teams participated and the points accumulated in time.</p>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-md-12">
                                                            <div class="col-md-2 col-sm-2 hidden-xs"></div>
                                                            <div class="col-md-7 col-sm-7 col-xs-8">
                                                            <form id="matchMainForm" data-id="match" method="post">
                                                            <input type="hidden" name="dependent" value="match">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                                <select name="addMatchLeague" class="selectpicker parameter match" data-id="match" data-form="#matchMainForm" data-style="select-with-transition" data-size="7">
                                                                                        <option disabled selected>Choose League</option>
                                                                                        <?php foreach ($global->showAllActive('league') as $key => $row): ?>
                                                                                                <option value="<?=$row['leagueId']; ?>">
                                                                                                <?=$row['leagueName']; ?></option>
                                                                                        <?php endforeach ?>
                                                                                </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                                <select name="addMatchSport"  class="selectpicker parameter match" data-id="match" data-form="#matchMainForm"  data-style="select-with-transition" data-size="7">
                                                                                        <option disabled selected>Choose Sport</option>
                                                                                        <?php foreach ($global->showAllActive('sport') as $key => $row): ?>
                                                                                                <option value="<?=$row['sportId']; ?>">
                                                                                                <?=$row['sportName']; ?></option>
                                                                                        <?php endforeach;?>
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                                    <div class="varmatch"></div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 col-xs-4">
                                                                    <button class="btn btn-danger btn-block mainBtn" data-id="report-main-match" data-type="match">
                                                                        <center>
                                                                            <i class="el el-play el-5x"></i>
                                                                            <br/> Generate
                                                                        </center>
                                                                    </button>
                                                            </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                                          <center><h1 class="redtext">2</h1></center>
                                                    </div>
                                                    <div class="col-md-10 col-sm-10">
                                                            <h5 style="text-align: center;font-weight: 800;" class="redtext">Sport Main Report</h5>
                                                            <p>This report generates the general result occurence of the certain sport in accordance with the teams participated and the league specified.</p>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-md-12">
                                                            <div class="col-md-2 col-sm-2 hidden-xs"></div>
                                                            <div class="col-md-7 col-sm-7 col-xs-8">
                                                            <form id="sportMainForm" data-id="sport" method="post">
                                                            <input type="hidden" name="dependent" value="sport">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                                <select name="addMatchLeague" id="sportLeagueParameter" class="selectpicker parameter sport" data-id="sport" data-form="#sportMainForm" data-style="select-with-transition" data-size="7">
                                                                                        <option disabled selected>Choose League</option>
                                                                                        <?php foreach ($global->showAllActive('league') as $key => $row): ?>
                                                                                                <option value="<?=$row['leagueId']; ?>">
                                                                                                <?=$row['leagueName']; ?></option>
                                                                                        <?php endforeach ?>
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                                    <div class="varsport"></div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 col-xs-4">
                                                                    <button class="btn btn-danger btn-block mainBtn" data-id="report-main-sport"  data-type="sport">
                                                                        <center>
                                                                            <i class="el el-dribbble el-5x"></i>
                                                                            <br/> Generate
                                                                        </center>
                                                                    </button>
                                                            </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                                          <center><h1 class="redtext">3</h1></center>
                                                    </div>
                                                    <div class="col-md-10 col-sm-10">
                                                            <h5 style="text-align: center;font-weight: 800;" class="redtext">League Main Report</h5>
                                                            <p>This report generates the general result occurence of the certain league with the summarized results in accordance with the teams and the ranks based on the matches won.</p>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-md-12">
                                                            <div class="col-md-2 col-sm-2 hidden-xs"></div>
                                                            <div class="col-md-7 col-sm-7 col-xs-8">
                                                            <form id="leagueMainForm" data-id="league" method="post">
                                                            <input type="hidden" name="dependent" value="league">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                                <select name="addMatchLeague" class="selectpicker parameter league" id="playleague" data-id="league" data-form="#leagueMainForm" data-style="select-with-transition" data-size="7">
                                                                                        <option disabled selected>Choose League</option>
                                                                                        <?php foreach ($global->showAllActive('league') as $key => $row): ?>
                                                                                                <option value="<?=$row['leagueId']; ?>">
                                                                                                <?=$row['leagueName']; ?></option>
                                                                                        <?php endforeach ?>
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 col-xs-4">
                                                                    <button class="btn btn-danger btn-block mainBtn" data-id="report-main-league"  data-type="league">
                                                                        <center>
                                                                            <i class="el el-briefcase el-5x"></i>
                                                                            <br/> Generate
                                                                        </center>
                                                                    </button>
                                                            </div>
                                                    </div>
                                            </div>
                                        </div>
                        </div>
                        <div class="tab-pane" id="summary">
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                                          <center><h1 class="redtext">1</h1></center>
                                                    </div>
                                                    <div class="col-md-7 col-sm-7 col-xs-8">
                                                            <h5 style="text-align: center;font-weight: 800;" class="redtext">User General Report</h5>
                                                            <p>The User General Report generates a whollistic information in the general user.</p>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-4">
                                                            <button class="btn btn-danger btn-block summaryBtn" data-id="report-summary-user">
                                                                <center>
                                                                    <i class="el el-user el-5x"></i>
                                                                    <br/> Generate
                                                                </center>
                                                            </button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                                          <center><h1 class="redtext">2</h1></center>
                                                    </div>
                                                    <div class="col-md-7 col-sm-7 col-xs-8">
                                                            <h5 style="text-align: center;font-weight: 800;" class="redtext">Sport General Report</h5>
                                                            <p>The Sport General Report generates a whollistic information in the general sport.</p>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-4">
                                                            <button class="btn btn-danger btn-block summaryBtn" data-id="report-summary-sport">
                                                                <center>
                                                                    <i class="el el-dribbble el-5x"></i>
                                                                    <br/> Generate
                                                                </center>
                                                            </button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                                          <center><h1 class="redtext">3</h1></center>
                                                    </div>
                                                    <div class="col-md-7 col-sm-7 col-xs-8">
                                                            <h5 style="text-align: center;font-weight: 800;" class="redtext">League General Report</h5>
                                                            <p>The League General Report generates a whollistic information in the general league.</p>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-4">
                                                            <button class="btn btn-danger btn-block summaryBtn" data-id="report-summary-league">
                                                                <center>
                                                                    <i class="el el-briefcase el-5x"></i>
                                                                    <br/> Generate
                                                                </center>
                                                            </button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                                          <center><h1 class="redtext">4</h1></center>
                                                    </div>
                                                    <div class="col-md-7 col-sm-7 col-xs-8">
                                                            <h5 style="text-align: center;font-weight: 800;" class="redtext">Team General Report</h5>
                                                            <p>The Team General Report generates a whollistic information in the general team.</p>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-4">
                                                            <button class="btn btn-danger btn-block summaryBtn" data-id="report-summary-team">
                                                                <center>
                                                                    <i class="el el-group el-5x"></i>
                                                                    <br/> Generate
                                                                </center>
                                                            </button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                                          <center><h1 class="redtext">5</h1></center>
                                                    </div>
                                                    <div class="col-md-7 col-sm-7 col-xs-8">
                                                            <h5 style="text-align: center;font-weight: 800;" class="redtext">Match General Report</h5>
                                                            <p>The Match General Report generates a whollistic information in the general match.</p>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-4">
                                                            <button class="btn btn-danger btn-block summaryBtn" data-id="report-summary-match">
                                                                <center>
                                                                    <i class="el el-play el-5x"></i>
                                                                    <br/> Generate
                                                                </center>
                                                            </button>
                                                    </div>
                                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
