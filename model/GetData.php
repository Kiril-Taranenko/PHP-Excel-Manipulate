<?php
    //connecting to MsSql server
    $serverName = "DESKTOP-2S9R2DQ\\sqlexpress"; //serverName\instanceName

    $connectionInfo = array( "Database"=>"noc_db");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    if( !$conn ) {
        echo "Connection could not be established.<br />";
        die( print_r( sqlsrv_errors(), true));
    }


    if( isset($_REQUEST['host_market_name']) ){

        $temp = "";
        $res_data= array();
        $sql = "SELECT id, studio_#, news_onair_booth_p1a FROM [noc_db].[dbo].[tb_data] WHERE market='".$_REQUEST['host_market_name']."'";               
        $result = sqlsrv_query($conn, $sql);
        if($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
        {
            $product_id = $row["id"];
            $studio_id = $row["studio_#"];
            $studio_news = $row["news_onair_booth_p1a"];
            $temp = ["pro_id" => $product_id, "studio_num" => $studio_id, "studio_type" => $studio_news];
            array_push($res_data, $temp);
        }
        echo json_encode($res_data);
    }
    if( isset($_REQUEST['fields']) ){

        $fiels = array();
        $host_market_name = $_REQUEST["market_name"];
        $fields = $_REQUEST["fields"];
        $temp = "";
        $res_data= array();

        $field_names = explode(" ",$fields);
        $field_count = count($field_names);

        $sql = "SELECT id, studio_#, news_onair_booth_p1a FROM [noc_db].[dbo].[tb_data] WHERE market='".$host_market_name."' AND (";
        $sub_sql = "";
        for($i = 0; $i < $field_count; $i++)
        {
            if($i == 0)
            {
                $sub_sql = $field_names[$i]."='Yes'";
            }
            else{
                $sub_sql .= " AND ". $field_names[$i]."='Yes'";
            }
        }

        $sql .= $sub_sql.")";

        // $sql = "SELECT id, studio_#, news_onair_booth_p1a FROM [noc_db].[dbo].[tb_data] WHERE market='".$_REQUEST['host_market_name']."'";               
        $result = sqlsrv_query($conn, $sql);
        if($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        

        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
        {
            if($row == null)
            {
                $temp = ["pro_id" => "null", "studio_num" => "null", "studio_type" => "null"];
                array_push($res_data, $temp);
                break;
            }
            else
            {
                $product_id = $row["id"];
                $studio_id = $row["studio_#"];
                $studio_news = $row["news_onair_booth_p1a"];
                $temp = ["pro_id" => $product_id, "studio_num" => $studio_id, "studio_type" => $studio_news];
                array_push($res_data, $temp);
            }
            
        }
        echo json_encode($res_data);
    }
    if( isset($_REQUEST['only_market_name']) ){

        $fiels = array();
        $host_market_name = $_REQUEST["only_market_name"];

        $res_data= array();



        $sql = "SELECT id, studio_#, news_onair_booth_p1a FROM [noc_db].[dbo].[tb_data] WHERE market='".$host_market_name."'";

        // $sql = "SELECT id, studio_#, news_onair_booth_p1a FROM [noc_db].[dbo].[tb_data] WHERE market='".$_REQUEST['host_market_name']."'";               
        $result = sqlsrv_query($conn, $sql);
        if($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
        {
           
                $product_id = $row["id"];
                $studio_id = $row["studio_#"];
                $studio_news = $row["news_onair_booth_p1a"];
                $temp = ["pro_id" => $product_id, "studio_num" => $studio_id, "studio_type" => $studio_news];
                array_push($res_data, $temp);
            
        }
        echo json_encode($res_data);
    }
    if( isset($_REQUEST['product_id']) ){

        $tmp_studio_prod_id = $_REQUEST['product_id'];
        $pieces = explode("_", $tmp_studio_prod_id);
        $prod_id = $pieces[0];
        $temp = "";
        $res_data= array();
        $sql = "SELECT mics, virtual_diector, zetta, phone_box, webcam, recorder FROM [noc_db].[dbo].[tb_data] WHERE id=".$prod_id;               
        // exit;
        $result = sqlsrv_query($conn, $sql);
        if($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
        {
            $mic = $row["mics"];
            $vd = $row["virtual_diector"];
            $zetta = $row["zetta"];
            $pb = $row["phone_box"];
            $wc = $row["webcam"];
            $rcrd = $row["recorder"];
            $temp = ["mic" => $mic, "vd" => $vd, "zetta" => $zetta, "pb" => $pb, "wc" => $wc, "rcrd" => $rcrd];
            array_push($res_data, $temp);
        }
        echo json_encode($res_data);
    }
?>