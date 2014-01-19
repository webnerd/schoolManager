<div id="container">
	
	<?php if(!empty($_SESSION['username'])){ ?>
		<h1>Welcome <?php echo $_SESSION['username'];?></h1>
	<?php } else { ?>
		<h1>Welcome to Hisab.com!</h1>
	<?php } ?>
	
	<div id="body">
	<ul>
	<?php foreach($data as $house){?>
		<li>
			<span class="title"></span><span class="data"><a href="/members/<?php echo $house['seo_title']; ?>"><?php echo $house['seo_title']; ?></a></span>
		</li>
	<?php } ?>
	</ul>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>