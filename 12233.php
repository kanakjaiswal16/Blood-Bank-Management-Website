<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <div class="headline">
        <h1>Sign Up</h1>
    </div>
    <form action="index.php" method="post">
        <input type="text" name="name" id="name" placeholder="Enter your name">
    <input type="text" name="age" id="age" placeholder="Enter your age">
    <input type="text" name="weight" id="weight" placeholder="Enter your weight">
    <input type="email" name="email" id="email" placeholder="Enter your email">
    <input type="phone" name="phone" id="phone" placeholder="Enter your phone number">
    <input type="password" name="passord" id="password" placeholder="Create password">
    <input type="cpassword" name="cpassord" id="cpassword" placeholder="Confirm password">
    <button class="btn">Create</button>
    </form>
    
    <p>Already Have An Account?</p>
    <a href="login.html">Sign In</a>
    <div class="bottom">
        <h1>DONATE BLOOD</h1>
        <img src="donation.png" alt="Donate Blood">
    </div>
</div>
<script src="index.js"></script>
</body>
</html>