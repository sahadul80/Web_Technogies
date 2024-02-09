<!DOCTYPE html>
<html>
<head>
    <title>Donate:EA</title>
    <link rel="stylesheet" href="EAstyles.css">
</head>
<body>
  <form method="post">
    <button type="submit" name="home" class="homebutton">EDUCATION<br>ASSISTANT</button><br>
      <div class="place">
        <shift-right>
          <button name="about" class="menu"></button>
          <button name="apply" class="menu"></button>
          <button name="donate" class="menu"></button>
          <button name="contact" class="menu"></button>
        </shift-right>
        <shift-right>
          <input type="search" value="type here to search!" onfocus="this.value=''" name="go" class="stext">
          <button name="search" class="search">Search</button>
        </shift-right>
      </div>
      <hr>  
      <div class="center">
        <center>
          Enter your account number:   <input type="text">
          <br>
          <br>
          Enter Amount : <input type="text">
          <br>
          <br>
          Enter Your email: <input type="text">
          <br>
          <br>
          <button type="submit">Donate</button>
        </center>
      </div>
      <center>
        <div class="slogan">
            <hr>ONE PLATFORM TO SERVE...<br>
            ...ALL YOUR <br>
            EDUCATIONAL NEEDS!
        </div>
      </center>
    </form>
</body>
</html>
<?php
    if(isset($_POST['about']))
    { ?>
    <p class="aside">As a non-profitable organization, EA should create the scope for the students and provide free education to the poor to develop better careers. After proper implementations, the researcher can also spend their quality time on this platform to explore and publish their articles easily. These students and research works can be contributed as an asset for development. Hence, the education sector of our country might get strong enough to mitigate any crisis effectively and improvise global contribution.</p>
    <?php }
    elseif(isset($_POST['contact']))
    { ?>
    <p class="aside">For any emergency query, contact us:<br>Phone: <ins>+8801866820045</ins><br><br>Or Click <a href="mailto:sahadul80@gmail.com">HERE</a> to send email.</p>
    <?php }
    elseif(isset($_POST['search']))
    {

    }
    elseif(isset($_POST['login']))
    {
        header('Location: EAlogin.php');
    }
    elseif(isset($_POST['register']))
    {
        header('Location: EAregister.php');
    }
    elseif(isset($_POST['donate']))
    {
        header('Location: EAdonate.php');
    }
    elseif(isset($_POST['apply']))
    {
        header('Location: EAapply.php');
    }
    elseif(isset($_POST['home']))
    {
        header('Location: EAhome.php');
    }
    else
    {
        
    }
?>