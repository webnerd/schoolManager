

    <div class="large-6 columns">
    <a href="#" data-dropdown="drop" class="button dropdown">Select House</a><br>
    <ul id="drop" data-dropdown-content class="f-dropdown">
        <?php foreach($data as $house){?>
        <li>
            <a href="/members/<?php echo $house['seo_title']; ?>"><?php echo $house['seo_title']; ?></a>
        </li>
        <?php } ?>
    </ul>
    </div>