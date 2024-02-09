<?php
function calculateTimeDifference($timestamp) 
{
  date_default_timezone_set('Asia/Dhaka');
  $postDateTime=DateTime::createFromFormat('Y-m-d H:i:s.u',$timestamp);
  $currentDateTime=new DateTime();
  $timeDifference=$currentDateTime->diff($postDateTime);
  echo "Posted ";
  if($timeDifference-> y >0)
  {
    echo $timeDifference-> y," year",($timeDifference-> y >1?"s":"")," ago";
  }
  elseif($timeDifference-> m >0)
  {
      echo $timeDifference-> m," month",($timeDifference-> m >1?"s":"")," ago";
  }
  elseif($timeDifference-> d >0)
  {
      echo $timeDifference-> d," day",($timeDifference-> d >1?"s":"")," ago";
  }
  elseif($timeDifference-> h >0)
  {
      echo $timeDifference-> h," hour",($timeDifference-> h >1?"s":"")," ago";
  }
  elseif($timeDifference-> i >0)
  {
      echo $timeDifference-> i," minute",($timeDifference-> i >1?"s":"")," ago";
  }
  else
  {
      echo "a few seconds ago";
  }
}
?>