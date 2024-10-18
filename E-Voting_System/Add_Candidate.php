<?php
    include "database_connect.php";
    $pic_uploaded = 0;

    if(isset($_POST['add_candidate'])){
        $candifname = $_POST['candidate-firstname'];
        $candilname = $_POST['candidate-lastname'];
        $candiposition = $_POST['position'];
        $candiplatform = $_POST['candidate-platform'];

        $image = time().$_FILES["candidate-photo"]['name'];
        if(move_uploaded_file($_FILES['candidate-photo']['tmp_name'], $_SERVER['DOCUMENT_ROOT']. 
        '/UPDATED_E-VOTING_SYSTEM/E-Voting_System/Candidates/'.$image)){
            $target_file = $_SERVER['DOCUMENT_ROOT'].'/UPDATED_E-VOTING_SYSTEM/E-Voting_System/Candidates/'.$image;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $picname = basename($_FILES['candidate-photo']['name']);
            $photo = time().$picname;
            if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "svg"){
            ?>

                <script> 
                    alert("Please upload photo having extension .jpg / .jpeg / .png / .svg");
                </script>
            <?php
            }
            else if($_FILES["candidate-photo"]["size"] > 1000000){
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
        $candidateid = substr(str_shuffle($set), 0, 15);

        if(empty($candifname)){
            header("Location: Candidates_Page_Admin.php?message=Firstname of the candidate is required");
            exit();  
        }elseif(empty($candilname)){
            header("Location: Candidates_Page_Admin.php?message=Lastname of the candidate is required");
            exit(); 
        }elseif(empty($candiposition)){
            header("Location: Candidates_Page_Admin.php?message=Position of the candidate is required");
            exit(); 
        }elseif(empty($candiplatform)){
            header("Location: Candidates_Page_Admin.php?message=Platform of the candidate is required");
            exit();
        }else{
            $sql = "INSERT INTO candidates (position_id, candidate_firstname, candidate_lastname, platform, candidate_profile) 
            VALUES ('$candiposition','$candifname','$candilname','$candiplatform','$photo')";
            $result = mysqli_query($conn, $sql);

            if(!$result){
                die("Query Failed: " . $conn->error);
            }
            else{
                header("Location: Candidates_Page_Admin.php?insert_msg=New Candidate have been added successfully");
                exit();   
            }
        }
    }else{
		$_SESSION['error'] = 'Fill up add form first';
	}

?>