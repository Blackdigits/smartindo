<?php
$uploaddir = 'img/staffs/'; 
$file = $uploaddir ."cmp_".date('Ymdhis').basename($_FILES['uploadfile']['name']); 
$file_name= "cmp_".date('Ymdhis').$_FILES['uploadfile']['name']; 
 
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
	echo "$file_name"; 
} 
else {
	echo "error";
}
?>