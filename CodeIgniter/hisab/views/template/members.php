<div id="container">
	
	<?php if(!empty($_SESSION['username'])){ ?>
		<h1>Welcome <?php echo $_SESSION['username'];?></h1>
	<?php } else { ?>
		<h1>Welcome to Hisab.com!</h1>
	<?php } ?>
	<h1><a href="/expenditure/<?php echo $data[0]['seo_title']; ?>/">Expenditure</a></h1>
	<div id="body">
	<ul>
	<?php foreach($data as $house){?>
		<li>
			<span class="title"></span><span class="data"><a href="/<?php echo $house['username']; ?>/"><?php echo ucwords($house['user_name']); ?></a></span>
		</li>
	<?php } ?>
	</ul>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>