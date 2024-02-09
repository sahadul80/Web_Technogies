<?php
include '../Model/EA.php';
if(isset($_POST['home']))
{
    header('Location: ../View/EAhome.php');
}
elseif(!empty($_POST['name'])&&!empty($_POST['email'])&&!empty($_POST['phone'])&&!empty($_POST['resume']))
{
    if(isset($_POST['rr']))
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $resume=$_POST['resume'];
        $fname=$_FILES['upfile']['name'];
        $destination='../Files/'.$fname;
        $extension=pathinfo($fname,PATHINFO_EXTENSION);
        $size=$_FILES['upfile']['size'];
        $tname=$_FILES['upfile']['tmp_name'];
        if(!empty($article)&&!empty($fname))
        {
          if ($_FILES['upfile']['error'] === UPLOAD_ERR_OK)
          {
            if(!in_array($extension,['zip','pdf','png','jpg']))
            {
              $_SESSION['mgs']="<center><warning>Unsupported file!<br>Supported file-type: .zip, .pdf, .png or .jpg</warning></center>";
              header('Location:../View/EAstuindex.php');
            }
            elseif($size>1000000)
            {
              $_SESSION['mgs']="<center><warning>File is too lagre to upload!</warning></center>";
              header('Location:../View/EAstuindex.php');
            }
            else
            {
              if(move_uploaded_file($tname, $destination))
              {
                insertApplicant($name,$email,$phone,$resume);
                $_SESSION['mgs']="<center><success>Request Sent!<br>You will be notified once we procced your application.</success></center>";
                header('Location:../View/EAapply.php');
              }
              else
              {
                $_SESSION['mgs']="<center><warning>Failed to upload!</warning></center>";
                header('Location:../View/EAstuindex.php');
              }
            }
          }
          else
          {
            $_SESSION['mgs']=$_POST['upfile']." upload failed. Error code: " . $_FILES['upfile']['error'];
            header('Location:../View/EAstuindex.php');
          } 
        }
    }
}
elseif(isset($_POST['back']))
{
    header('Location: ../View/EAhome.php');
}
else
{
    header('Location: ../View/EAapply.php');
}
?>