<?php
  include '../Model/EAtime.php';
  include '../Model/EA.php';
  session_start();
?>
<!DOCTYPE html>
<head>
  <title>Index</title>
  <link rel="stylesheet" href="CSS/EAstyles.css">
  <script>
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
        margin-top: 100px;
        width: 300px;
        height: 600px;
    }
    .options_right
    {
        margin-top: 100px;
        margin-left: 1140px;
        width: 300px;
        height: 600px;
    }
    .feed
    {
        margin-top: 0px;
        margin-left: 340px;
        width: 760px;
        height: 580px;
        padding: 20px;
    }
    .homebutton
    {
      padding: 20px;
      right: 8px;
    }
  </style>
</head>
<body>
    <form method="post" action="../Controllers/EAistuindex.php" enctype="multipart/form-data">
      <button type="submit" name="home" class="homebutton">EDUCATION ASSISTANT</button>
      <div class="options_left">
        <center>
        Write here to POST:<br><br>
        <input type="hidden" name="status" value="0">
        <textarea name="article" class="intext" cols="36" rows="6" placeholder="Write something to post!"></textarea><br>
        <input type="file" name="upfile" class="intext">  
        <center><button type="submit" name="write">POST</button></center> <?php
        if(isset($_SESSION['mgs']))
        {
          echo $_SESSION['mgs'];
          unset($_SESSION['mgs']);
        } ?>
        <hr><hr><br>
        <?php
        if($_SESSION['usertype']=="student")
        {
          echo "Do you know dear, student?<br><br>'Education’s purpose is to replace an empty mind with an open one.' <br> – Malcolm Forbes<br>";     
        }
        elseif($_SESSION['usertype']=="teacher")
        {
          echo "Dear, teacher,<br><br> Once a great philosopher, Maimonides, said-<br>'Give a man a fish and you feed him for a day; teach a man to catch a fish and you feed him for a lifetime.'<br>";
        }
        ?>  <hr><hr>
        <center><button type="submit" name="logout" class="logout">SIGN out</button></center>
        </center>
      </div>
    <center>
      <div class="options_right">
        <p class="focus">Recent Publications:</p>
        <center><input type="search" name="go" id="ps" placeholder="type here to search..." class="stext">
        <button name="search" class="search">Search</button></center>  <?php
        $published=viewPublication();
        if($published!="")
        {   ?>
            <table> <?php
            foreach($published as $s)
            {   ?>
                <tr>
                    <td>Published By: <button type="submit" name="puser" class="user" value="<?php echo $s['username'];    ?>"> <?php echo $s['username'];    ?></button></td>
                    <td class="time"><?php echo calculateTimeDifference($s['date']);    ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="limited_text"><?php echo $s['publication'];    ?></td>
                </tr>
                <tr>
                    <td><?php echo $s['pfile'];    ?></td>
                </tr>   <?php
            }   ?>
            </table>
            <center><button type="submit" name="viewpost" value="<?php echo $s['p_no'];    ?>">VIEW</button></center><hr>    <?php
        }
        else
        {
            echo "<center>No results found!</center>";
        }
      if(!empty($_SESSION['publication']))
      {
        $publication=$_SESSION['publication'];
        foreach($publication as $p)
        { ?>
          <table>
            <tr>
              <td><button type="submit" name="puser" class="user" value="<?php echo $p['username']; ?>"><?php echo $p['username']; ?></button></td>
              <td class="time"><?php echo $p['date']; ?></td>
            </tr>
            <tr>
              <td class="limited_text"><?php echo $p['publication']; ?></td>
            </tr>
            <?php
            if (!empty($p['pfile']))
            { ?>
              <tr>
                <td><?php echo $p['pfile'];    ?></td>
                <td><a download="<?php echo $p['pfile']; ?>" href="../Files/<?php echo $p['pfile']; ?>">Download</a></td>
              </tr> <?php
            } ?>
            <tr>
              <td colspan="2"><button type="submit" name="articlecom" value="<?php echo $p['p_no']; ?>">View Article</button></td>
            </tr>
          </table>
          <hr>  <?php
        }
      }
      else
      {
        echo "<center>No More Updates...</center>";
      }
    ?>
      </div>
    </center>
      <div class="menubar">
        <center><button type="submit" name="profile" value="<?php echo $_SESSION['username'];?>" class="focus">Welcome, <?php echo $_SESSION['username'];?></button></center>
      </div>
      <div class="feed">  <?php
      $posts=showPosts();
      if(!empty($posts))
      {
        foreach($posts as $post)
        { ?>
          <table>
            <tr>
              <td><button type="submit" name="puser" class="user" value="<?php echo $post['user']; ?>"><?php echo $post['user']; ?></button></td>
              <td class="time"><?php echo calculateTimeDifference($post['date']); ?></td>
            </tr>
            <tr>
              <td class="limited_text"><?php echo $post['article']; ?></td>
            </tr>
            <?php
            if (!empty($post['file']))
            { ?>
              <tr>
                <td><?php echo $post['file']; ?></td>
                <td><a download="<?php echo $post['file']; ?>" href="../Files/<?php echo $post['file']; ?>">Download</a></td>
              </tr> <?php
            } ?>
          </table>
          <center><button type="submit" name="writecom" value="<?php echo $post['a_no']; ?>">View Post</button></center>
          <hr>  <?php
        }
      }
      else
      {
        echo "<center>No Updates Available...</center>";
      }
    ?>
      </div>
    </form>
</body>
</html>