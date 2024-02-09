<?php
include 'EAusers.php';
include 'EAstudents.php';
include 'EAteachers.php';
include 'EA.php';

function calculateTimeDifference($timestamp) 
{
  date_default_timezone_set('Asia/Dhaka');
  $postDateTime=DateTime::createFromFormat('Y-m-d H:i:s',$timestamp);
  $currentDateTime=new DateTime();
  $timeDifference=$currentDateTime->diff($postDateTime);
  echo "Posted ";
  if($timeDifference->y>0)
  {
    echo $timeDifference->y," year",($timeDifference->y>1?"s":"")," ago";
  }
  elseif($timeDifference->m>0)
  {
      echo $timeDifference->m," month",($timeDifference->m>1?"s":"")," ago";
  }
  elseif($timeDifference->d>0)
  {
      echo $timeDifference->d," day",($timeDifference->d>1?"s":"")," ago";
  }
  elseif($timeDifference->h>0)
  {
      echo $timeDifference->h," hour",($timeDifference->h >1?"s":"")," ago";
  }
  elseif($timeDifference->i>0)
  {
      echo $timeDifference->i," minute",($timeDifference->i>1?"s":"")," ago";
  }
  else
  {
      echo "a few seconds ago";
  }
}

function showPublicationRequest()
{
  $servername="localhost";
  $user="root";
  $pass="";
  $dbase="eduassist";
  $conn=new mysqli($servername,$user,$pass,$dbase);

  $sqlpub="select * from eapost where status='1' order by date desc";
  $executepub=$conn->query($sqlpub);
  if($executepub->num_rows>0)
  { ?> 
    <table>
        <tr>
          <th>Name</th>
          <th>Article</th>
          <th>Date</th>
        </tr> <?php
    while($p=mysqli_fetch_assoc($executepub))
    { ?>
        <tr>
          <td><button type="submit" name="puser" class="user"><?php echo $p['user'];  ?></button></td>
          <td class="limited_text"><?php echo $p['article'];?></td>
          <td class="time"><?php calculateTimeDifference($p['date']);?></td>
          <td><center><button type="submit" name="writecom" class="small" value="<?php echo $p['a_no'];  ?>">View Article</button></center></td>
        </tr> <?php
      if(!empty($p['file']))
      { ?>
        <tr>
          <td><?php echo $p['file'];?></td>
          <td><button type="submit" name="download" class="small">Download</button></td>
        </tr> <?php
        if(isset($_POST['download']))
        {
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename="'.$p['file'].'"');
        }
      }
    } ?>
        </table><hr>
        <center><button type="submit" name="back">BACK</button></center> <?php
  }
  else
  {
    echo "<center>No Updates Available...</center>";
  }
}

function showApplication()
{
  $servername="localhost";
  $user="root";
  $pass="";
  $dbase="eduassist";
  $conn=new mysqli($servername,$user,$pass,$dbase);

  $sqla="select * from apply";
  $executea=$conn->query($sqla);
  if($executea->num_rows>0)
  { ?>
    <table border="1">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Resume</th>
          <th colspan="2">Action</th>
        </tr> <?php
    while($a=mysqli_fetch_assoc($executea))
    { ?>
        <tr>
          <td><?php echo $a['name'];  ?></td>
          <td><?php echo $a['email'];  ?></td>
          <td><button type="submit" name="rv">Resume</button></td>
          <td><button type="submit" name="ra" class="login">Approve</button></td>
          <td><button type="submit" name="rr" class="logout">Discard</button></td>
        </tr> <?php
    } ?>
    </table><hr>
    <center><button type="submit" name="back">BACK</button></center> <?php
  }
  else
  {
    echo "<center>No Updates Available...</center>";
  }
}

session_start();
$auser=$_SESSION['username'];
$table=$_SESSION['usertype'];
?>

<!DOCTYPE html>
<head>
  <title>Index</title>
  <link rel="stylesheet" href="EAstyles.css">
</head>
<body>
  <form method="post">
    <button type="submit" name="home" class="homebutton">EDUCATION ASSISTANT</button>
      <options_left>
        <center><button type="submit" name="logout" class="logout">SIGN out</button></center>
      </options_left>
      <options_right>
      </options_right>
      <div class="sticky">
        <center><button type="submit" name="profile" class="focus">Welcome, Mr. <?php echo $_SESSION['username'];?></button></center>
      </div>
      <div class="feed">
      <?php
          if(!isset($_SESSION['username'])) 
          {
            header('Location:EAlogin.php');
          }
          else
          {
            if(isset($_POST['logout']))
            {
              session_destroy();
              header('Location:EAlogin.php');
            }
            elseif(isset($_POST['puser']))
            {
              if($_POST['puser']==$cuser)
              {
                header('Location:EAprofile.php');
              }
              else
              {
                $suser=$_POST['puser'];
                $_SESSION['suser']=$suser;
                header('Location:EAview.php');
              }
            }
            elseif(isset($_POST['back']))
            {
              header('Location:EAadmin.php');
            }
            elseif(isset($_POST['profile']))
            {
              header('Location:EAprofile.php');
            }
            elseif(isset($_POST['va']))
            {
              showApplication();
            }
            elseif(isset($_POST['vp']))
            { ?>
              Publication Requests:<hr> <?php
              showPublicationRequest();
            }
            else
            { ?>
              <button type="submit" name="va" class="profilemenu">View Application Requests</button>
              <button type="submit" name="vp" class="profilemenu">View Publication Requests</button>  <?php
            }
          }
        ?>
      </div>
  </form>
</body>
</html>