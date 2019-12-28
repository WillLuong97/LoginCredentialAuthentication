<!DOCTYPE html>
<html>
<body>
<style>
/* body
{
	background-image: url(background2.png);
} */

</style>
	<h1 ALIGN = CENTER> Welcome to Image Upload </h1>
    <h2>Login</h2>
    <form method="post" action="HW04_TriLuong.php">
      Username: <input type="text" name="user" placeholder="Enter username"><br>
      Password: <input type="password" name="password" placeholder="Enter password"> <br>
      <br>Captcha:  <input type="text" name="captcha"> <img src="captcha.php"> <br>
      <br><input type="submit" value="Submit">
    </form>


    <?php
      session_start();
    //opening a connection to the phpmyadmin server.
      if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
        // SERVER INFORMATION
        $servername = "localhost:3306";
        $username = "root";
        $password = "COSC4343";
        $dbname = "table1";
        //establishing connection:
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn)
        {
            die("Connection failed: " . mysqli_connect_error());
        }

        echo "Connection successful!<br>";

		    //Getting user information.
        $user = $_POST["user"];
        $password = $_POST["password"];
        $sessionCaptcha = $_SESSION['captcha'];
        $formCaptcha = $_POST['captcha'];
        //MD5 hashing:
        $hashPass = md5($password);

        //captcha validation:
        if($sessionCaptcha == $formCaptcha)
        {
          // check to see if user is in the system.
          $sql = "Select * FROM UserAccounts WHERE (username= '$user' AND password='$hashPass')";
          $result = mysqli_query($conn, $sql);

          // Check for existing login information status.
          if (mysqli_num_rows($result) > 0)
          { 
            //Sending the user to the logged in page.
            while($row = mysqli_fetch_assoc($result))
            {  
							//checking for user clearance and display appropriate information
							//Based on different clearance types.
							if($row["clearance"]=="T")
							{
								//directing the user to the image dispaly page
								echo "<script>location.href='topSecret.html';</script>";
              }
              
              else if($row["clearance"]=="S")
              {
              	//directing the user to the appropriate image display page
								echo "<script>location.href='secret.html';</script>";

              }

              else if($row["clearance"]=="C")
              {
                //directing the user to the appropriate image display page
								echo "<script>location.href='confidential.html';</script>";

              }

              else
              {
                echo "<script>location.href='unclassified.html';</script>";

              }


            }
          }
          //No matched information.
          else
          {
            echo "Your information is not correct! Please try again!";
          }
        }
      

        else{

          function alert($msg)
          {
              echo "<script type='text/javascript'>alert('$msg');</script>";
          }

          alert("We cannot determine if you are not a robot! Please try the CAPTCHA again!");


          // echo "We cannot determine if your not a robot! Please try again!";
        }
        echo"<br>";

        //closing connection.
        mysql_close($conn);
        // end of checking log-in information.
      }
  ?>

</body>
</html>
