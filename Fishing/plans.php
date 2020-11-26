<?php
if(!isset($_SESSION["user_ID"])){
?>
<button id="ModalBtn1" class="signupbtn">Избери план за регистриране</button>

    <div id="Modal1" class="modal1">
<div class="slideshow-container">

<span class="close">&times;</span>

<div>
<div class="columns_price">
  <ul class="price">
    <li class="header">Хоби</li>
    <li class="grey">Безплатно</li>
    <li>1 участие в среща на седмица</li>
    <li>Малко Реклами</li>
    <li>Невъзможност за създаване на срещи с лодки</li>
    <li>Без достъп до професионални оферти</li>
    <li class="grey">
        <button type="submit" name="submit" class="button_price" value="1">Запиши се</button>
    </li>
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
      <li class="grey">
          <button type="submit" name="submit" class="button_price" value="2">Запиши се</button>
      </li>
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
      <li class="grey">
          <button type="submit" name="submit" class="button_price" value="3">Запиши се</button>
      </li>
  </ul>
</div></div>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
<div class="dot-container">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div>
</div></div>
    <script src="JS/pricing_js.js"></script>
    <script src="JS/modal1.js"></script>
<?php
}else{
?>
    <h2 style="text-align:center">Абонаментни планове</h2>
<p style="text-align:center">Изберете един за да се запишете в сайта.</p>

    <button id="ModalBtn1">Open Modal</button>

<div id="Modal1" class="modal1">
<div class="slideshow-container">

<span class="close">&times;</span>

<div >
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
</div></div>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
<div class="dot-container">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div>
</div></div>
    <script src="JS/pricing_js.js"></script>
    <script src="JS/modal1.js"></script>
<?php
}
?>
