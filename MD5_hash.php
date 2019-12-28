<?php
    session_start();
    
    $alicePassword = "@l!c3";
    $bobPassword = "B0b";
    $charliePassword = "Ch@r1!3";
    $davePassword = "D@v3";

    //variables to hold user password
    $aliceHash = md5($alicePassword);
    $bobHash= md5($bobPassword);
    $charlieHash = md5($charliePassword);
    $davePeHash = md5($davePassword);

    //testing the hash function.
    echo "Alice Hash";
    echo "<br>";
    echo($aliceHash);
    echo "<br>";
    echo "Bob Hash";
    echo "<br>";
    echo($bobHash);
    echo "<br>";
    echo "Charlie Hash";
    echo "<br>";
    echo($charlieHash);
    echo "<br>";
    echo "Dave Hash";
    echo "<br>";
    echo($davePeHash);
    echo "<br>";

    //connecting to the database
    // SERVER INFORMATION
    $servername = "localhost:3306";
    $username = "root";
    $password = "COSC4343";
    $dbname = "table1";
    //establishing connection:
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection status.
    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    echo "Connection successful!<br>";

    //Updating the stored password with the hashed version.
    $sql = "UPDATE UserAccounts SET password='$aliceHash' WHERE userID=1";
    // mysql_select_db('UserAccounts');
    $retVal = mysql_query($conn, $sql);

    //checking for the update status.
    if($retVal)
    {
        echo "Data Upload susccesfull\n";

    }
    else
    {
        die("Unable to update data due to: " .mysql_error($retVal));

    }

    //close connection
    mysql_close($conn);
     
?>
