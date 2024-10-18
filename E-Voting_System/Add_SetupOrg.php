<?php
    include "database_connect.php";
    $pic_uploaded = 0;

    if(isset($_POST['submitbtn'])){
        $orgname = $_POST['nameorg'];
        $schladdress = $_POST['address'];
        $number = $_POST['phonenumber'];
        
        $image = time().$_FILES["logo"]['name'];
        if(move_uploaded_file($_FILES['logo']['tmp_name'], $_SERVER['DOCUMENT_ROOT']. 
        '/UPDATED_E-VOTING_SYSTEM/E-Voting_System/Organization/'.$image)){
            $target_file = $_SERVER['DOCUMENT_ROOT'].'/UPDATED_E-VOTING_SYSTEM/E-Voting_System/Organization/'.$image;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $picname = basename($_FILES['logo']['name']);
            $photo = time().$picname;
            if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "svg"){
            ?>

                <script> 
                    alert("Please upload photo having extension .jpg / .jpeg / .png / .svg");
                </script>
            <?php
            }
            else if($_FILES["logo"]["size"] > 1000000){
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

        if(empty($orgname)){
            header("Location: SetUp_Organization.php?message=School name of the organization is required");
            exit();  
        }elseif(empty($schladdress)){
            header("Location: SetUp_Organization.php?message=School address of the organization is required");
            exit(); 
        }elseif(empty($number)){
            header("Location: SetUp_Organization.php?message=Number of the organization is required");
            exit();
        }else{
            $sql = "INSERT INTO setup (organization_name, school_address, admin_number, logo) 
            VALUES ('$orgname','$schladdress','$number','$photo')";
            $result = mysqli_query($conn, $sql);

            if(!$result){
                die("Query Failed: " . $conn->error);
            }
            else{
                header("Location: SetUp_Organization.php?insert_msg=New organization have been added successfully");
                exit();   
            }
        }

    }
?>

