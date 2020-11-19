<?php
session_start();
include "logging.php";
include "conn.php";
include "towns.php";
?>
<html>
<head>
    <title>Meet & Fish</title>
    <link rel="stylesheet" href="CSS/pricing.css">
<?php 
include "navbar.php";
?>
    </div>
	<br><br>
    <h2 style="text-align:center">Абонаментни планове</h2>
<p style="text-align:center">Изберете един за да се запишете в сайта.</p>

<div class="columns_price">
  <ul class="price">
    <li class="header">Хоби</li>
    <li class="grey">Безплатно</li>
    <li>1 участие в среща на седмица</li>
    <li>Малко Реклами</li>
    <li>Невъзможност за създаване на срещи с лодки</li>
    <li>Без достъп до професионални оферти</li>
    <li class="grey"><a href="#" class="button_price">Sign Up</a></li>
  </ul>
</div>

<div class="columns_price">
  <ul class="price">
    <li class="header" style="background-color:#4CAF50">Хоби++</li>
    <li class="grey">3лв/месец</li>
    <li>НЕОГРАНИЧЕНО участие в срещи</li>
    <li>Без Реклами</li>
    <li>Достъп до създаване на оферти с лодки</li>
    <li>Без достъп до професионални оферти</li>
    <li class="grey"><a href="#" class="button_price">Sign Up</a></li>
  </ul>
</div>

<div class="columns_price">
  <ul class="price">
    <li class="header">Професионален</li>
    <li class="grey">7лв/месец</li>
    <li>НЕОГРАНИЧЕНО участие в срещи</li>
    <li>Без Реклами</li>
    <li>Достъп до създаване на оферти с лодки</li>
    <li>Достъп до професионални оферти</li>
    <li class="grey"><a href="#" class="button_price">Sign Up</a></li>
  </ul>
</div>

</body>
</html>
