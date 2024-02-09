<?php
    include '../Model/EA.php';
    include '../Model/EAtime.php';
    
    session_start();
    $cuser=$_SESSION['username'];
    $table=$_SESSION['usertype'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Profile: <?php echo $table; ?></title>
  <link rel="stylesheet" href="CSS/EAstyles.css">
  <script>
    var loadFile = function(event)
    {
      var image = document.getElementById('output');
      image.src = URL.createObjectURL(event.target.files[0]);
    };
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
  <form method="post" action="../Controllers/EAiprofile.php" enctype="multipart/form-data">
    <button type="submit" name="home" class="homebutton">EDUCATION ASSISTANT</button>
    <div class="options_left">
    <center><p class="focus">My Information:</p><br>
    <input type="file"  accept="image/*" name="proimage" id="image"  onchange="loadFile(event)" style="display: none;">
    <label for="image" style="cursor: pointer;">Update Profile Picture</label>
    <img id="output" width="150" />  <?php
    $info=getInfo(); 
    foreach($info as $i)
    { ?>
      <table border="0">
        <tr>
          <td>Name:</td>
          <td><?php echo $i['name']; ?></td>
        </tr>
        <tr>
          <td>Email:</td>
          <td><?php echo $i['email']; ?></td>
        </tr>
        <tr>
          <td>Phone:</td>
            <td><?php echo $i['phone']; ?></td>
        </tr>
        <tr>
          <td>Institute:</td>
          <td><?php echo $i['institute']; ?></td>
        </tr>
        <tr>
          <td>Faculty:</td>
          <td><?php echo $i['department']; ?></td>
        </tr>
        <tr>
          <td>Address:</td>
          <td><?php echo $i['address']; ?></td>
        </tr>
      </table>  <?php
    } ?>
        <button type="submit" name="changeinfo">Update Information</button></center>
      <hr><hr>
      <center><button type="submit" name="logout" class="logout">SIGN out</button></center>
    </div>
    <div class="options_right">
      <center><p class="focus">Connections:</p><br>
      <button type="submit" name="connc">Connected Contacts</button><br>
      <button type="submit" name="connr">Connection Requests</button><br></center>
    <hr><hr>
      <center><button type="submit" name="goback" class="back-button">Go Back</button></center>
    </div>
    <div class="menubar">
      <center><button type="submit" name="profile" value="<?php echo $_SESSION['username'];?>" class="focus">Welcome, <?php echo $_SESSION['username'];?></button></center>
    </div>
    <div class="feed">
      <center><button type="submit" name="mypost" class="menu">MY POSTS</button>
      <button type="submit" name="myteam" class="menu">MY TEAMS</button></center>  <?php
    if(isset($_SESSION['myposts']))
    {
      $mypost=myPosts();
      if($mypost)
      {
        foreach($mypost as $qpost)
        { ?>
          <hr>
        <table>
          <tr>
            <th>Post</th>
            <th>Date</th>
          </tr>
          <tr>
            <td class="limited_text"><?php echo $qpost['article'];?></td>
            <td class="time"><?php calculateTimeDifference($qpost['date']);?></td>
          </tr>  <?php
            if(!empty($qpost['file']))
            { ?>
          <tr>
            <td><?php echo $qpost['file'];    ?></td>
            <td><a download="<?php echo $post['file']; ?>" href="../Files/<?php echo $post['file']; ?>">Download</a></td>
          </tr> <?php
            } ?>
        </table>
          <button type="submit" name="managepost" value="<?php echo $qpost['a_no']; ?>">Manage Post</button>
          <button type="submit" name="viewpost" class="place" value="<?php echo $qpost['a_no']; ?>">View Comments</button><hr>  <?php
        }
      }
      else
      {
        echo "<center>You have not posted anything...</center>";
      }
      unset($_SESSION['myposts']);
    }
    elseif(isset($_SESSION['a_no']))
    {
      $a_no=$_SESSION['a_no'];
      $managepost=managePost($a_no);
      foreach($managepost as $qpost1)
      {
        if($qpost1['status']==0)
        { ?>
        <center>Manage your post:</center><hr>
        <table>
          <tr>
            <th>Post</th>
            <th>Date</th>
          </tr>
          <tr>
            <td class="limited_text"><textarea name="earticle" class="intext" cols="80" rows="4"><?php
          if(isset($_SESSION['earticl']))
          {
            echo $_SESSION['earticl'];
          }
          else
          {
            echo $qpost1['article'];
          } ?></textarea></td>
            <td class="time"><?php calculateTimeDifference($qpost1['date']);?></td>
          </tr>  <?php
          if(!empty($qpost1['file']))
          { ?>
          <tr>
            <td><input type="file" name="upefile" class="intext"><?php
            if(isset($_SESSION['upefil']))
            {
              echo $_SESSION['upefil'];
            }
            else
            {
              echo $qpost1['file'];
            } ?></td>
          </tr> <?php
          }
          else
          { ?>
          <tr>
            <td><input type="file" name="upefile" class="intext"></td>
          </tr> <?php
          } ?>
        </table>
      <center>
        <button type="submit" name="editpost" value="<?php echo $a_no; ?>">Edit Post</button>
        <button type="submit" name="deletepost" value="<?php echo $a_no; ?>">Delete Post</button> <?php
        if($_SESSION['usertype']=="teacher")
        { ?>
        <button type="submit" name="publishpost" value="<?php echo $a_no; ?>">Publish Post</button> <?php
        } ?>
        <button type="submit" name="back" class="back-button">Back</button> 
      </center> <?php  
        if(!isset($_SESSION['mgs']))
        {
          if(isset($_SESSION['dpost']))
          { ?>
            <hr><br><center>Delete the post?<br>
            After deleting the post will be unavailable!<br><br>
            <button type="submit" name="dyes" class="logout" value="<?php echo $a_no; ?>" onclick="alert('Post DELETED!');">YES</button>
            <button type="submit" name="dno" class="login">NO</button></center><hr> <?php
          }
          if(isset($_SESSION['epost']))
          {  ?>
            <input type="hidden" name="eart" value="<?php echo $_SESSION['earticl'];?>">
            <input type="hidden" name="efil" value="<?php echo $_SESSION['upefil'];?>">
            <hr><br><center>Confirm Changes?<br><br>
            <button type="submit" name="eyes" class="logout" value="<?php echo $a_no; ?>" onclick="alert('Post EDITTED!');">YES</button>
            <button type="submit" name="eno" class="login">NO</button></center><hr> <?php
          }
          if(isset($_SESSION['ppost']))
          { ?>
            <hr><br><center><warning>Are you sure?<br>You can not edit or delete until it is published by the review board members!</warning><br>
            <hr><br><button type="submit" name="pyes" class="logout" value="<?php echo $a_no; ?>">YES</button>
            <button type="submit" name="pno" class="login">NO</button> 
            </center><hr> <?php
          }
        }
        else
        {
          echo $_SESSION['mgs'];
          unset($_SESSION['mgs']);
          unset($_SESSION['a_no']);
        }
      }
      else
      { ?>
      <center>This post has been procced for publicatin:</center>
      <hr>
      <table>
        <tr>
          <th class="focus">Post</th>
          <th class="focus">Date</th>
        </tr>
        <tr>
          <td class="limited_text"><textarea name="earticle" class="intext" cols="50" rows="4"><?php echo $qpost1['article'];?></textarea></td>
          <td class="time"><?php calculateTimeDifference($qpost1['date']);?></td>
        </tr>  <?php
        if(!empty($qpost1['file']))
        { ?>
        <tr>
          <td><?php echo $qpost1['file'];    ?></td>
        </tr> <?php
        } ?>
        <tr>
          <td><input type="file" name="upefile" class="intext"></td>
        </tr>
      </table>  <?php
      }
    }
  }
  elseif(isset($_SESSION['myinfo']))
  {
    $info=getInfo();
    foreach($info as $i)
    { ?>
      <br><center>Change your current information:<br>
      <table border="0">
        <tr>
          <td>Name:</td>
          <td><input type="text" name="sname" class="intext" value="<?php echo $i['name']; ?>"></td>
        </tr>
        <tr>
          <td>Email:</td>
          <td><input type="email" name="semail" class="intext" value="<?php echo $i['email']; ?>"></td>
        </tr>
        <tr>
          <td>Phone:</td>
            <td><input type="number" name="sphone" class="intext" value="<?php echo $i['phone']; ?>"></td>
        </tr>
        <tr>
          <td>Institute:</td>
          <td><input type="text" name="sinstitute" class="intext" value="<?php echo $i['institute']; ?>"></td>
        </tr><tr>
          <td><label for="department">Faculty:</label></td>
          <td>
            <select name="sdepartment" value="<?php echo $i['department']; ?>">
               <option value="FST" class="intext">Faculty of Science and Technology</option>
               <option value="FBA" class="intext">Faculty of Business Administration</option>
               <option value="FASS" class="intext">Faculty of Art And Social Sciences</option>
               <option value="FE" class="intext">Faculty of Engineering</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Address:</td>
          <td><input type="text" name="saddress" class="intext" value="<?php echo $i['address']; ?>"></td>
        </tr>
      </table></center>
      <center><button type="submit" name="save" class="logout">SAVE</button></center>  <?php
    }
    if(isset($_SESSION['mgs']))
    {
      echo $_SESSION['mgs'];
      unset($_SESSION['mgs']);
      unset($_SESSION['myinfo']);
    }
  }
  elseif(isset($_SESSION['myteams']))
  {

  }
  elseif(isset($_SESSION['conncon']))
  { ?>
    <table>
      <tr>
        <td colspan="2">My Contacts:</td>
      </tr> <?php
    $contacts=myContacts();
    $friends=myFriends();
    if($contacts)
    { 
      foreach($contacts as $contact)
      { ?>
          <tr>
            <td><button type="submit" name="friend" class="user" value="<?php echo $contact['friend']; ?>"><?php echo $contact['friend']; ?></button></td>
            <td><button type="submit" name="chat" value="<?php echo $contact['conn_id']; ?>">CHAT</button></td>
          </tr>  <?php
      }
    }
    if($friends)
    {
      foreach($friends as $f)
      { ?>
        <tr>
            <td><button type="submit" name="friend" class="user" value="<?php echo $f['username']; ?>"><?php echo $f['username']; ?></button></td>
            <td><button type="submit" name="chat" value="<?php echo $f['conn_id']; ?>">CHAT</button></td>
          </tr>  <?php
      } ?>
        </table>  <?php
    }
    if($contacts==false&&$friends==false)
    { 
      echo "<br><center>No Contacts Found!</center>";
    }
    unset($_SESSION['conncon']);
  }
  elseif(isset($_SESSION['connr']))
  {
    $crs=connRequests();
    if($crs==false)
    {
      echo "<br><center>No connection request found!</center>";
      unset($_SESSION['connr']);
    }
    else
    {
      echo "<center>To confirm connection request select ACCEPT.</center><hr>";
      foreach($crs as $cr)
      { ?>
        <button type="submit" name="sendfrom" value="<?php echo $cr['sendby']; ?>" class="user"><?php echo $cr['sendby']; ?></button> has sent request to connect.<br>  <input type="hidden" name="sender" value="<?php echo $cr['sendby']; ?>">
        <button type="submit" name="ryes" value="<?php echo $cr['conn_no']; ?>" onclick="alert('Request ACCEPTED!')" class="login">ACCEPT</button>
        <button type="submit" name="rno" value="<?php echo $cr['conn_no']; ?>" onclick="alert('Request REJECTED!')" class="logout">REJECT</button>  <?php
      }
      unset($_SESSION['connr']);
    }
  }
  else
  { ?>
      <center>  
        <center><p class="focus">Write here to POST:</p><br>
        <input type="hidden" name="status" value="0">
        <textarea name="article" class="intext" cols="80" rows="4" placeholder="Write something to post!"></textarea><br>
        <input type="file" name="upfile" class="intext">
        <center><button type="submit" name="write">POST</button></center></center>
      </center>  <?php
      if(isset($_SESSION['mgs']))
      {
        echo $_SESSION['mgs'];
        unset($_SESSION['mgs']);
      }
    } ?>
    </div>
  </form>
</body>
</html>