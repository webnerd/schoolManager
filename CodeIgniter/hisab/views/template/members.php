<div id="container">

	<h1> Members of <?php echo $data[0]['seo_title']; ?></h1>


        <div class="large-6 columns">
            <ul class="side-nav">
                <?php foreach($data as $house){?>
                <li>
                    <span class="title"></span><span class="data"><a href="/<?php echo $house['username']; ?>/"><?php echo ucwords($house['user_name']); ?></a></span>
                </li>
                <?php } ?>
            </ul>
        </div>

        <!--div class="large-6 columns">
            <a href="#" data-dropdown="drop" class="button dropdown">Expenditure</a>
            <ul id="drop" data-dropdown-content class="f-dropdown">
                <li>
                    <a href="/expenditure/view/<?php echo $data[0]['seo_title']; ?>/">View Expenditure</a>
                </li>

                <li>
                    <a href="/expenditure/add/<?php echo $data[0]['seo_title']; ?>/">Add Expenditure</a>
                </li>
            </ul>
        </div-->

	</div>