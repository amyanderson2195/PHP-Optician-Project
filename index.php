<!--
    NAME OF SCREEN:     Dashboard
    PURPOSE OF SCREEN:  Front page of web application
    STUDENT ID:         C00276123, C00275764, C00290922, C00273530
    STUDENT NAME:       Amy Anderson, Mirella Glowinska, Douglas Kadzutu, Dawid Pionk
    DATE WRITTEN:       01/2023
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <!-- use icons from fontawesome -->
    <script src="https://kit.fontawesome.com/e9ccd8bcf3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/styles/styles.css">
    <title>Optician Dashboard</title>
</head>
<body>
    <div class="container">
        <?php include "sidebar.html" ?>
        <div id="content">
            <div id="topbar">
                <!-- This searchbar has no funcitonality -->
                <form class="searchform">
                    <input type="text" name="searchbar">
                    <input type="submit" name="search" value="search">
                </form>
            </div>
            <div class="main">
                <div id="top">
                    <h1>Dashboard</h1>
                    <h3>Welcome back, Name.</h3>
                </div>
                <p>This project uses HTML, PHP and JavaScript in conjunction with one another to access a MySQL database and perform Insert, Update and Delete actions through an easy-to-use interface. I have adapted it from a group project that I worked on in my second year of studying Software Development, showcasing only the parts that I worked on.</p>
            </div>
        </div>
    </div>
</body>
</html>
