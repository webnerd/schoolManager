<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Hisab.com</title>

    <link rel="stylesheet" href='/web/foundation-5.0.2/css/normalize.css' />
    <link rel="stylesheet" href='/web/foundation-5.0.2/css/foundation.min.css' />
    <link rel="stylesheet" href='/web/smoothness/jquery-ui-1.10.3.custom.min.css' />
    <script  src="/web/foundation-5.0.2/js/vendor/jquery.js"></script>
</head>
<body>
<nav class="top-bar" data-topbar>
    <ul class="title-area">
        <li class="name">
            <h1><a href="#">My Site</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
    </ul>

    <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
            <li class="active"><a href="#">Right Button Active</a></li>
            <li class="has-dropdown">
                <a href="#">Right Button with Dropdown</a>
                <ul class="dropdown">
                    <li><a href="#">First link in dropdown</a></li>
                </ul>
            </li>
        </ul>

        <!-- Left Nav Section -->
        <ul class="left">
            <li><a href="#">Left Nav Button</a></li>
        </ul>
    </section>
</nav>

<div id="container">

    <?php if(!empty($_SESSION['username'])){ ?>
    <h1>Welcome <?php echo $_SESSION['username'];?></h1>
    <?php } else { ?>
    <h1>Welcome to Hisab.com!</h1>
    <?php } ?>

    <div id="body">