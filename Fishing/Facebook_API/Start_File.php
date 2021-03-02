<?php
$filename="";
if (array_key_exists('my_file', $_FILES)){
	$path = pathinfo($_FILES['my_file']['name']);
	$filename = $path['filename'];
}
echo "The place is ".$towns[$place];
echo '<script type="text/javascript">',
"Send_FC('".$new_date."', '".$_SESSION["user_Nname"]."', '".$filename."', '".
$towns[$place]."', '".$last_id."');",
'</script>'
;
?>