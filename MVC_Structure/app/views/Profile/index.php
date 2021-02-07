<?php
   require APPROOT . '/views/includes/head.php';
?>
<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container">
	<?php if(isLoggedIn()): ?>
		<a class="btn green" href="<?php echo URLROOT; ?>/Profile/history">History
		</a>
	<?php endif; ?>	
	<?php foreach($data['profile'] as $post): ?>
		<div class="container-item">

			<table border="1" id="internalActivities" style="width:100%">
			<tbody>
				<tr>
					<th>Name</th>
					<td><?php echo $post->username; ?> </td>
				</tr>
				<tr>
					<th>Email</th>
					<td><?php echo $post->email; ?> </td>
				</tr>
				<tr>
					<th>Contact</th>
					<td><?php echo $post->contact; ?> </td>
				</tr>
				<tr>
					<th>Age</th>
					<td><?php echo $post->age; ?> </td>
				</tr>
			</tbody>

			</table>

	</div>
<?php endforeach; ?>
</div>
