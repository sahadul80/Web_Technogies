function about() 
{
    document.getElementById('aboutea').innerHTML = "As a non-profitable organization, EA should create the scope for the students and provide free education to the poor to develop better careers. After proper implementations, the researcher can also spend their quality time on this platform to explore and publish their articles easily. These students and research works can be contributed as an asset for development. Hence, the education sector of our country might get strong enough to mitigate any crisis effectively and improvise global contribution.";
}

function contact() 
{
    document.getElementById('aboutea').innerHTML = "For any emergency query, contact us:<br>Phone: <ins>+8801866820045</ins><br><br>Or Click <a href='mailto:sahadul80@gmail.com'>HERE</a> to send email.";
}

function loginAlert()
{
    var username = document.getElementById('un').value;
    var password = document.getElementById('p').value;

    if(username==''&&password!='')
    {
        alert('Missing USERNAME!');
    }
    else if(username!=''&&password=='')
    {
        alert('Missing PASSWORD!');
    }
    else if(username==''&&password=='')
    {
        alert('Missing USERNAME and PASSWORD!');
    }
    else
    {
        alert('Missing USERNAME and PASSWORD!');
    }
}

function goBack()
{
    window.history.back();
}

function customConfirm(message)
{
    return window.confirm(message);
}
