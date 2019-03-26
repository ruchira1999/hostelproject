
<?php
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
    {
         
       
            $uname= $_POST["username"];
            $pass= $_POST["pass"];
           
        
            $co = mysqli_connect("localhost","root","123456");
                  
          $sql = "CREATE DATABASE LIST";
         
         mysqli_query($co, $sql);
           
         
         mysqli_select_db($co,'LIST');
         
         $t="create table info(username varchar(50),password varchar(40))";
         
         mysqli_query($co, $t);
                     
            $result=mysqli_query($co,"select * from info");
             if(mysqli_num_rows($result)>0){
                 
                 
                 while ($rows= mysqli_fetch_assoc($result))
                 {
                     $u=$rows["username"];
                     $p=$rows["password"];
                     
                 }
                 
             }
            
                        
             if($u==$uname  && $p==$pass){
                 
                 
                 echo "sucessfully login<br>";
                 header("location: input.php");
                                  
             }
             else{
                 echo "unsucessfully login<br>";
                 
                 
             }
         mysqli_close($co);
         
    }
       ?>


<!DOCTYPE html>

<html>
    <head>
               <link rel="stylesheet" href="a.css">
        <title>Admin Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
       
        
    </head>
    <body>
        <div class="loginAdmin">
            <form method="post" name="f1" action="">
                <label>  Username:</label><br>
                <input type="text" name="username" placeholder="Enter your username"  id="user"><br>
               
                <br>
                <label>Password:</label><br>
                <input type="password" name="pass" placeholder="Enter your password" id="pass">
                <br>
                <br>
                <input type="Submit" value="Login" name="submit" id="login" >
                <br>
                <br>
                <div style="font-size: 15px">
                <a href="www.google.com">Forgot Password ??</a>
                </div>
            </form>
            
           </div>
         <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        
        <script type="text/javascript">
            $(document).ready(function(){
     $("#login").click(function() {
     var user = $("#user").val();
     var pass = $("#pass").val();

     if (user=="" || pass=="") {

     	alert("Enter the value of all field!!");
     }

   
 });
 });       
         </script>
      
    </body>
</html>



