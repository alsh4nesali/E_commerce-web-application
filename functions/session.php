<?php  
    include('connection.php');
    session_start();
    $logged = false;
    //checking who logged in the admin or the user
    if(isset($_SESSION['logged']))
    {
        if ($_SESSION['logged'] == true)
        {
            $logged = true ;
            $username = $_SESSION['username'];
        }
    }
    else
        $logged=false;

    if($logged != true)
    {
        $username = "";
        if (isset($_POST['username']) && isset($_POST['pass']))
        {
            $username=$_POST['username'];
            $password=$_POST['pass'];            
              
            //user LOG-IN checking
            $sql = "SELECT * FROM user WHERE username='$username' AND pw='$password' ";

            $result = mysqli_query($con,$sql);
            $count = mysqli_num_rows($result);

            if ($count == 1) {
                $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                $_SESSION['logged']=true;
                $_SESSION['username'] = $username;
                $_SESSION['uid']=$row['id'];
                $_SESSION['account']="user";
                header("Location:index.php");
            }


            //admin LOG-IN checking
            $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND pw='$password' ";

            $result = mysqli_query($con,$sql);
            $count = mysqli_num_rows($result);

            if ($count == 1) {
                $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                $_SESSION['logged']=true;
                $_SESSION['username'] = $username;
                $_SESSION['aid']=$row['id'];
                $_SESSION['account']="admin";
                header("Location:dashboard.php");
            }

            else
                {

            echo "<script>
            alert('Invalid User!');
            window.location.href='index.php';
            </script>";
                }
        }
    }
?>