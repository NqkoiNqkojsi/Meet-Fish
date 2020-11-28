<?php
$url= $_SERVER['REQUEST_URI'];
?>
<br><br><br><br><br>
<div class="container-fluid" style="margin: 0; padding-right: 0px; padding-left: 0px;">
    <div class="footer" style="margin-left: 0px; margin-right: 0px;">
        <div class="row">
            <div class="col-sm-3">
                <?php
                if(basename($url)=="index.php"){     //make it for index
                ?>
                <a href="www.meetandfish.online" target="_blank">
                    <img src="/Fishing/Img/logo2.png" alt="Logo" style="width:84px;height:84px;border:0;">
                    <h3>Meet&Fish</h3>
                </a>
                <?php
                    }else{     //make it for other
                ?>
                <a href="www.meetandfish.online" target="_blank">
                    <img src="Img/logo2.png" alt="Logo" style="width:84px;height:84px;border:0;">
                    <h3 style="color:black;">Meet&Fish</h3>
                </a>
                <?php
                    }
                ?>
            </div>
            <div class="col-sm-9">
                <p>Направена от Стелиан Грозев<br>Ученик от 9д</p>
                <p>При проблеми пишете на <span style="color:#3AAFA9;">mackarelbot@meetandfish.online</span></p></br>
                <div>
                    Icons made by
                    <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from
                    <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
                </div>

            </div>
        </div>
    </div>
  </div>