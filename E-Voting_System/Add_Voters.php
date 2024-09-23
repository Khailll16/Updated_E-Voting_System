<?php
    include "database_connect.php";
    $pic_uploaded = 0;

    if(isset($_POST['add_voters'])){
        $votersfirstname = $_POST['votersfirstname'];
        $voterslastname = $_POST['voterslastname'];
        $Grade = $_POST['grade'];
        $Section = $_POST['section'];
        $voterspassword = password_hash($_POST['voterspassword'], PASSWORD_DEFAULT);
        
        $image = time().$_FILES["votersprofile"]['name'];
        if(move_uploaded_file($_FILES['votersprofile']['tmp_name'], $_SERVER['DOCUMENT_ROOT']. 
        '/E-Voting_System/Voters/'.$image)){
            $target_file = $_SERVER['DOCUMENT_ROOT'].'/E-Voting_System/Voters/'.$image;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $picname = basename($_FILES['votersprofile']['name']);
            $photo = time().$picname;
            if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "svg"){
            ?>

                <script> 
                    alert("Please upload photo having extension .jpg / .jpeg / .png / .svg");
                </script>
            <?php
            }
            else if($_FILES["votersprofile"]["size"] > 1000000){
            ?>
                <script> 
                    alert("Image size is too large");
                </script>
            <?php } 
            else{
                $pic_uploaded = 1;
            }
        }

		if($pic_uploaded == 1){}

        

        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $votersid = substr(str_shuffle($set), 0, 15);

        if(empty($votersfirstname)){
            header("Location: Voters_Page_Admin.php?message=Firstname of the voter is required");
            exit();  
        }elseif(empty($voterslastname)){
            header("Location: Voters_Page_Admin.php?message=Lastname of the voter is required");
            exit(); 
        }elseif(empty($Grade)){
            header("Location: Voters_Page_Admin.php?message=Grade of the voter is required");
            exit();
        }elseif(empty($Section)){
            header("Location: Voters_Page_Admin.php?message=Section of the voter is required");
            exit();
        }elseif(empty($voterspassword)){
            header("Location: Voters_Page_Admin.php?message=Password of the voter is required");
            exit(); 
        }else{
            $sql = "INSERT INTO voters (voters_firstname, voters_lastname, voters_password, voters_id, voters_photo, grade_id, section_id) 
            VALUES ('$votersfirstname','$voterslastname','$voterspassword','$votersid','$photo','$Grade','$Section')";
            $result = mysqli_query($conn, $sql);

            if(!$result){
                die("Query Failed: " . $conn->error);
            }
            else{
                header("Location: Voters_Page_Admin.php?insert_msg=New voters has been added successfully");
                exit();   
            }
        }

    }
?>

