<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Hisab.com</title>

    <link rel="stylesheet" href='/web/foundation-5.0.2/css/normalize.css' />
    <link rel="stylesheet" href='/web/foundation-5.0.2/css/foundation.min.css' />
    <link rel="stylesheet" href='/web/smoothness/jquery-ui-1.10.3.custom.min.css' />
    <link rel="stylesheet" href='/web/foundation-5.0.2/css/main.css' />
    <script  src="/web/foundation-5.0.2/js/vendor/jquery.js"></script>
</head>
<body>
<nav class="top-bar" data-topbar>
    <ul class="title-area">
        <li class="name">
            <h1><a href="/<?php !empty($_SESSION['username'])? $_SESSION['username'] : ''; ?>">Home</a></h1>
        </li>

        <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
    </ul>

    <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
            <?php if(isset($houseName)) {?>

            <li>
                <a href="/invite/<?php echo $houseName; ?>/">Invite Members</a>

            </li>

            <li <?php if(isset($activeView) && $activeView == 'view') echo 'class="active"';?>>
                <a href="/expenditure/view/<?php echo $houseName; ?>/">Current Month's Expenditure</a>
            </li>

            <li <?php if(isset($activeView) && $activeView == 'add') echo 'class="active"';?>>
                <a href="/expenditure/add/<?php echo $houseName; ?>/">Add Expenditure</a>
            </li>

            <?php } ?>

            <li>
                <a href="/logout">Logout</a>
            </li>
        </ul>

        <!-- Left Nav Section -->
        <?php if(isset($houseName)) {?>
        <ul class="left">
            <li><a href="/members/<?php echo $houseName; ?>"><?php echo $houseName; ?></a></li>
        </ul>
        <?php } ?>
    </section>
</nav>

<div id="container">

    <?php if(!empty($_SESSION['username'])){ ?>
    <h1>Welcome <?php echo $_SESSION['username'];?></h1>
    <?php } else { ?>
    <h1>Welcome to Hisab.com!</h1>
    <?php } ?>

    <div id="body">