<?php
    include "database_connect.php";

    if(isset($_POST['add_position'])){
        $desc_position = $_POST['position-candidate'];
        $maxvote = $_POST['maximum-vote'];
        

        if(empty($desc_position)){
            header("Location: Position_Page_Admin.php?message=Position is required");
            exit();  
        }elseif(empty($maxvote)){
            header("Location: Position_Page_Admin.php?message=Maximum vote is required");
            exit(); 
        }else{
            $sql = "INSERT INTO positions (descrip, max_vote) VALUES ('$desc_position','$maxvote')";
            $result = mysqli_query($conn, $sql);

            if(!$result){
                die("Query Failed: " . $conn->error);
            }
            else{
                header("Location: Position_Page_Admin.php?insert_msg=New position have been added successfully");
                exit();   
            }
        }
    }else{
		$_SESSION['error'] = 'Fill up add form first';
	}
?>