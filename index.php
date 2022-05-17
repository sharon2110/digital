<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="views/css/estiloIndex.css">
    <link rel="stylesheet" href="views/css/all.css">

    <title>ASCMotorsDigital</title>
</head>

<body>
    <div class="login">
        <img class="imalogin" src="views/assets/logo.jpg">
        <p>INICIE SESIÓN</p>
        <form action="" method="POST" id="formlogin">
            <label for="usuario" class="label-usuario"><i class="fas fa-user-secret"></i> &nbsp;Usuario</label>
            <input type="text" class="input-usuario" name="usuario" pattern="[a-zA-Z0-9]{5,12}" maxlength="12" required="" id="input-usuario" autocomplete="off">

            <label for="contraseña" class="label-password"><i class="fas fa-key"></i> &nbsp;Contraseña</label>
            <input type="password" class="input-password" name="pass" pattern="[a-zA-Z0-9]{5,12}" maxlength="12" required="" id="input-password" autocomplete="off">

            <input type="submit" class="input-btn" value="INGRESAR">
        </form>
    </div>

    <script src="views/js/jquery-3.6.0.min.js"></script>
    <script src="views/js/login.js"></script>
    
   


</body>

</html>