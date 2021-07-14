
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
    $i = 0;

    foreach ($xlsx->rows() as $elt) {   

        if($i != 0)
        {
            $sql = "INSERT INTO tb_data (state, market, floor_level, studio_#, news_onair_booth_p1a, main_studio_use_comments, tech, mics, virtual_diector, zetta, phone_box, webcam, recorder) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // $stmt = sqlsrv_query( $conn, $sql, $elt);
            // if( $stmt === false ) {
            //     die( print_r( sqlsrv_errors(), true));
            // }
        }
        $i++;
    }

} else {
    echo SimpleXLSX::parseError();
}



if(isset($_REQUEST["send_name"]))
{
    $send_name = $_REQUEST["send_name"];
    $send_contact = $_REQUEST["send_contact"];
    $send_start = $_REQUEST["start_dt"];
    $send_end = $_REQUEST["end_dt"];
    $send_comment = $_REQUEST["send_comment"];

    //Host data
    $send_market_host = $_REQUEST["send_host_market"];
    $send_service_host = $_REQUEST["send_service_host"];
    $send_show_host = $_REQUEST["send_show_host"];
    $send_produce_host = $_REQUEST["send_produce_host"];
    $send_studio_host = $_REQUEST["send_studio_host"];

    $send_num_mics_host = $_REQUEST["num_mics_host"];
    $send_phone_host = $_REQUEST["phone_host"];
    $send_v_dir_host = $_REQUEST["v_dir_host"];
    $send_zetta_host = $_REQUEST["zetta_host"];
    $send_recorder_host = $_REQUEST["recorder_host"];
    $send_webcam_host = $_REQUEST["webcam_host"];
    
    //Remote data
    $send_market_remote = $_REQUEST["send_remote_market"];
    $send_contact_remote = $_REQUEST["send_remote_contact"];
    $send_studio_remote = $_REQUEST["send_studio_remote"];

    $send_num_mics_remote = $_REQUEST["num_mics_remote"];
    $send_phone_remote = $_REQUEST["phone_remote"];
    $send_v_dir_remote = $_REQUEST["v_dir_remote"];
    $send_zetta_remote = $_REQUEST["zetta_remote"];
    $send_recorder_remote = $_REQUEST["recorder_remote"];
    $send_webcam_remote = $_REQUEST["webcam_remote"];

    $date=date( "Y-m-d", strtotime( $send_start ) );
    $f_date = strtotime($send_start);
    $s_date = strtotime($send_end);

    $diff = abs($s_date - $f_date);
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60)); 
    $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
    $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60)); 
    
    $between = $hours."hr ".$minutes."min";

    // Get studio host type and tech with temp id.
    $tmp_studio_host_id = $send_studio_host;
    $pieces = explode("_", $tmp_studio_host_id);
    
    $send_studio_host_type = $pieces[1];
    $tmp_id = $pieces[0];
    $send_studio_host = $send_studio_host_type."_".$pieces[2];

    $sql = "SELECT tech FROM [noc_db].[dbo].[tb_data] WHERE id=".$tmp_id;               
    $result = sqlsrv_query($conn, $sql);
    if($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    $send_studio_host_tech = $row['tech'];
    // End getting host studio type and tech

    // Get studio remote type and tech with temp id.
    $tmp_studio_remote_id = $send_studio_remote;
    // var_dump( $send_studio_remote);
    // exit;
    $pieces = explode("_", $tmp_studio_remote_id);
    
    $send_studio_remote_type = $pieces[1];
    $tmp_id = $pieces[0];

    $send_studio_remote = $send_studio_remote_type."_".$pieces[2];

    $sql = "SELECT tech FROM [noc_db].[dbo].[tb_data] WHERE id=".$tmp_id;               
    $result = sqlsrv_query($conn, $sql);
    if($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    $send_studio_remote_tech = $row['tech'];
    // End getting host studio type and tech

    $show_temp_data =   "Name : ". $send_name . "\n"."</br>".
                        "Contact : ". $send_contact . "\n"."</br>".
                        "Comment : ". $send_comment . "\n"."</br>".
                        "Date : ". $date . "\n"."</br>".
                        "Between : ". $between . "\n\n"."</br>"."</br>".
                        "<h4>Host Market</h4> ". "\n"."</br>".
                        "Market : ". $send_market_host . "\n"."</br>".
                        "Studio : ". $send_studio_host . "\n"."</br>".
                        "Service : ". $send_service_host . "\n"."</br>".
                        "Show : ". $send_show_host . "\n"."</br>".
                        "Producer : ". $send_produce_host . "\n\n"."</br>".
                        "Type : ". $send_studio_host_type . "\n"."</br>".
                        "Tech : ". $send_studio_host_tech . "\n"."</br>".
                        "VD : ". $send_v_dir_host . "\n"."</br>".
                        "Phone Box : ". $send_phone_host . "\n"."</br>".
                        "Webcam : ". $send_webcam_host . "\n"."</br>".
                        "Zetta : ". $send_zetta_host . "\n"."</br>".
                        "Recorder : ". $send_recorder_host . "\n\n"."</br>"."</br>".
                        "<h4>Remote Market </h4>". "\n"."</br>".
                        "Market : ". $send_market_remote . "\n"."</br>".
                        "Studio : ". $send_studio_remote . "\n"."</br>".
                        "Contact : ". $send_contact_remote . "\n"."</br>".
                        "Type : ". $send_studio_remote_type . "\n"."</br>".
                        "Tech : ". $send_studio_remote_tech . "\n"."</br>".
                        "VD : ". $send_v_dir_remote . "\n"."</br>".
                        "Phonebox : ". $send_phone_remote . "\n"."</br>".
                        "Webcam : ". $send_webcam_remote . "\n"."</br>".
                        "Zetta : ". $send_zetta_remote . "\n"."</br>".
                        "Recorder : ". $send_recorder_remote;



    //This is mailer function and maybe you should to change this directly.

    $send_to = "receiver@domain.com";
    $send_from = "your@domain.com";
    $send_subject = "Data Model";


    $headers = "From: " . $send_from . "\r\n" .
    "Reply-To: " . $send_from . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

    if (!$send_from) {
        echo "no email";
        exit;
    }else if (!$f_name){
        echo "no name";
        exit;
    }else{
        if (filter_var($f_email, FILTER_VALIDATE_EMAIL)) {
            mail($send_to, $send_subject, $show_temp_data, $headers);
            echo "true";
        }else{
            echo "invalid email";
            exit;
        }
    }

    
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8"/>
        <title>Data processing</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <!-- jQuery library -->
        <script src="./assets/js/jquery.min.js"></script>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="./assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="./assets/css/style.css" rel="stylesheet" type="text/css"/>


        <script src="./assets/js/bootstrap.min.js"></script>.

        <link href="./assets/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <script src="./assets/js/bootstrap-datetimepicker.min.js"></script>
        <!-- END THEME STYLES -->
        <!-- <link rel="shortcut icon" href="favicon.ico"/> -->
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="contact-container">
                    <form name="email_form" method="POST" action="">
                        <div class="form-group">
                            <h4 style="font-weight:bold;"> Data processing with MsSQL & Excel </h4>
                        </div>
                        <div class="contact-main">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="usr">Name:</label>
                                            <input type="text" class="form-control" id="send_name" name="send_name">
                                        </div>
                                    </div>  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="usr">Contact:</label>
                                            <input type="text" class="form-control" id="send_contact" name="send_contact">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="usr">Start:</label>
                                            <input type="text" class="form-control" id="start_dt" name="start_dt">
                                        </div>
                                        <script>
                                            $("#start_dt").datetimepicker({
                                                format: 'yyyy-mm-dd hh:ii'
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="usr">End:</label>
                                            <input type="text" class="form-control" id="end_dt" name="end_dt">
                                        </div>
                                        <script>
                                            $("#end_dt").datetimepicker({
                                                format: 'yyyy-mm-dd hh:ii'
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="comment">Comment:</label>
                                            <textarea class="form-control" rows="5" style="height:50px;" id="send_comment" name="send_comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:20px;">
                            <div class="col-md-6">
                                <div class="host-main">
                                    <div class="col-md-12 host-title">
                                        <span>Host</span>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="usr">Market*:</label>
                                                    <?php
                                                        $sql = "SELECT market FROM tb_data GROUP BY market";
                                                        $result = sqlsrv_query($conn, $sql);
                                            
                                                        if($result === false) {
                                                            die(print_r(sqlsrv_errors(), true));
                                                        }
                                                        #Fetching Data by array
                                                        
                                                        echo "<select class='form-control' id='send_host_market' name='send_host_market'>";
                                                        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                            // print_r();
                                                            echo "<option>".$row['market']."</option>";
                                                        }
                                                        echo "</select>";
                                                    ?>
                                                </div>
                                            </div>  
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="usr">Service*:</label>
                                                    <select class='form-control' id='send_service_host' name='send_service_host'>
                                                        <option> Triple M </option>
                                                        <option> Postcad One </option>
                                                        <option> Hit </option>
                                                        <option> Other </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="usr">Show:</label>
                                                    <input type="text" class="form-control" id="send_show_host" name="send_show_host">
                                                </div>
                                            </div>  
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="usr">Produce:</label>
                                                    <input type="text" class="form-control" id="send_produce_host" name="send_produce_host">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="submain">
                                                    <div class="col-md-12 subtitle">
                                                        <span>Choose studio...</span>
                                                    </div>
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="usr">Studio:</label>
                                                                    <?php
                                                                        $sql = "SELECT studio_# FROM tb_data GROUP BY studio_# ORDER BY studio_#";
                                                                        $result = sqlsrv_query($conn, $sql);
                                                            
                                                                        if($result === false) {
                                                                            die(print_r(sqlsrv_errors(), true));
                                                                        }
                                                                        #Fetching Data by array
                                                                        
                                                                        echo "<select class='form-control' id='send_studio_host' name='send_studio_host'>";
                                                                        echo "<option>No selected..</option>";
                                                                        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                                            // print_r();
                                                                            echo "<option>".$row['studio_#']."</option>";
                                                                        }
                                                                        echo "</select>";
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="submain" id="host_other">
                                                    
                                                    <div class="col-md-12 subtitle">
                                                        <span>...or choose requirements</span>
                                                    </div>
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="usr">Number of mics:</label>
                                                                    <input type="text" class="form-control" id="num_mics_host" name="num_mics_host">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="checkbox">
                                                                        <label style="font-weight:bold;"><input type="checkbox" value="" id="phone_host" name="phone_host">Phonebox</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="checkbox">
                                                                        <label style="font-weight:bold;"><input type="checkbox" value="" id="v_dir_host" name="v_dir_host">Virtual Director</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="checkbox">
                                                                        <label style="font-weight:bold;"><input type="checkbox" value="" id="zetta_host" name="zetta_host">Zetta</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="checkbox">
                                                                        <label style="font-weight:bold;"><input type="checkbox" value="" id="recorder_host" name="recorder_host">Recoder</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="checkbox">
                                                                        <label style="font-weight:bold;"><input type="checkbox" value="" id="webcam_host" name="webcam_host">Webcam</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="set_bool_host">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="remote-main">
                                    <div class="col-md-12 remote-title">
                                        <span>Remote</span>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="usr">Market*:</label>
                                                    <?php
                                                        $sql = "SELECT market FROM tb_data GROUP BY market";
                                                        $result = sqlsrv_query($conn, $sql);
                                            
                                                        if($result === false) {
                                                            die(print_r(sqlsrv_errors(), true));
                                                        }
                                                        #Fetching Data by array
                                                        
                                                        echo "<select class='form-control' id='send_remote_market' name='send_remote_market'>";
                                                        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                            // print_r();
                                                            echo "<option>".$row['market']."</option>";
                                                        }
                                                        echo "</select>";
                                                    ?>
                                                </div>
                                            </div>  
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="usr">Contact*:</label>
                                                    <input type="text" class="form-control" id="send_remote_contact" name="send_remote_contact">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="submain"  id="remote_other">
                                                    <div class="col-md-12 subtitle">
                                                        <span>Choose studio...</span>
                                                    </div>
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="usr">Studio:</label>
                                                                    <?php
                                                                        $sql = "SELECT studio_# FROM tb_data GROUP BY studio_# ORDER BY studio_#";
                                                                        $result = sqlsrv_query($conn, $sql);
                                                            
                                                                        if($result === false) {
                                                                            die(print_r(sqlsrv_errors(), true));
                                                                        }
                                                                        #Fetching Data by array
                                                                        
                                                                        echo "<select class='form-control' id='send_studio_remote' name='send_studio_remote'>";
                                                                        echo "<option>No selected..</option>";
                                                                        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                                            // print_r();
                                                                            echo "<option>".$row['studio_#']."</option>";
                                                                        }
                                                                        echo "</select>";
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="set_bool_remote">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="submain">
                                                    <div class="col-md-12 subtitle">
                                                        <span>...or choose requirements</span>
                                                    </div>
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="usr">Number of mics:</label>
                                                                    <input type="text" class="form-control" id="num_mics_remote" name="num_mics_remote">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="checkbox">
                                                                        <label style="font-weight:bold;"><input type="checkbox" value="" id="phone_remote" name="phone_remote">Phonebox</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="checkbox">
                                                                        <label style="font-weight:bold;"><input type="checkbox" value="" id="v_dir_remote" name="v_dir_remote" >Virtual Director</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="checkbox">
                                                                        <label style="font-weight:bold;"><input type="checkbox" value="" id="zetta_remote" name="zetta_remote">Zetta</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="checkbox">
                                                                        <label style="font-weight:bold;"><input type="checkbox" value="" id="recorder_remote" name="recorder_remote">Recorder</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="checkbox">
                                                                        <label style="font-weight:bold;"><input type="checkbox" value="" id="webcam_remote" name="webcam_remote">Webcam</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" style="border:noe;" id="send_btn">Submit</button>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                initialState();

                var host_fields = [];
                var remote_fields = [];
                function check_state(range, state)
                {
                    
                    $("#num_mics_" + range).val('');
                    $("#phone_" + range).prop('checked', state);
                    $("#v_dir_" + range).prop('checked', state);
                    $("#zetta_" + range).prop('checked', state);
                    $("#recorder_" + range).prop('checked', state);
                    $("#webcam_" + range).prop('checked', state);

                    $("#num_mics_" + range).prop('disabled', state);
                    $("#phone_" + range).prop('disabled', state);
                    $("#v_dir_" + range).prop('disabled', state);
                    $("#zetta_" + range).prop('disabled', state);
                    $("#recorder_" + range).prop('disabled', state);
                    $("#webcam_" + range).prop ('disabled', state);
                }

                function tidyDom()
                {
                    var tmpDoms = "";
                    if($("#send_studio_host").val() != "No selected..")
                    {
                        tmpDoms  =  "<input name='num_mics_host' value= 0 hidden />"+
                                    "<input name='phone_host' value= 'No' hidden />"+
                                    "<input name='v_dir_host' value= 'No' hidden />"+
                                    "<input name='zetta_host' value= 'No' hidden />"+
                                    "<input name='recorder_host' value= 'No' hidden />"+
                                    "<input name='webcam_host' value= 'No' hidden />";
                        $("#host_other").append(tmpDoms);
                    }
                    else{
                        if($("#phone_host").prop("checked") == true){
                            $("#phone_host").val('Yes');
                        }
                        else{
                            tmpDoms  +=  "<input name='phone_host' value= 'No' hidden />";
                        }
                        if($("#v_dir_host").prop("checked") == true){
                            $("#v_dir_host").val('Yes');
                        }
                        else{
                            tmpDoms  +=  "<input name='v_dir_host' value= 'No' hidden />";
                        }
                        if($("#zetta_host").prop("checked") == true){
                            $("#zetta_host").val('Yes');
                        }
                        else{
                            tmpDoms  +=  "<input name='zetta_host' value= 'No' hidden />";
                        }
                        if($("#recorder_host").prop("checked") == true){
                            $("#recorder_host").val('Yes');
                        }
                        else{
                            tmpDoms  +=  "<input name='recorder_host' value= 'No' hidden />";
                        }
                        if($("#webcam_host").prop("checked") == true){
                            $("#webcam_host").val('Yes');
                        }
                        else{
                            tmpDoms  +=  "<input name='webcam_host' value= 'No' hidden />";
                        }
                        $("#host_other").append(tmpDoms);
                    }
                    if($("#send_studio_remote").val() != "No selected..")
                    {
                        tmpDoms  =  "<input name='num_mics_remote' value= 0 hidden />"+
                                    "<input name='phone_remote' value= 'No' hidden />"+
                                    "<input name='v_dir_remote' value= 'No' hidden />"+
                                    "<input name='zetta_remote' value= 'No' hidden />"+
                                    "<input name='recorder_remote' value= 'No' hidden />"+
                                    "<input name='webcam_remote' value= 'No' hidden />";
                        $("#remote_other").append(tmpDoms);
                    }
                    else{
                        if($("#phone_remote").prop("checked") == true){
                            $("#phone_remote").val('Yes');
                        }
                        else{
                            tmpDoms  +=  "<input name='phone_remote' value= 'No' hidden />";
                        }
                        if($("#v_dir_remote").prop("checked") == true){
                            $("#v_dir_remote").val('Yes');
                        }
                        else{
                            tmpDoms  +=  "<input name='v_dir_remote' value= 'No' hidden />";
                        }
                        if($("#zetta_remote").prop("checked") == true){
                            $("#zetta_remote").val('Yes');
                        }
                        else{
                            tmpDoms  +=  "<input name='zetta_remote' value= 'No' hidden />";
                        }
                        if($("#recorder_remote").prop("checked") == true){
                            $("#recorder_remote").val('Yes');
                        }
                        else{
                            tmpDoms  +=  "<input name='recorder_remote' value= 'No' hidden />";
                        }
                        if($("#webcam_remote").prop("checked") == true){
                            $("#webcam_remote").val('Yes');
                        }
                        else{
                            tmpDoms  +=  "<input name='webcam_remote' value= 'No' hidden />";
                        }
                        $("#remote_other").append(tmpDoms);
                    }
                }

                $("#send_btn").click(function(){
                    var send_name = $("#send_name").val();
                    var send_contact = $("#send_contact").val();
                    var send_start = $("#start_dt").val();
                    var send_end = $("#end_dt").val();
                    var send_comment = $("#send_comment").val();

                    // tidyDom();
                    email_form.submit();
                    if(send_name == "" || send_contact == "" || send_start == "" || send_end == "" || send_comment == "")
                    {
                        // alert("Please input correct data!");
                        console.log("Please input correct data!");
                        // return;
                    }
                    else{
                        // tidyDom();
                        email_form.submit();
                    }

                });

                function initialState()
                {
                    var host_market = $("#send_host_market").val();
                    var remote_market = $("#send_remote_market").val();
                    
                    getStudioState("host", host_market);
                    getStudioState("remote", remote_market);
                }

                function getStudioState(state, market_name)
                {
                    $.post("./model/GetData.php",
                    {
                        host_market_name: market_name
                    },
                    function(data, status){
                        data = JSON.parse(data);
                        var arrayCount = data.length;
                        var optionText = "";
                        for(var i = 0; i < arrayCount + 1; i++)
                        {
                            if(i == 0)
                            {
                                optionText += "<option value='0'>No selected..</option>";
                            }
                            else
                            {
                                var data_temp = data[i - 1]['studio_num'] + "_" + data[i - 1]['studio_type'];
                                optionText += "<option value='"+data[i - 1]['pro_id']+ "_" + data_temp + "'>"+ data_temp +"</option>";
                            }
                            // console.log(data[i]["pro_id"]);
                        }
                        $('#send_studio_' + state)
                            .find('option')
                            .remove()
                            .end()
                            .append(optionText)
                            .val(data[0]['pro_id'] + "_" + data[0]['studio_num'] + "_" + data[0]['studio_type']);
                        getSubState(state, data[0]['pro_id']);
                    });
                }

                function getSubState(state, productId)
                {
                    $("#phone_" + state).prop('checked', false);
                    $("#v_dir_" + state).prop('checked', false);
                    $("#zetta_" + state).prop('checked', false);
                    $("#recorder_" + state).prop('checked', false);
                    $("#webcam_" + state).prop('checked', false);
                    $.post("./model/GetData.php",
                    {
                        product_id: productId
                    },
                    function(data, status){
                        data = JSON.parse(data);
                        console.log(data[0])
                        $("#num_mics_" + state).val(data[0]["mic"]);
                        (data[0]["pb"] == "Yes") ? ($("#phone_" + state).prop('checked', true)) : ($("#phone_" + state).prop('checked', false));
                        (data[0]["vd"] == "Yes") ? ($("#v_dir_" + state).prop('checked', true)) : ($("#v_dir_" + state).prop('checked', false));
                        (data[0]["zetta"] == "Yes") ? ($("#zetta_" + state).prop('checked', true)) : ($("#zetta_" + state).prop('checked', false));
                        (data[0]["rcrd"] == "Yes") ? ($("#recorder_" + state).prop('checked', true)) : ($("#recorder_" + state).prop('checked', false));
                        (data[0]["wc"] == "Yes") ? ($("#webcam_" + state).prop('checked', true)) : ($("#webcam_" + state).prop('checked', false));
                        
                        var tmpDoms  =  "<input name='num_mics_"+state+"' value= "+data[0]["mic"]+" hidden />"+
                                    "<input name='phone_"+state+"' value= '"+data[0]["pb"]+"' hidden />"+
                                    "<input name='v_dir_"+state+"' value= '"+data[0]["vd"]+"' hidden />"+
                                    "<input name='zetta_"+state+"' value= '"+data[0]["zetta"]+"' hidden />"+
                                    "<input name='recorder_"+state+"' value= '"+data[0]["rcrd"]+"' hidden />"+
                                    "<input name='webcam_"+state+"' value= '"+data[0]["wc"]+"' hidden />";
                    
                        $("#set_bool_" + state).empty();
                        $("#set_bool_" + state).append(tmpDoms);
                    });
                    
                    $("#num_mics_" + state).prop('disabled', true);
                    $("#phone_" + state).prop('disabled', true);
                    $("#v_dir_" + state).prop('disabled', true);
                    $("#zetta_" + state).prop('disabled', true);
                    $("#recorder_" + state).prop('disabled', true);
                    $("#webcam_" + state).prop('disabled', true);

                    
                }

                $("#send_host_market").change(function(){
                    var market_name = $(this).val();
                    getStudioState("host", market_name);
                });

                $("#send_remote_market").change(function(){
                    var market_name = $(this).val();
                    getStudioState("remote", market_name);
                });

                $("#send_studio_host").change(function(){
                    var prod_id = $(this).val();
                    if(prod_id != "0")
                    {
                        getSubState("host", prod_id);
                    }
                    else{
                        host_fields = [];
                        $("#set_bool_host").empty();
                        check_state("host", false);

                    }
                });

                $("#send_studio_remote").change(function(){
                    var prod_id = $(this).val();
                    if(prod_id != "0")
                    {
                        getSubState("remote", prod_id);
                    }
                    else{
                        remote_fields = [];
                        $("#set_bool_remote").empty();
                        check_state("remote", false)
                    }
                    
                });

                $("#phone_host").click(function(){
                    var status;
                    ($(this).is(":checked"))?(status = "Yes"):(status="No");
                    changeHostSubState("phone_box", status);
                    
                });
                $("#v_dir_host").click(function(){
                    var status;
                    ($(this).is(":checked"))?(status = "Yes"):(status="No");
                    changeHostSubState("virtual_diector", status);
                    
                });
                $("#zetta_host").click(function(){
                    var status;
                    ($(this).is(":checked"))?(status = "Yes"):(status="No");
                    changeHostSubState("zetta", status);
                    
                });
                $("#recorder_host").click(function(){
                    var status;
                    ($(this).is(":checked"))?(status = "Yes"):(status="No");
                    changeHostSubState("recorder", status);
                    
                });
                $("#webcam_host").click(function(){
                    var status;
                    ($(this).is(":checked"))?(status = "Yes"):(status="No");
                    changeHostSubState("webcam", status);
                    
                });


                $("#phone_remote").click(function(){
                    var status;
                    ($(this).is(":checked"))?(status = "Yes"):(status="No");
                    changeRemoteSubState("phone_box", status);
                    
                });
                $("#v_dir_remote").click(function(){
                    var status;
                    ($(this).is(":checked"))?(status = "Yes"):(status="No");
                    changeRemoteSubState("virtual_diector", status);
                    
                });
                $("#zetta_remote").click(function(){
                    var status;
                    ($(this).is(":checked"))?(status = "Yes"):(status="No");
                    changeRemoteSubState("zetta", status);
                    
                });
                $("#recorder_remote").click(function(){
                    var status;
                    ($(this).is(":checked"))?(status = "Yes"):(status="No");
                    changeRemoteSubState("recorder", status);
                    
                });
                $("#webcam_remote").click(function(){
                    var status;
                    ($(this).is(":checked"))?(status = "Yes"):(status="No");
                    changeRemoteSubState("webcam", status);
                    
                });

                function changeHostSubState(subname, status)
                {

                    var market_name = $("#send_host_market").val();
                    if(status == "Yes")
                    {
                        host_fields.push(subname);
                    }
                    else{
                        const index = host_fields.indexOf(subname);
                        if (index > -1) {
                            host_fields.splice(index, 1);
                        }
                    }
                    var fields_string = "";
                    
                    if(host_fields.length > 0)
                    {

                        for(i = 0; i < host_fields.length; i++)
                        {
                            if(i == 0)
                            {
                                fields_string = host_fields[i];
                            }
                            else{
                                fields_string +=" " + host_fields[i];
                            }
                            
                        }
                        $.post("./model/GetData.php",
                        {
                            market_name:market_name,
                            fields: fields_string
                        },
                        function(data, status){
                            data = JSON.parse(data);
                            var arrayCount = data.length;
                            var optionText = "";
                            if(data.length == 0)
                            {
                                console.log("if" + data);
                                $('#send_studio_host')
                                .find('option')
                                .remove()
                                .end()
                                .append("<option value='0'>No selected..</option>")
                                .val('0');
                            }
                            else
                            {
                                console.log(data);
                                for(var i = 0; i < arrayCount + 1; i++)
                                {
                                    if(i == 0)
                                    {
                                        optionText += "<option value='0'>No selected..</option>";
                                    }
                                    else
                                    {
                                        optionText += "<option value='"+data[i - 1]['pro_id']+"'>"+data[i - 1]['studio_num'] + "_" + data[i - 1]['studio_type'] +"</option>"
                                    }
                                    // console.log(data[i]["pro_id"]);
                                }
                                $('#send_studio_host')
                                    .find('option')
                                    .remove()
                                    .end()
                                    .append(optionText)
                                    .val(data[0]['pro_id']);
                            }
                            
                        });
                    }
                    else{
                        $.post("./model/GetData.php",
                        {
                            only_market_name:market_name
                        },
                        function(data, status){
                            data = JSON.parse(data);
                            var arrayCount = data.length;
                            var optionText = "";
                            if(data.length == 0)
                            {
                                console.log("if" + data);
                                $('#send_studio_host')
                                .find('option')
                                .remove()
                                .end()
                                .append("<option value='0'>No selected..</option>")
                                .val('0');
                            }
                            else
                            {
                                console.log(data);
                                for(var i = 0; i < arrayCount + 1; i++)
                                {
                                    if(i == 0)
                                    {
                                        optionText += "<option value='0'>No selected..</option>";
                                    }
                                    else
                                    {
                                        optionText += "<option value='"+data[i - 1]['pro_id']+"'>"+data[i - 1]['studio_num'] + "_" + data[i - 1]['studio_type'] +"</option>"
                                    }
                                    // console.log(data[i]["pro_id"]);
                                }
                                $('#send_studio_host')
                                    .find('option')
                                    .remove()
                                    .end()
                                    .append(optionText)
                                    .val(data[0]['pro_id']);
                            }
                            
                        });
                    }

                }
                function changeRemoteSubState(subname, status)
                {

                    var market_name = $("#send_remote_market").val();
                    if(status == "Yes")
                    {
                        remote_fields.push(subname);
                    }
                    else{
                        const index = remote_fields.indexOf(subname);
                        if (index > -1) {
                            remote_fields.splice(index, 1);
                        }
                    }
                    var fields_string = "";
                    
                    if(remote_fields.length > 0)
                    {
                        for(i = 0; i < remote_fields.length; i++)
                        {
                            if(i == 0)
                            {
                                fields_string = remote_fields[i];
                            }
                            else{
                                fields_string +=" " + remote_fields[i];
                            }
                        }
                        $.post("./model/GetData.php",
                        {
                            market_name:market_name,
                            fields: fields_string
                        },
                        function(data, status){
                            data = JSON.parse(data);
                            console.log(data);
                            var arrayCount = data.length;
                            var optionText = "";
                            if(data.length == 0)
                            {
                                $('#send_studio_remote')
                                .find('option')
                                .remove()
                                .end()
                                .append("<option value='0'>No selected..</option>")
                                .val('0');
                            }
                            else
                            {
                                for(var i = 0; i < arrayCount + 1; i++)
                                {
                                    if(i == 0)
                                    {
                                        optionText += "<option value='0'>No selected..</option>";
                                    }
                                    else
                                    {
                                        optionText += "<option value='"+data[i - 1]['pro_id']+"'>"+data[i - 1]['studio_num'] + "_" + data[i - 1]['studio_type'] +"</option>"
                                    }
                                    // console.log(data[i]["pro_id"]);
                                }
                                $('#send_studio_remote')
                                    .find('option')
                                    .remove()
                                    .end()
                                    .append(optionText)
                                    .val(data[0]['pro_id']);
                            }
                        });
                    }
                    else{
                        $.post("./model/GetData.php",
                        {
                            only_market_name:market_name
                        },
                        function(data, status){
                            data = JSON.parse(data);
                            console.log(data);
                            var arrayCount = data.length;
                            var optionText = "";
                            if(data.length == 0)
                            {
                                $('#send_studio_remote')
                                .find('option')
                                .remove()
                                .end()
                                .append("<option value='0'>No selected..</option>")
                                .val('0');
                            }
                            else
                            {
                                for(var i = 0; i < arrayCount + 1; i++)
                                {
                                    if(i == 0)
                                    {
                                        optionText += "<option value='0'>No selected..</option>";
                                    }
                                    else
                                    {
                                        optionText += "<option value='"+data[i - 1]['pro_id']+"'>"+data[i - 1]['studio_num'] + "_" + data[i - 1]['studio_type'] +"</option>"
                                    }
                                    // console.log(data[i]["pro_id"]);
                                }
                                $('#send_studio_remote')
                                    .find('option')
                                    .remove()
                                    .end()
                                    .append(optionText)
                                    .val(data[0]['pro_id']);
                            }
                        });
                    }

                }
            })
        </script>
        

    </body>
</html>