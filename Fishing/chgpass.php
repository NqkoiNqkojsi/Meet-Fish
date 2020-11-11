<?php
if(isset($_REQUEST["id"])){//Modal sending email to change pass and the change it
?>
<div id="Modal1" class="modala"><!--Change the PASS-->
	<!-- Modal content -->
	<div class="modal-contenta">
		<span class="close">&times;</span>
		<?php if($mes==false){ ?>
		<h3 style="color:#E85A4F;"><?php echo $message; ?></h3>
		<?php } ?>
		<form class="form-inline" action=<?php echo "Sign_Up.php?id=".$id1 ?> method="post">
            <label for="NewPass">Нова парола:</label>
            <input type="password" id="NewPass" placeholder="Въведи Нова парола" name="NewPass">
			<br>
            <label for="RePass">Въведете отнова парола:</label>
			<br>
            <input type="password" id="RePass" placeholder="Въведи отнова парола" name="RePass">
            <button type="submit" name="send2" class="signupbtn">Запиши</button>
        </form>
	</div>
</div>
<?php
}else{
?>
<button id="ModalBtn1" type="button" class="typeBtn1">Смени Паролата</button><!--Send the Email-->
<div id="Modal1" class="modala">
	<!-- Modal content -->
	<div class="modal-contenta">
		<span class="close">&times;</span>
		<?php if($mes==false){ ?>
		<h3 style="color:#E85A4F;"><?php echo $message; ?></h3>
		<?php } ?>
		<form action="Sign_Up.php" method="post">
			<label for="email"><b>Е-мейл*</b></label>
			<input type="text" placeholder="Въведете Е-мейл..." name="email" required>
			<button type="submit" name="send1" class="signupbtn">Изпрати</button>
		</form>
	</div>
</div>
<?php
}
?>