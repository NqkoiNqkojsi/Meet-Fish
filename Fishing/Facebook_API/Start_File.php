<?php
$filename="";
if (array_key_exists('my_file', $_FILES)){
	$path = pathinfo($_FILES['my_file']['name']);
	$filename = $path['filename'].".".$path['extension'];
}
echo '<script type="text/javascript">',
"Send_FC1('".$new_date."', '".$_SESSION["user_Nname"]."', '".$filename."', '".//Change to Send_FC later 
$towns[$place]."', '".$last_id."');",
'</script>'
;
?>