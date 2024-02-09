<!DOCTYPE html>
<html>
<head>
    <title>Apply: EA</title>
    <link rel="stylesheet" href="CSS/EAstyles.css">
    <script defer src="JS/EAscript.js"></script>
    <script>
        function applyAlert()
        {
            var name = document.getElementById('an').value;
            var email = document.getElementById('ae').value;
            var phone = document.getElementById('ap').value;
            var resume = document.getElementById('ar').value;

            if(name==''||email==''||phone==''||resume=='')
            {
                alert('Please fill all the field then submit');
            }
            else
            {
                document.getElementById('h2').innerHTML="Processing...";
            }
        }
    </script>
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
    <form method="post" action="../Controllers/EAiapply.php">
        <button type="submit" name="home" class="homebutton">EDUCATION ASSISTANT</button><br>
        <div class="feed">
        <center><h2 id="h2" class="focus">Peer Review: Apply Here!</h2>
        <table border="0">
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" id="an" class="intext"></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" id="ae" class="intext"></td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td><input type="text" name="phone" id="ap" class="intext"></td>
            </tr>
            <tr>
                <td>Resume:</td>
                <td><input type="file" name="resume" id="ar" class="intext"></td>
            </tr>
                <td colspan="2">
                    <center><button type="submit" name="rr" onclick="applyAlert()">SUBMIT</button></center>
                </td>
            </tr>
        </table>
        <button type="submit" name="back" class="back-button">BACK</button>
    </center>
    </div>
    </form>
</html>