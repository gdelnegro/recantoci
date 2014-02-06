<?php
//enter same code you'll use in flash mysql class
$code = "best123fast";
//checking for secret code, to know it is you who is accessing database
if(isset($_POST['secret_code']) && $_POST['secret_code'] == $code)
{
    $exec = $_POST['qexec'];
    //connecting to database, change connection settings to ones for your database
    $connection = new mysqli("bestwebfast.com.br","bestwebf_admin",$code,"bestwebf_recanto");
    
    
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    //checking if query is submitted
    if(isset($exec))
    {
        //executing query
       
        if ($result = $connection->query($exec))
        {
            $res = array();
            $row_cnt = $result->num_rows;
            $res["row_count"] = $result->num_rows;
            if($res["row_count"] > 0) {
                while ($row = $result->fetch_assoc()) {
                    $res[] = $row;
                }
            }
            $result->close();
        }
        else
        {
            die(mysqli_error($result));
        }
        //serializing data
        echo http_build_query($res);
    }
    $connection->close();
}
?>




