<!DOCTYPE html>
<html>
<head>
    <title>Home: EA</title>
    <link rel="stylesheet" href="CSS/EAstyles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    function about() 
    {
        var value="Welcome to EDUCATION ASSISTANT!<br>Click SIGNUP to Register...<br>To join us Click APPLY!";
        if(document.getElementById('aboutea').innerHTML == value)
        {
            document.getElementById('aboutea').innerHTML = "As a non-profitable organization, EA should create the scope for the students and provide free education to the poor to develop better careers. After proper implementations, the researcher can also spend their quality time on this platform to explore and publish their articles easily. These students and research works can be contributed as an asset for development. Hence, the education sector of our country might get strong enough to mitigate any crisis effectively and improvise global contribution.";
        }
        else
        {
            document.getElementById('aboutea').innerHTML = value;
        }
    }
    function contact() 
    {
        var value="Welcome to EDUCATION ASSISTANT!<br>Click SIGNUP to Register...<br>To join us Click APPLY!";
        if(document.getElementById('aboutea').innerHTML == value)
        {
            document.getElementById('aboutea').innerHTML = "For any emergency query, contact us:<br>Phone: <ins>+8801866820045</ins><br><br>Or Click <a href='mailto:sahadul80@gmail.com'>HERE</a> to send email.";
        }
        else
        {
            document.getElementById('aboutea').innerHTML = value;
        }
    }
    $(document).ready(function()
    {
        $("#ps").on("keyup", function()
        {
            var value = $(this).val().toLowerCase();
            $("#ptable tr").filter(function()
            {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    </script>
    <style>
        .options_left
        {
            margin-top: 2px;
            width: 150px;
            height: 260px;
            backdrop-filter: blur(50px);
        }
        .options_right
        {
            margin-top: 2px;
            margin-left: 1050px;
            width: 382px;
            height: 600px;
        }
        .feed
        {
            margin-top: 2px;
            margin-left: 200px;
            width: 775px;
            height: 200px;
            padding: 50px;
        }
        .homebutton
        {
            padding: 20px;
            right: 8px;
        }
    </style>
</head>
<body>
    <form id="myForm" method="post" action="../Controllers/EAihome.php">
        <button type="submit" name="home" class="homebutton">EDUCATION ASSISTANT: AN ONLINE EDUCATIONAL PLATFORM.</button>
        <center><div class="menubar">
            <table class="sticky">
            <tr>
                <td><button name="apply" class="menu">Apply</button></td>
                <td><button name="donate" class="menu">Donate</button></td>
                <td><button type="button" onclick="about()" class="menu">About</button></td>
                <td><button type="button" onclick="contact()" class="menu">Contact US</button></td>
            </tr>
            </table>
        </div></center>
        <div class="options_left">    
            <center><br><br><br><button name="login" class="login">Sign in</button>
            <hr>New Here?<hr>
            <button name="register" class="logout">Sign up!</button></center>
        </div>
        <div class="options_right">
            <center><input type="search" name="go" id="ps" placeholder="type here to search..." class="stext">
            <button name="search" class="search">Search</button></center>  <?php
        session_start();
        include '../Model/EA.php';
        include '../Model/EAtime.php';
        $status=setPublished();
        echo $status;
        $published=viewPublication();
        if($published!="")
        {   ?>
            <table> <?php
            foreach($published as $s)
            {   ?>
                <tr>
                    <td class="user">Published By: <?php echo $s['username'];    ?></td>
                    <td class="time"><?php echo calculateTimeDifference($s['date']);    ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="limited_text"><?php echo $s['publication'];    ?></td>
                </tr>
                <tr>
                    <td><?php echo $s['pfile'];    ?></td>
                    <td><a download="<?php echo $s['pfile']; ?>" href="../Files/<?php echo $s['pfile']; ?>">Download</a></td>
                </tr>   <?php
            }   ?>
            </table>
            <center><button type="submit" name="viewpost" value="<?php echo $s['p_no'];    ?>">VIEW</button></center><hr>    <?php
        }
        else
        {
            echo "<center>No results found!</center>";
        }   ?>
        </div>
        <div class="feed">
            <center><p id="aboutea">Welcome to EDUCATION ASSISTANT!<br>Click SIGNUP to Register...<br>To join us Click APPLY!</p></center>
        </div>
    </form>
</body>
</html>