<?php
   require APPROOT . '/views/includes/head.php';
?>
<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container center">
	<h1>
		Enter Disease History
	</h1>

	<form action="<?php echo URLROOT;?>/Profile/history" method='POST'>
		<div class="form-item">
			Smoke <select name="Smoke">
            <option>Yes</option>
            <option>No</option>
            </select>

            <span class="invalidFeedback">
                <?php echo $data['SmokeError']; ?>
            </span>
            
            <br>
            <br>

            

            Do you take Drugs? <select name="TakeDrugs">
            <option>Yes</option>
            <option>No</option>
            </select>

            <span class="invalidFeedback">
                <?php echo $data['DrugError']; ?>
            </span>

		</div>
		<br>
        <br>
		<button class="btn green" name="submit" type="submit">SUBMIT</button>
	</form>
</div>