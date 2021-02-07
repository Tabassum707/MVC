<?php
   require APPROOT . '/views/includes/head.php';
?>
<div id="section-landing">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>

     <div class="wrapper-landing">
    
        <h1><?php echo $data['title'];?></h1>
    <p align="justify">
    	<h1><?php echo $data['description'];?> </h1> <br>
    	<h2>This is my CSE470 project built in MVC Struture. I took help from <i> Code with Dary </i> on <i>Youtube</i> to learn MVC in PHP.</h2>
    </p>
</div>
</div>