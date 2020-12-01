<?php
echo '<script type="text/javascript">',
'Send_FC('.$new_date.', '.$_SESSION["user_Nname"].', user.png, '.
$towns[intval($_SESSION["user_Plc"])].', '.$last_id.');',
'</script>'
;
?>