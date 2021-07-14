<html lang="en">

    <head>
        <meta charset="utf-8"/>
        <title>Data processing</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <script src="livecss.js" type="text/javascript"></script>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="./assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="./assets/css/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="./assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="./assets/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <link href="./assets/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME STYLES -->
        <link href="./assets/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="./assets/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="./assets/css/layout.css" rel="stylesheet" type="text/css"/>
        <link id="style_color" href="./assets/css/darkblue.css" rel="stylesheet" type="text/css"/>
        <link href="./assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <!-- <link rel="shortcut icon" href="favicon.ico"/> -->
    </head>
    <body>
        <?php 

            require_once './model/SimpleXLSX.php'; 

            //connecting to MsSql server
            $serverName = "DESKTOP-2S9R2DQ\\sqlexpress"; //serverName\instanceName

            $connectionInfo = array( "Database"=>"noc_db");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
            if( !$conn ) {
                echo "Connection could not be established.<br />";
                die( print_r( sqlsrv_errors(), true));
            }

            $excel_path = __DIR__.'/assets/db_source/Data for Freelancer.xlsx';

            if ( $xlsx = SimpleXLSX::parse($excel_path) ) {
                // echo '<table><tbody>';
                $i = 0;
            
                foreach ($xlsx->rows() as $elt) {
                //   if ($i == 0) {
                //     echo "<tr><th>No</th><th>" . $elt[0] . "</th><th>" . $elt[1] . "</th><th>" . $elt[2] . "</th><th>" . $elt[3] . "</th><th>" . $elt[4] . "</th><th>" . $elt[5] . "</th><th>" . $elt[6] . "</th><th>" . $elt[7] . "</th><th>" . $elt[8] . "</th><th>" . $elt[9] . "</th><th>" . $elt[10] . "</th><th>" . $elt[11] . "</th><th>" . $elt[12] . "</th></tr>";
                //   } else {
                //     echo "<tr><td>" . $i . "</td><td>" . $elt[0] . "</td><td>" . $elt[1] . "</td><td>" . $elt[2] . "</td><td>" . $elt[3] . "</td><td>" . $elt[4] . "</td><td>" . $elt[5] . "</td><td>" . $elt[6] . "</td><td>" . $elt[7] . "</td><td>" . $elt[8] . "</td><td>" . $elt[9] . "</td><td>" . $elt[10] . "</td><td>" . $elt[11] . "</td><td>" . $elt[12] . "</td></tr>";
                //   }      
            
                    if($i != 0)
                    {
                        $sql = "INSERT INTO tb_data (state, market, floor_level, studio_#, news_onair_booth_p1a, main_studio_use_comments, tech, mics, virtual_diector, zetta, phone_box, webcam, recorder) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                        // $params = $elt;
                        $stmt = sqlsrv_query( $conn, $sql, $elt);
                        if( $stmt === false ) {
                            die( print_r( sqlsrv_errors(), true));
                        }
                    }
                    $i++;
                }
            
                // echo "</tbody></table>";
        
            } else {
                echo SimpleXLSX::parseError();
            }
        ?>
        <!-- BEGIN CONTAINER -->
        <div class="row">
            <div class="container">
                <div class="page-container">

                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <div class="page-content" style="margin-left:0px;">
                        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                        <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">Modal title</h4>
                                    </div>
                                    <div class="modal-body">
                                        Widget settings form goes here
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn blue">Save changes</button>
                                        <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                        <!-- BEGIN STYLE CUSTOMIZER -->
                        <!-- <div class="theme-panel hidden-xs hidden-sm">
                            <div class="toggler">
                            </div>
                            <div class="toggler-close">
                            </div>
                            <div class="theme-options">
                                <div class="theme-option theme-colors clearfix">
                                    <span>
                                    THEME COLOR </span>
                                    <ul>
                                        <li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default">
                                        </li>
                                        <li class="color-darkblue tooltips" data-style="darkblue" data-container="body" data-original-title="Dark Blue">
                                        </li>
                                        <li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue">
                                        </li>
                                        <li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey">
                                        </li>
                                        <li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light">
                                        </li>
                                        <li class="color-light2 tooltips" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2">
                                        </li>
                                    </ul>
                                </div>
                                <div class="theme-option">
                                    <span>
                                    Layout </span>
                                    <select class="layout-option form-control input-sm">
                                        <option value="fluid" selected="selected">Fluid</option>
                                        <option value="boxed">Boxed</option>
                                    </select>
                                </div>
                                <div class="theme-option">
                                    <span>
                                    Header </span>
                                    <select class="page-header-option form-control input-sm">
                                        <option value="fixed" selected="selected">Fixed</option>
                                        <option value="default">Default</option>
                                    </select>
                                </div>
                                <div class="theme-option">
                                    <span>
                                    Top Menu Dropdown</span>
                                    <select class="page-header-top-dropdown-style-option form-control input-sm">
                                        <option value="light" selected="selected">Light</option>
                                        <option value="dark">Dark</option>
                                    </select>
                                </div>
                                <div class="theme-option">
                                    <span>
                                    Sidebar Mode</span>
                                    <select class="sidebar-option form-control input-sm">
                                        <option value="fixed">Fixed</option>
                                        <option value="default" selected="selected">Default</option>
                                    </select>
                                </div>
                                <div class="theme-option">
                                    <span>
                                    Sidebar Menu </span>
                                    <select class="sidebar-menu-option form-control input-sm">
                                        <option value="accordion" selected="selected">Accordion</option>
                                        <option value="hover">Hover</option>
                                    </select>
                                </div>
                                <div class="theme-option">
                                    <span>
                                    Sidebar Style </span>
                                    <select class="sidebar-style-option form-control input-sm">
                                        <option value="default" selected="selected">Default</option>
                                        <option value="light">Light</option>
                                    </select>
                                </div>
                                <div class="theme-option">
                                    <span>
                                    Sidebar Position </span>
                                    <select class="sidebar-pos-option form-control input-sm">
                                        <option value="left" selected="selected">Left</option>
                                        <option value="right">Right</option>
                                    </select>
                                </div>
                                <div class="theme-option">
                                    <span>
                                    Footer </span>
                                    <select class="page-footer-option form-control input-sm">
                                        <option value="fixed">Fixed</option>
                                        <option value="default" selected="selected">Default</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                        <!-- END STYLE CUSTOMIZER -->
                        <!-- BEGIN PAGE HEADER-->
                        <h3 class="page-title">
                        Data prociessing from Ms SQL & Excel <small>quality result and trust working promised.</small>
                        </h3>
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="row">
                            <div class="container">
                            <div class="container">
                                <h2>Form control: input</h2>
                                <p>The form below contains two input elements; one of type text and one of type password:</p>
                                <form>
                                    <div class="form-group">
                                    <label for="usr">Name:</label>
                                    <input type="text" class="form-control" id="usr">
                                    </div>
                                    <div class="form-group">
                                    <label for="pwd">Password:</label>
                                    <input type="password" class="form-control" id="pwd">
                                    </div>
                                </form>
                            </div>

                                <div class="portlet box red">
                                    <div class="portlet-body form">
                                        <form role="form">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label>Default Input</label>
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Small Input</label>
                                                    <input type="text" class="form-control input-sm" placeholder="input-sm">
                                                </div>
                                                <div class="form-group">
                                                    <label>Large Select</label>
                                                    <select class="form-control input-lg">
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                        <option>Option 4</option>
                                                        <option>Option 5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Default Select</label>
                                                    <select class="form-control">
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                        <option>Option 4</option>
                                                        <option>Option 5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Small Select</label>
                                                    <select class="form-control input-sm">
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                        <option>Option 4</option>
                                                        <option>Option 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-actions right">
                                                <button type="button" class="btn default">Cancel</button>
                                                <button type="submit" class="btn green">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            
                            
                            
                            </div>
                        </div>
                        <!-- END SAMPLE FORM PORTLET-->
                        <div class="row">
                            <div class="col-md-6 ">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Default Form
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config">
                                            </a>
                                            <a href="" class="reload">
                                            </a>
                                            <a href="" class="remove">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form role="form">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label>Email Address</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                                        <input type="text" class="form-control" placeholder="Email Address">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Circle Input</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon input-circle-left">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                                        <input type="text" class="form-control input-circle-right" placeholder="Email Address">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Password</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Left Icon</label>
                                                    <div class="input-icon">
                                                        <i class="fa fa-bell-o"></i>
                                                        <input type="text" class="form-control" placeholder="Left icon">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Left Icon(.input-sm)</label>
                                                    <div class="input-icon input-icon-sm">
                                                        <i class="fa fa-bell-o"></i>
                                                        <input type="text" class="form-control input-sm" placeholder="Left icon">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Left Icon(.input-lg)</label>
                                                    <div class="input-icon input-icon-lg">
                                                        <i class="fa fa-bell-o"></i>
                                                        <input type="text" class="form-control input-lg" placeholder="Left icon">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Right Icon</label>
                                                    <div class="input-icon right">
                                                        <i class="fa fa-microphone fa-spin"></i>
                                                        <input type="text" class="form-control" placeholder="Right icon">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Right Icon(.input-sm)</label>
                                                    <div class="input-icon input-icon-sm right">
                                                        <i class="fa fa-bell-o"></i>
                                                        <input type="text" class="form-control input-sm" placeholder="Left icon">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Right Icon(.input-lg)</label>
                                                    <div class="input-icon input-icon-lg right">
                                                        <i class="fa fa-bell-o"></i>
                                                        <input type="text" class="form-control input-lg" placeholder="Left icon">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Circle Input</label>
                                                    <div class="input-icon right">
                                                        <i class="fa fa-microphone"></i>
                                                        <input type="text" class="form-control input-circle" placeholder="Right icon">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Input with Icon</label>
                                                    <div class="input-group input-icon right">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                                        <i class="fa fa-exclamation tooltips" data-original-title="Invalid email." data-container="body"></i>
                                                        <input id="email" class="input-error form-control" type="text" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Input With Spinner</label>
                                                    <input class="form-control spinner" type="text" placeholder="Process something"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Static Control</label>
                                                    <p class="form-control-static">
                                                        email@example.com
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Disabled</label>
                                                    <input type="text" class="form-control" placeholder="Disabled" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Readonly</label>
                                                    <input type="text" class="form-control" placeholder="Readonly" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Dropdown</label>
                                                    <select class="form-control">
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                        <option>Option 4</option>
                                                        <option>Option 5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Multiple Select</label>
                                                    <select multiple class="form-control">
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                        <option>Option 4</option>
                                                        <option>Option 5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Textarea</label>
                                                    <textarea class="form-control" rows="3"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile1">File input</label>
                                                    <input type="file" id="exampleInputFile1">
                                                    <p class="help-block">
                                                        some help text here.
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Checkboxes</label>
                                                    <div class="checkbox-list">
                                                        <label>
                                                        <input type="checkbox"> Checkbox 1 </label>
                                                        <label>
                                                        <input type="checkbox"> Checkbox 2 </label>
                                                        <label>
                                                        <input type="checkbox" disabled> Disabled </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inline Checkboxes</label>
                                                    <div class="checkbox-list">
                                                        <label class="checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1" value="option1"> Checkbox 1 </label>
                                                        <label class="checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox2" value="option2"> Checkbox 2 </label>
                                                        <label class="checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox3" value="option3" disabled> Disabled </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Radio</label>
                                                    <div class="radio-list">
                                                        <label>
                                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked> Option 1</label>
                                                        <label>
                                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"> Option 2 </label>
                                                        <label>
                                                        <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled> Disabled </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Inline Radio</label>
                                                    <div class="radio-list">
                                                        <label class="radio-inline">
                                                        <input type="radio" name="optionsRadios" id="optionsRadios4" value="option1" checked> Option 1 </label>
                                                        <label class="radio-inline">
                                                        <input type="radio" name="optionsRadios" id="optionsRadios5" value="option2"> Option 2 </label>
                                                        <label class="radio-inline">
                                                        <input type="radio" name="optionsRadios" id="optionsRadios6" value="option3" disabled> Disabled </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue">Submit</button>
                                                <button type="button" class="btn default">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Form Input Width Sizing
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config">
                                            </a>
                                            <a href="" class="reload">
                                            </a>
                                            <a href="" class="remove">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form role="form">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label>Fluid Input</label>
                                                    <input type="text" class="form-control" placeholder="fluid">
                                                    <div class="input-icon right margin-top-10">
                                                        <i class="fa fa-check"></i>
                                                        <input type="text" class="form-control" placeholder="fluid">
                                                    </div>
                                                    <div class="input-icon margin-top-10">
                                                        <i class="fa fa-user"></i>
                                                        <input type="text" class="form-control" placeholder="fluid">
                                                    </div>
                                                    <div class="input-group margin-top-10">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                                        <input type="email" class="form-control" placeholder=".input-xlarge">
                                                    </div>
                                                    <div class="input-group margin-top-10">
                                                        <input type="email" class="form-control" placeholder=".input-xlarge">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="form-group">
                                                    <label>Extra Large Input</label>
                                                    <input type="text" class="form-control input-xlarge" placeholder=".input-xlarge">
                                                    <div class="input-icon right input-xlarge margin-top-10">
                                                        <i class="fa fa-check"></i>
                                                        <input type="text" class="form-control" placeholder=".input-xlarge">
                                                    </div>
                                                    <div class="input-icon input-xlarge margin-top-10">
                                                        <i class="fa fa-user"></i>
                                                        <input type="text" class="form-control" placeholder=".input-xlarge">
                                                    </div>
                                                    <div class="input-group input-xlarge margin-top-10">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                                        <input type="email" class="form-control" placeholder=".input-xlarge">
                                                    </div>
                                                    <div class="input-group input-xlarge margin-top-10">
                                                        <input type="email" class="form-control" placeholder=".input-xlarge">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="form-group">
                                                    <label>Large Input</label>
                                                    <input type="text" class="form-control input-large" placeholder=".input-large">
                                                    <div class="input-icon right input-large margin-top-10">
                                                        <i class="fa fa-check"></i>
                                                        <input type="text" class="form-control" placeholder=".input-large">
                                                    </div>
                                                    <div class="input-icon input-large margin-top-10">
                                                        <i class="fa fa-user"></i>
                                                        <input type="text" class="form-control" placeholder=".input-large">
                                                    </div>
                                                    <div class="input-group input-large margin-top-10">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                                        <input type="email" class="form-control" placeholder=".input-large">
                                                    </div>
                                                    <div class="input-group input-large margin-top-10">
                                                        <input type="email" class="form-control" placeholder=".input-large">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="form-group">
                                                    <label>Medium Input</label>
                                                    <input type="text" class="form-control input-medium" placeholder=".input-medium">
                                                    <div class="input-icon right input-medium margin-top-10">
                                                        <i class="fa fa-check"></i>
                                                        <input type="text" class="form-control" placeholder=".input-medium">
                                                    </div>
                                                    <div class="input-icon input-medium margin-top-10">
                                                        <i class="fa fa-user"></i>
                                                        <input type="text" class="form-control" placeholder=".input-medium">
                                                    </div>
                                                    <div class="input-group input-medium margin-top-10">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                                        <input type="email" class="form-control" placeholder=".input-medium">
                                                    </div>
                                                    <div class="input-group input-medium margin-top-10">
                                                        <input type="email" class="form-control" placeholder=".input-medium">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="form-group">
                                                    <label>Small Input</label>
                                                    <input type="text" class="form-control input-small" placeholder=".input-small">
                                                    <div class="input-icon right input-small margin-top-10">
                                                        <i class="fa fa-check"></i>
                                                        <input type="text" class="form-control" placeholder=".input-small">
                                                    </div>
                                                    <div class="input-icon input-small margin-top-10">
                                                        <i class="fa fa-user"></i>
                                                        <input type="text" class="form-control" placeholder=".input-small">
                                                    </div>
                                                    <div class="input-group input-small margin-top-10">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                                        <input type="email" class="form-control" placeholder=".input-small">
                                                    </div>
                                                    <div class="input-group input-small margin-top-10">
                                                        <input type="email" class="form-control" placeholder=".input-small">
                                                        <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Extra Small Input</label>
                                                    <input type="text" class="form-control input-xsmall" placeholder=".input-xsmall">
                                                </div>
                                                <div class="form-group">
                                                    <label>Extra Large Select</label>
                                                    <select class="form-control input-xlarge">
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                        <option>Option 4</option>
                                                        <option>Option 5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Large Select</label>
                                                    <select class="form-control input-large">
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                        <option>Option 4</option>
                                                        <option>Option 5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Medium Select</label>
                                                    <select class="form-control input-medium">
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                        <option>Option 4</option>
                                                        <option>Option 5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Small Select</label>
                                                    <select class="form-control input-small">
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                        <option>Option 4</option>
                                                        <option>Option 5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Extra Small Select</label>
                                                    <select class="form-control input-xsmall">
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                        <option>Option 4</option>
                                                        <option>Option 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-actions right">
                                                <button type="button" class="btn default">Cancel</button>
                                                <button type="submit" class="btn green">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
                            </div>
                            <div class="col-md-6 ">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet box green ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Horizontal Form
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config">
                                            </a>
                                            <a href="" class="reload">
                                            </a>
                                            <a href="" class="remove">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form class="form-horizontal" role="form">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Block Help</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" placeholder="Enter text">
                                                        <span class="help-block">
                                                        A block of help text. </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Inline Help</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control input-inline input-medium" placeholder="Enter text">
                                                        <span class="help-inline">
                                                        Inline help. </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Input Group</label>
                                                    <div class="col-md-9">
                                                        <div class="input-inline input-medium">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                <i class="fa fa-user"></i>
                                                                </span>
                                                                <input type="email" class="form-control" placeholder="Email Address">
                                                            </div>
                                                        </div>
                                                        <span class="help-inline">
                                                        Inline help. </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Email Address</label>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                            <i class="fa fa-envelope"></i>
                                                            </span>
                                                            <input type="email" class="form-control" placeholder="Email Address">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Password</label>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" placeholder="Password">
                                                            <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Left Icon</label>
                                                    <div class="col-md-9">
                                                        <div class="input-icon">
                                                            <i class="fa fa-bell-o"></i>
                                                            <input type="text" class="form-control" placeholder="Left icon">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Right Icon</label>
                                                    <div class="col-md-9">
                                                        <div class="input-icon right">
                                                            <i class="fa fa-microphone"></i>
                                                            <input type="text" class="form-control" placeholder="Right icon">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Icon Input in Group Input</label>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <div class="input-icon">
                                                                <i class="fa fa-lock fa-fw"></i>
                                                                <input id="newpassword" class="form-control" type="text" name="password" placeholder="password"/>
                                                            </div>
                                                            <span class="input-group-btn">
                                                            <button id="genpassword" class="btn btn-success" type="button"><i class="fa fa-arrow-left fa-fw"/></i> Random</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Input With Spinner</label>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control spinner" placeholder="Password">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Static Control</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-static">
                                                            email@example.com
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Disabled</label>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" placeholder="Disabled" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Readonly</label>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" placeholder="Readonly" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Dropdown</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control">
                                                            <option>Option 1</option>
                                                            <option>Option 2</option>
                                                            <option>Option 3</option>
                                                            <option>Option 4</option>
                                                            <option>Option 5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Multiple Select</label>
                                                    <div class="col-md-9">
                                                        <select multiple class="form-control">
                                                            <option>Option 1</option>
                                                            <option>Option 2</option>
                                                            <option>Option 3</option>
                                                            <option>Option 4</option>
                                                            <option>Option 5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Textarea</label>
                                                    <div class="col-md-9">
                                                        <textarea class="form-control" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile" class="col-md-3 control-label">File input</label>
                                                    <div class="col-md-9">
                                                        <input type="file" id="exampleInputFile">
                                                        <p class="help-block">
                                                            some help text here.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Checkboxes</label>
                                                    <div class="col-md-9">
                                                        <div class="checkbox-list">
                                                            <label>
                                                            <input type="checkbox"> Checkbox 1 </label>
                                                            <label>
                                                            <input type="checkbox"> Checkbox 1 </label>
                                                            <label>
                                                            <input type="checkbox" disabled> Disabled </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Inline Checkboxes</label>
                                                    <div class="col-md-9">
                                                        <div class="checkbox-list">
                                                            <label class="checkbox-inline">
                                                            <input type="checkbox" id="inlineCheckbox21" value="option1"> Checkbox 1 </label>
                                                            <label class="checkbox-inline">
                                                            <input type="checkbox" id="inlineCheckbox22" value="option2"> Checkbox 2 </label>
                                                            <label class="checkbox-inline">
                                                            <input type="checkbox" id="inlineCheckbox23" value="option3" disabled> Disabled </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Radio</label>
                                                    <div class="col-md-9">
                                                        <div class="radio-list">
                                                            <label>
                                                            <input type="radio" name="optionsRadios" id="optionsRadios22" value="option1" checked> Option 1 </label>
                                                            <label>
                                                            <input type="radio" name="optionsRadios" id="optionsRadios23" value="option2" checked> Option 2 </label>
                                                            <label>
                                                            <input type="radio" name="optionsRadios" id="optionsRadios24" value="option2" disabled> Disabled </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Inline Radio</label>
                                                    <div class="col-md-9">
                                                        <div class="radio-list">
                                                            <label class="radio-inline">
                                                            <input type="radio" name="optionsRadios" id="optionsRadios25" value="option1" checked> Option 1 </label>
                                                            <label class="radio-inline">
                                                            <input type="radio" name="optionsRadios" id="optionsRadios26" value="option2" checked> Option 2 </label>
                                                            <label class="radio-inline">
                                                            <input type="radio" name="optionsRadios" id="optionsRadios27" value="option3" disabled> Disabled </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn green">Submit</button>
                                                        <button type="button" class="btn default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet box purple ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Horizontal Form Height Sizing
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config">
                                            </a>
                                            <a href="" class="reload">
                                            </a>
                                            <a href="" class="remove">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form class="form-horizontal" role="form">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Large Input</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control input-lg" placeholder="Large Input">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Default Input</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" placeholder="Default Input">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Small Input</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control input-sm" placeholder="Default Input">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Large Select</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control input-lg">
                                                            <option>Option 1</option>
                                                            <option>Option 2</option>
                                                            <option>Option 3</option>
                                                            <option>Option 4</option>
                                                            <option>Option 5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Default Select</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control">
                                                            <option>Option 1</option>
                                                            <option>Option 2</option>
                                                            <option>Option 3</option>
                                                            <option>Option 4</option>
                                                            <option>Option 5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Small Select</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control input-sm">
                                                            <option>Option 1</option>
                                                            <option>Option 2</option>
                                                            <option>Option 3</option>
                                                            <option>Option 4</option>
                                                            <option>Option 5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions right1">
                                                <button type="button" class="btn default">Cancel</button>
                                                <button type="submit" class="btn green">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet box purple ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Fluid Input Groups
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config">
                                            </a>
                                            <a href="" class="reload">
                                            </a>
                                            <a href="" class="remove">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <h4 class="block">Checkboxe Addons</h4>
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                        <input type="checkbox">
                                                        </span>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control">
                                                        <span class="input-group-addon">
                                                        <input type="checkbox">
                                                        </span>
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                            </div>
                                            <!-- /.row -->
                                        </form>
                                        <h4 class="block">Button Addons</h4>
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                        <button class="btn red" type="button">Go!</button>
                                                        </span>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control">
                                                        <span class="input-group-btn">
                                                        <button class="btn blue" type="button">Go!</button>
                                                        </span>
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                            </div>
                                            <!-- /.row -->
                                        </form>
                                        <h4 class="block">Button Addons On Both Sides</h4>
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                        <button class="btn red" type="button">Go!</button>
                                                        </span>
                                                        <input type="text" class="form-control">
                                                        <span class="input-group-btn">
                                                        <button class="btn blue" type="button">Go!</button>
                                                        </span>
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                            </div>
                                        </form>
                                        <h4 class="block">Buttons With Dropdowns</h4>
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn green dropdown-toggle" data-toggle="dropdown">Action <i class="fa fa-angle-down"></i></button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Another action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Something else here </a>
                                                                </li>
                                                                <li class="divider">
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Separated link </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /btn-group -->
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn yellow dropdown-toggle" data-toggle="dropdown">Action <i class="fa fa-angle-down"></i></button>
                                                            <ul class="dropdown-menu pull-right">
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Another action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Something else here </a>
                                                                </li>
                                                                <li class="divider">
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Separated link </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /btn-group -->
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                            </div>
                                            <!-- /.row -->
                                        </form>
                                        <h4 class="block">Buttons With Dropdowns On Both Sides</h4>
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn green dropdown-toggle" data-toggle="dropdown">Action <i class="fa fa-angle-down"></i></button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Another action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Something else here </a>
                                                                </li>
                                                                <li class="divider">
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Separated link </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /btn-group -->
                                                        <input type="text" class="form-control">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn yellow dropdown-toggle" data-toggle="dropdown">Action <i class="fa fa-angle-down"></i></button>
                                                            <ul class="dropdown-menu pull-right">
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Another action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Something else here </a>
                                                                </li>
                                                                <li class="divider">
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Separated link </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /btn-group -->
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                            </div>
                                            <!-- /.row -->
                                        </form>
                                        <h4 class="block">Segmented Buttons</h4>
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn default" tabindex="-1">Action</button>
                                                            <button type="button" class="btn default dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                                                            <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Another action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Something else here </a>
                                                                </li>
                                                                <li class="divider">
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Separated link </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <!-- /.input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn green" tabindex="-1">Action</button>
                                                            <button type="button" class="btn green dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                                                            <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right" role="menu">
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Another action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Something else here </a>
                                                                </li>
                                                                <li class="divider">
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Separated link </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- /.input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet box purple ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Fixed Input Groups
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config">
                                            </a>
                                            <a href="" class="reload">
                                            </a>
                                            <a href="" class="remove">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <h4 class="block">Checkboxe Addons</h4>
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group input-medium">
                                                        <span class="input-group-addon">
                                                        <input type="checkbox">
                                                        </span>
                                                        <input type="text" class="form-control" placeholder=".input-medium">
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                                <div class="col-md-6">
                                                    <div class="input-group input-medium">
                                                        <input type="text" class="form-control" placeholder=".input-medium">
                                                        <span class="input-group-addon">
                                                        <input type="checkbox">
                                                        </span>
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                            </div>
                                            <!-- /.row -->
                                        </form>
                                        <h4 class="block">Button Addons</h4>
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group input-medium">
                                                        <span class="input-group-btn">
                                                        <button class="btn red" type="button">Go!</button>
                                                        </span>
                                                        <input type="text" class="form-control" placeholder=".input-medium">
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                                <div class="col-md-6">
                                                    <div class="input-group input-medium">
                                                        <input type="text" class="form-control" placeholder=".input-medium">
                                                        <span class="input-group-btn">
                                                        <button class="btn blue" type="button">Go!</button>
                                                        </span>
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                            </div>
                                            <!-- /.row -->
                                        </form>
                                        <h4 class="block">Button Addons On Both Sides</h4>
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group input-large">
                                                        <span class="input-group-btn">
                                                        <button class="btn red" type="button">Go!</button>
                                                        </span>
                                                        <input type="text" class="form-control" placeholder=".input-large">
                                                        <span class="input-group-btn">
                                                        <button class="btn blue" type="button">Go!</button>
                                                        </span>
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                            </div>
                                        </form>
                                        <h4 class="block">Buttons With Dropdowns</h4>
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group input-medium">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn green dropdown-toggle" data-toggle="dropdown">Action <i class="fa fa-angle-down"></i></button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Another action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Something else here </a>
                                                                </li>
                                                                <li class="divider">
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Separated link </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /btn-group -->
                                                        <input type="text" class="form-control" placeholder=".input-medium">
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                                <div class="col-md-6">
                                                    <div class="input-group input-medium">
                                                        <input type="text" class="form-control" placeholder=".input-medium">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn yellow dropdown-toggle" data-toggle="dropdown">Action <i class="fa fa-angle-down"></i></button>
                                                            <ul class="dropdown-menu pull-right">
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Another action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Something else here </a>
                                                                </li>
                                                                <li class="divider">
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Separated link </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /btn-group -->
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                            </div>
                                            <!-- /.row -->
                                        </form>
                                        <h4 class="block">Buttons With Dropdowns On Both Sides</h4>
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group input-xlarge">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn green dropdown-toggle" data-toggle="dropdown">Action <i class="fa fa-angle-down"></i></button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Another action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Something else here </a>
                                                                </li>
                                                                <li class="divider">
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Separated link </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /btn-group -->
                                                        <input type="text" class="form-control" placeholder=".input-xlarge">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn yellow dropdown-toggle" data-toggle="dropdown">Action <i class="fa fa-angle-down"></i></button>
                                                            <ul class="dropdown-menu pull-right">
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Another action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Something else here </a>
                                                                </li>
                                                                <li class="divider">
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Separated link </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /btn-group -->
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                            </div>
                                            <!-- /.row -->
                                        </form>
                                        <h4 class="block">Segmented Buttons</h4>
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group input-large">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn default" tabindex="-1">Action</button>
                                                            <button type="button" class="btn default dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                                                            <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Another action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Something else here </a>
                                                                </li>
                                                                <li class="divider">
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Separated link </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder=".input-large">
                                                    </div>
                                                    <!-- /.input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                            </div>
                                        </form>
                                        <form role="form" class="margin-top-10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group input-large">
                                                        <input type="text" class="form-control" placeholder=".input-large">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn green" tabindex="-1">Action</button>
                                                            <button type="button" class="btn green dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                                                            <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Another action </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Something else here </a>
                                                                </li>
                                                                <li class="divider">
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                    Separated link </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- /.input-group -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
                                <div class="portlet box blue ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Validation States
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config">
                                            </a>
                                            <a href="" class="reload">
                                            </a>
                                            <a href="" class="remove">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form role="form">
                                            <div class="form-body">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Input with success</label>
                                                    <input type="text" class="form-control" id="inputSuccess">
                                                </div>
                                                <div class="form-group has-warning">
                                                    <label class="control-label">Input with warning</label>
                                                    <input type="text" class="form-control" id="inputWarning">
                                                </div>
                                                <div class="form-group has-error">
                                                    <label class="control-label">Input with error</label>
                                                    <input type="text" class="form-control" id="inputError">
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn default">Cancel</button>
                                                <button type="submit" class="btn red">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="portlet box yellow ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Validation States With Icons
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config">
                                            </a>
                                            <a href="" class="reload">
                                            </a>
                                            <a href="" class="remove">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form role="form">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label">Default input</label>
                                                    <div class="input-icon right">
                                                        <i class="fa fa-info-circle tooltips" data-original-title="Email address" data-container="body"></i>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group has-success">
                                                    <label class="control-label">Input with success</label>
                                                    <div class="input-icon right">
                                                        <i class="fa fa-check tooltips" data-original-title="You look OK!" data-container="body"></i>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group has-warning">
                                                    <label class="control-label">Input with warning</label>
                                                    <div class="input-icon right">
                                                        <i class="fa fa-warning tooltips" data-original-title="please provide an email" data-container="body"></i>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group has-error">
                                                    <label class="control-label">Input with error</label>
                                                    <div class="input-icon right">
                                                        <i class="fa fa-exclamation tooltips" data-original-title="please write a valid email" data-container="body"></i>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions right">
                                                <button type="button" class="btn default">Cancel</button>
                                                <button type="submit" class="btn green">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="portlet box purple">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> Horizontal Form Validation States
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config">
                                            </a>
                                            <a href="" class="reload">
                                            </a>
                                            <a href="" class="remove">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form role="form" class="form-horizontal">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Default input</label>
                                                    <div class="col-md-8">
                                                        <div class="input-icon right">
                                                            <i class="fa fa-info-circle tooltips" data-original-title="Email address" data-container="body"></i>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-success">
                                                    <label class="col-md-4 control-label">Input with success</label>
                                                    <div class="col-md-8">
                                                        <div class="input-icon right">
                                                            <i class="fa fa-check tooltips" data-original-title="You look OK!" data-container="body"></i>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-warning">
                                                    <label class="col-md-4 control-label">Input with warning</label>
                                                    <div class="col-md-8">
                                                        <div class="input-icon right">
                                                            <i class="fa fa-warning tooltips" data-original-title="please provide an email" data-container="body"></i>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error">
                                                    <label class="col-md-4 control-label">Input with error</label>
                                                    <div class="col-md-8">
                                                        <div class="input-icon right">
                                                            <i class="fa fa-exclamation tooltips" data-original-title="please write a valid email" data-container="body"></i>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-4 col-md-8">
                                                        <button type="button" class="btn default">Cancel</button>
                                                        <button type="submit" class="btn blue">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet box yellow">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> More Form Samples
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config">
                                            </a>
                                            <a href="" class="reload">
                                            </a>
                                            <a href="" class="remove">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <h4>Inline Form</h4>
                                        <form class="form-inline" role="form">
                                            <div class="form-group">
                                                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                <input type="checkbox"> Remember me </label>
                                            </div>
                                            <button type="submit" class="btn btn-default">Sign in</button>
                                        </form>
                                        <hr>
                                        <h4>Inline Form With Icons</h4>
                                        <form class="form-inline" role="form">
                                            <div class="form-group">
                                                <label class="sr-only" for="exampleInputEmail22">Email address</label>
                                                <div class="input-icon">
                                                    <i class="fa fa-envelope"></i>
                                                    <input type="email" class="form-control" id="exampleInputEmail22" placeholder="Enter email">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="exampleInputPassword42">Password</label>
                                                <div class="input-icon">
                                                    <i class="fa fa-user"></i>
                                                    <input type="password" class="form-control" id="exampleInputPassword42" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                <input type="checkbox"> Remember me </label>
                                            </div>
                                            <button type="submit" class="btn btn-default">Sign in</button>
                                        </form>
                                        <hr>
                                        <h4>Horizontal Form</h4>
                                        <form class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-md-2 control-label">Email</label>
                                                <div class="col-md-4">
                                                    <input type="email" class="form-control" id="inputEmail1" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword12" class="col-md-2 control-label">Password</label>
                                                <div class="col-md-4">
                                                    <input type="password" class="form-control" id="inputPassword12" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-offset-2 col-md-4">
                                                    <div class="checkbox">
                                                        <label>
                                                        <input type="checkbox"> Remember me </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-offset-2 col-md-10">
                                                    <button type="submit" class="btn blue">Sign in</button>
                                                </div>
                                            </div>
                                        </form>
                                        <hr>
                                        <h4>Horizontal Form With Icons</h4>
                                        <form class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <label for="inputEmail12" class="col-md-2 control-label">Email</label>
                                                <div class="col-md-4">
                                                    <div class="input-icon">
                                                        <i class="fa fa-envelope"></i>
                                                        <input type="email" class="form-control" id="inputEmail12" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-md-2 control-label">Password</label>
                                                <div class="col-md-4">
                                                    <div class="input-icon right">
                                                        <i class="fa fa-user"></i>
                                                        <input type="password" class="form-control" id="inputPassword1" placeholder="Password">
                                                    </div>
                                                    <div class="help-block">
                                                        with right aligned icon
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-offset-2 col-md-4">
                                                    <div class="checkbox">
                                                        <label>
                                                        <input type="checkbox"> Remember me </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-offset-2 col-md-10">
                                                    <button type="submit" class="btn green">Sign in</button>
                                                </div>
                                            </div>
                                        </form>
                                        <hr>
                                        <h4>Column Sizing</h4>
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" placeholder=".col-md-2">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" placeholder=".col-md-3">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" placeholder=".col-md-4">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" placeholder=".col-md-2">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
                            </div>
                        </div>
                        <!-- END PAGE CONTENT-->
                    </div>
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN QUICK SIDEBAR -->
                <a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
                <div class="page-quick-sidebar-wrapper">
                    <div class="page-quick-sidebar">
                        <div class="nav-justified">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#quick_sidebar_tab_1" data-toggle="tab">
                                    Users <span class="badge badge-danger">2</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#quick_sidebar_tab_2" data-toggle="tab">
                                    Alerts <span class="badge badge-success">7</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                    More<i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#quick_sidebar_tab_3" data-toggle="tab">
                                            <i class="icon-bell"></i> Alerts </a>
                                        </li>
                                        <li>
                                            <a href="#quick_sidebar_tab_3" data-toggle="tab">
                                            <i class="icon-info"></i> Notifications </a>
                                        </li>
                                        <li>
                                            <a href="#quick_sidebar_tab_3" data-toggle="tab">
                                            <i class="icon-speech"></i> Activities </a>
                                        </li>
                                        <li class="divider">
                                        </li>
                                        <li>
                                            <a href="#quick_sidebar_tab_3" data-toggle="tab">
                                            <i class="icon-settings"></i> Settings </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
                                    <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
                                        <h3 class="list-heading">Staff</h3>
                                        <ul class="media-list list-items">
                                            <li class="media">
                                                <div class="media-status">
                                                    <span class="badge badge-success">8</span>
                                                </div>
                                                <img class="media-object" src="../../assets/admin/layout/img/avatar3.jpg" alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Bob Nilson</h4>
                                                    <div class="media-heading-sub">
                                                        Project Manager
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <img class="media-object" src="../../assets/admin/layout/img/avatar1.jpg" alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Nick Larson</h4>
                                                    <div class="media-heading-sub">
                                                        Art Director
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-status">
                                                    <span class="badge badge-danger">3</span>
                                                </div>
                                                <img class="media-object" src="../../assets/admin/layout/img/avatar4.jpg" alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Deon Hubert</h4>
                                                    <div class="media-heading-sub">
                                                        CTO
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <img class="media-object" src="../../assets/admin/layout/img/avatar2.jpg" alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Ella Wong</h4>
                                                    <div class="media-heading-sub">
                                                        CEO
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <h3 class="list-heading">Customers</h3>
                                        <ul class="media-list list-items">
                                            <li class="media">
                                                <div class="media-status">
                                                    <span class="badge badge-warning">2</span>
                                                </div>
                                                <img class="media-object" src="../../assets/admin/layout/img/avatar6.jpg" alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Lara Kunis</h4>
                                                    <div class="media-heading-sub">
                                                        CEO, Loop Inc
                                                    </div>
                                                    <div class="media-heading-small">
                                                        Last seen 03:10 AM
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-status">
                                                    <span class="label label-sm label-success">new</span>
                                                </div>
                                                <img class="media-object" src="../../assets/admin/layout/img/avatar7.jpg" alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Ernie Kyllonen</h4>
                                                    <div class="media-heading-sub">
                                                        Project Manager,<br>
                                                        SmartBizz PTL
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <img class="media-object" src="../../assets/admin/layout/img/avatar8.jpg" alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Lisa Stone</h4>
                                                    <div class="media-heading-sub">
                                                        CTO, Keort Inc
                                                    </div>
                                                    <div class="media-heading-small">
                                                        Last seen 13:10 PM
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-status">
                                                    <span class="badge badge-success">7</span>
                                                </div>
                                                <img class="media-object" src="../../assets/admin/layout/img/avatar9.jpg" alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Deon Portalatin</h4>
                                                    <div class="media-heading-sub">
                                                        CFO, H&D LTD
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <img class="media-object" src="../../assets/admin/layout/img/avatar10.jpg" alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Irina Savikova</h4>
                                                    <div class="media-heading-sub">
                                                        CEO, Tizda Motors Inc
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-status">
                                                    <span class="badge badge-danger">4</span>
                                                </div>
                                                <img class="media-object" src="../../assets/admin/layout/img/avatar11.jpg" alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Maria Gomez</h4>
                                                    <div class="media-heading-sub">
                                                        Manager, Infomatic Inc
                                                    </div>
                                                    <div class="media-heading-small">
                                                        Last seen 03:10 AM
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="page-quick-sidebar-item">
                                        <div class="page-quick-sidebar-chat-user">
                                            <div class="page-quick-sidebar-nav">
                                                <a href="javascript:;" class="page-quick-sidebar-back-to-list"><i class="icon-arrow-left"></i>Back</a>
                                            </div>
                                            <div class="page-quick-sidebar-chat-user-messages">
                                                <div class="post out">
                                                    <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar3.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Bob Nilson</a>
                                                        <span class="datetime">20:15</span>
                                                        <span class="body">
                                                        When could you send me the report ? </span>
                                                    </div>
                                                </div>
                                                <div class="post in">
                                                    <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar2.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Ella Wong</a>
                                                        <span class="datetime">20:15</span>
                                                        <span class="body">
                                                        Its almost done. I will be sending it shortly </span>
                                                    </div>
                                                </div>
                                                <div class="post out">
                                                    <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar3.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Bob Nilson</a>
                                                        <span class="datetime">20:15</span>
                                                        <span class="body">
                                                        Alright. Thanks! :) </span>
                                                    </div>
                                                </div>
                                                <div class="post in">
                                                    <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar2.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Ella Wong</a>
                                                        <span class="datetime">20:16</span>
                                                        <span class="body">
                                                        You are most welcome. Sorry for the delay. </span>
                                                    </div>
                                                </div>
                                                <div class="post out">
                                                    <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar3.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Bob Nilson</a>
                                                        <span class="datetime">20:17</span>
                                                        <span class="body">
                                                        No probs. Just take your time :) </span>
                                                    </div>
                                                </div>
                                                <div class="post in">
                                                    <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar2.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Ella Wong</a>
                                                        <span class="datetime">20:40</span>
                                                        <span class="body">
                                                        Alright. I just emailed it to you. </span>
                                                    </div>
                                                </div>
                                                <div class="post out">
                                                    <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar3.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Bob Nilson</a>
                                                        <span class="datetime">20:17</span>
                                                        <span class="body">
                                                        Great! Thanks. Will check it right away. </span>
                                                    </div>
                                                </div>
                                                <div class="post in">
                                                    <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar2.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Ella Wong</a>
                                                        <span class="datetime">20:40</span>
                                                        <span class="body">
                                                        Please let me know if you have any comment. </span>
                                                    </div>
                                                </div>
                                                <div class="post out">
                                                    <img class="avatar" alt="" src="../../assets/admin/layout/img/avatar3.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Bob Nilson</a>
                                                        <span class="datetime">20:17</span>
                                                        <span class="body">
                                                        Sure. I will check and buzz you if anything needs to be corrected. </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="page-quick-sidebar-chat-user-form">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Type a message here...">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn blue"><i class="icon-paper-clip"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane page-quick-sidebar-alerts" id="quick_sidebar_tab_2">
                                    <div class="page-quick-sidebar-alerts-list">
                                        <h3 class="list-heading">General</h3>
                                        <ul class="feeds list-items">
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-check"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                You have 4 pending tasks. <span class="label label-sm label-warning ">
                                                                Take action <i class="fa fa-share"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        Just now
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bar-chart-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                Finance Report for year 2013 has been released.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        20 mins
                                                    </div>
                                                </div>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-danger">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                You have 5 pending membership that requires a quick review.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        24 mins
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received with <span class="label label-sm label-success">
                                                                Reference Number: DR23923 </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        30 mins
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                You have 5 pending membership that requires a quick review.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        24 mins
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                Web server hardware needs to be upgraded. <span class="label label-sm label-warning">
                                                                Overdue </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        2 hours
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-default">
                                                                <i class="fa fa-briefcase"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                IPO Report for year 2013 has been released.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        20 mins
                                                    </div>
                                                </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <h3 class="list-heading">System</h3>
                                        <ul class="feeds list-items">
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-check"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                You have 4 pending tasks. <span class="label label-sm label-warning ">
                                                                Take action <i class="fa fa-share"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        Just now
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-danger">
                                                                <i class="fa fa-bar-chart-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                Finance Report for year 2013 has been released.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        20 mins
                                                    </div>
                                                </div>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-default">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                You have 5 pending membership that requires a quick review.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        24 mins
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received with <span class="label label-sm label-success">
                                                                Reference Number: DR23923 </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        30 mins
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                You have 5 pending membership that requires a quick review.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        24 mins
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-warning">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                Web server hardware needs to be upgraded. <span class="label label-sm label-default ">
                                                                Overdue </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        2 hours
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-briefcase"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                IPO Report for year 2013 has been released.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        20 mins
                                                    </div>
                                                </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane page-quick-sidebar-settings" id="quick_sidebar_tab_3">
                                    <div class="page-quick-sidebar-settings-list">
                                        <h3 class="list-heading">General Settings</h3>
                                        <ul class="list-items borderless">
                                            <li>
                                                Enable Notifications <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                            </li>
                                            <li>
                                                Allow Tracking <input type="checkbox" class="make-switch" data-size="small" data-on-color="info" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                            </li>
                                            <li>
                                                Log Errors <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                            </li>
                                            <li>
                                                Auto Sumbit Issues <input type="checkbox" class="make-switch" data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                            </li>
                                            <li>
                                                Enable SMS Alerts <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                            </li>
                                        </ul>
                                        <h3 class="list-heading">System Settings</h3>
                                        <ul class="list-items borderless">
                                            <li>
                                                Security Level
                                                <select class="form-control input-inline input-sm input-small">
                                                    <option value="1">Normal</option>
                                                    <option value="2" selected>Medium</option>
                                                    <option value="e">High</option>
                                                </select>
                                            </li>
                                            <li>
                                                Failed Email Attempts <input class="form-control input-inline input-sm input-small" value="5"/>
                                            </li>
                                            <li>
                                                Secondary SMTP Port <input class="form-control input-inline input-sm input-small" value="3560"/>
                                            </li>
                                            <li>
                                                Notify On System Error <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                            </li>
                                            <li>
                                                Notify On SMTP Error <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF">
                                            </li>
                                        </ul>
                                        <div class="inner-content">
                                            <button class="btn btn-success"><i class="icon-settings"></i> Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END QUICK SIDEBAR -->
            </div>
            </div>
        </div>

        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner">
                2014 &copy; Metronic by keenthemes.
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>

        <script src="./assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="./assets/js/jquery-migrate.min.js" type="text/javascript"></script>
        <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
        <script src="./assets/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="./assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="./assets/js/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="./assets/js/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="./assets/js/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="./assets/js/jquery.cokie.min.js" type="text/javascript"></script>
        <script src="./assets/js/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="./assets/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <script src="./assets/js/metronic.js" type="text/javascript"></script>
        <script src="./assets/js/layout.js" type="text/javascript"></script>
        <script src="./assets/js/quick-sidebar.js" type="text/javascript"></script>
        <script src="./assets/js/demo.js" type="text/javascript"></script>
        <script>
        jQuery(document).ready(function() {   
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
            Layout.init(); // init current layout
            QuickSidebar.init(); // init quick sidebar
            Demo.init(); // init demo features
        });
        </script>
    </body>
</html>