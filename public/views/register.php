<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/styles/main.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b7c75b547d.js" crossorigin="anonymous"></script>
    <title>LOGIN</title>
</head>

<body id="login-page" class="flex-row-center-center">
    
    <div class="flex-column-center-center">
        <h1>REGISTER</h1>
        <form class="flex-column-center-center" action="register" method="post">
            <?php
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
            ?>
            <div class="form-control">
                <i class="fa-solid fa-envelope" style="color: #272b35;"></i>
                <input type="email" name="email" placeholder="email" required>
            </div>

            <div class="form-control">
                <i class="fa-solid fa-lock" style="color: #272b35;"></i>
                <input type="password" name="password" placeholder="password" required>
            </div>

            <div class="form-control">
                <i class="fa-solid fa-lock" style="color: #272b35;"></i>
                <input type="password" name="confirm_password" placeholder="confirm_password" required>
            </div>

            <button type="submit"><i class="fa-solid fa-arrow-right-to-bracket" style="color: #e5e9f0;"></i> REGISTER</button>
        </form>

    </div>


</body>
</html>