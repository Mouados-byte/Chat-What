<?php
// Include the database configuration file
require_once "C:\Users\LENOVO\Desktop\PHP Projects/reminder/config.php";
require APP_ROOT."/database/db.php";
$statusMsg = '';

// File upload path
$targetDir = "C:\Users\LENOVO\Desktop\PHP Projects/reminder/assets/images/";
$fileName =  basename($_FILES["profile_pic"]['name']);
$hashedFileName = hash('md5', basename($_FILES["profile_pic"]['name']));
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$fileName = $hashedFileName . '.' . $fileType;
$targetFilePath = $targetDir . $fileName;

$image_id = -1;

print_r($_FILES["profile_pic"]['name']);



if(!empty($_FILES["profile_pic"]['name'])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["profile_pic"]['tmp_name'], $targetFilePath)){
            // Insert image file name into database
            $insert = $conn->query("INSERT into images (filename, uploaded_on) VALUES ('".$fileName."', NOW())");
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                $image_id =  $conn->insert_id;
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
            print_r(error_get_last());
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
return -1;
?>