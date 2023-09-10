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
                <p>This has been adapted from a group project that I was involved with. I've removed the sidebar links to the pages created by other members of the team in order to showcase the parts that I worked on myself.</p>
                <p>The original code and database was hosted on SETU's servers, but after summer exams in 2023, it became no longer possible to access it in full. I copied and edited my code from the Project Manual we submitted for the module, created a MySQL database with the necessary tables, and installed Apache 2.4 on my local machine in order to debug the PHP without needing to host it elsewhere.</p>
            </div>
        </div>
    </div>
</body>
</html>