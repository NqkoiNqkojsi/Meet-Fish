<div id="Modal1" class="modala" style="display: block;"><!--Change the PASS-->
	<!-- Modal content -->
	<div class="modal-contenta">
		<span class="close">&times;</span>
		<form class="form-inline" action="Sign_Up.php" method="post">


					<label for="nname"><b>Прякор*</b></label>
					<input id="Inp1" onfocus="Collapse('Coll1', 'Inp1')" type="text" placeholder="Въведете Прякор..." name="nname" required>
					<?php 
					if($gres==3){
					?>
					<div class="HiddObj" style="display:block;">
					    <h6 style="color=#E85A4F;"><?php echo $message2; ?></h4>
					</div>
					<?php } ?>
					<div class="HiddObj" id="Coll1">
					    <ul>
				            <li>Може да се използват Големи и Малки букви</li>
				            <li>Може да се използват числа и знаците:"._-"</li>
				            <li>Трябва да е между 3 и 15 дължина</li>
					    </ul>
					</div>


					<label for="psw"><b>Парола*</b></label>
					<input id="Inp4" onfocus="Collapse('Coll4', 'Inp4')" type="password" placeholder="Въведете Парола..." name="psw" required>
					<?php
					if($gres==5){
					?>
					<div class="HiddObj" style="display:block;">
					    <h6 style="color=#E85A4F;"><?php echo $message2; ?></h4>
					</div>
					<?php } ?>
					<div class="HiddObj" id="Coll4">
					    <ul>
				            <li>Трябва да се използва поне 1 Главна буква</li>
				            <li>Трябва да се използва поне 1 Малка буква</li>
				            <li>Трябва да се използва поне 1 цифра</li>
				            <li>Знаците трябва да са между 8 и 16</li>
					    </ul>
					</div>

					<label for="psw-repeat"><b>Повтори Парола*</b></label>
					<input type="password" placeholder="Повтори Паролата" name="psw-repeat" required>


					<label for="birth"><b>Рожден Ден*</b></label>
					<input type="date" id="birth" placeholder="Въведи рожден ден..." name="birth" required><br>
			
					<label for="place"><b>Кое е най-близкото до вас?*</b></label>
					<select name="place" required>
						<?php
						foreach($towns as $town){
							$br=$br+1;
						?>
						<option value="<?php echo $br;?>"><?php echo $town; ?></option>
						<?php
						}
						?>
					</select><br>
			     
					<label for="Ship"><b>Имаш ли лодка</b></label>
					<input type="text" placeholder="Номер на лодката..." name="ship">
			
                    <label for="Desc"><b>Опишете се за другите</b></label><br>
					<textarea id="Desc" style="height:90px;" placeholder="Въведи Описанието" name="Desc"></textarea><br><br>


					<button type="submit" name="send3" class="signupbtn">Запиши</button>
        </form>
	</div>
</div>