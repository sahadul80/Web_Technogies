<?php
include '../Model/EA.php';
  session_start();
  if(isset($_SESSION['friend']))
  {
    $suser=$_SESSION['friend'];
  }
  elseif(isset($_SESSION['sendfrom']))
  {
    $suser=$_SESSION['sendfrom'];
  }
  elseif(isset($_SESSION['sendto']))
  {
    $suser=$_SESSION['sendto'];
  }
  else
  {
    $suser=$_SESSION['suser'];
  }
  $username=$_SESSION['username'];
  $usertype=$_SESSION['usertype'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
  <link rel="stylesheet" href="CSS/EAstyles.css">
  <style>
    .homebutton
    {
      padding: 20px;
      right: 8px;
    }
    .feed
    {
      margin-top: 100px;
    }
  </style>
</head>
<body>
  <form method="post" action="../Controllers/EAiview.php">
    <button type="submit" name="home" class="homebutton">EDUCATION ASSISTANT</button><br>
    <div class="feed">
        <?php
          $usertype=getUsertype($suser);
          $userinfo=getUser($usertype,$suser);
          foreach($userinfo as $ui)
          { ?>
            <center>
              <table>
                <tr>
                  <td colspan="2" class="focus">User Type: <?php echo $usertype;  ?></td>
                </tr>
                <tr>
                  <td>Name: </td>
                  <td><?php echo $ui['name'];  ?></td>
                </tr>
                <tr>
                  <td>Email: </td>
                  <td><?php echo $ui['email'];  ?></td>
                </tr>
                <tr>
                  <td>Institute: </td>
                  <td><?php echo $ui['institute'];  ?></td>
                </tr>
                <tr>
                  <td>Department: </td>
                  <td><?php echo $ui['department'];  ?></td>
                </tr>
                <tr>
                  <td>Address: </td>
                  <td><?php echo $ui['address'];  ?></td>
                </tr>
              </table>
            </center><hr>
            <center><button type="submit" name="viewpublications">View Publications</button>  <?php
          }
          if(isset($_SESSION['friend']))
          { ?>
            <button type="submit" name="chat">CHAT</button>  <?php
          }
          elseif(isset($_SESSION['sendfrom']))
          { ?>
            <button type="submit" name="acceptreq">ACCEPT contact</button>  <?php
          }
          elseif(isset($_SESSION['sendby'])||isset($_SESSION['sendto']))
          { ?>
            <button type="submit" name="cancelreq" value="<?php echo $suser;?>">CANCEL request</button>  <?php
          }
          elseif(isset($_SESSION['published']))
          {
            $pub=$_SESSION['published'];
            foreach($pub as $p)
            { ?>
              <p class="time"><?php echo calculateTimeDifference($p['date']); ?></p><br>
              <p class="limited_text"><?php echo $p['article']; ?></p><br>
              <?php echo $p['file']; ?>
              <button type="submit" name="down" class="small">Download</button> <?php
              if(isset($_POST['download']))
              {
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $p['file'] . '"');
              }
            }
            unset($_SESSION['published']);
          }
          else
          { ?>
            <button type="submit" name="creq">Send Connection Request</button>  <?php
          }
          if(isset($_SESSION['mgs']))
          {
            echo $_SESSION['mgs'];
            unset($_SESSION['mgs']);
          } ?>
          <button type="submit" name="goback" class="back-button">Go Back</button></center><hr>
      </div>
    </form>
  </body>
  </html>