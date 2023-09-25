<!DOCTYPE html>
<html>
<head>

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>

function mouseUp() {
    // var code=document.getElementById("myP").value;
    window.location.href = `/cancel-otp`;
}
</script>
<body>
   
    <form action="/verify-otp" method="post" >
    @csrf
        <input type="text" name="otp"  />
        <button type="submit" >Verifiy</button>
       
    </form>
    <button  onclick="mouseUp()">Cancel</button>
    <button><a href="/send-otp">Send OTP</a></button>
</body>

</html>