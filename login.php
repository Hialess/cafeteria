<?php
    session_start();
    include "conexion.php";

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        $res = mysqli_query($conn, $sql);

        if($res && mysqli_num_rows($res)>0){
            $row = mysqli_fetch_assoc($res);
            $password = $row['password'];
            $decrypt = password_verify($pass, $password);
            if($decrypt){
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                header("location: perfil.php");
                exit;
            }else{
                echo"<div class='mensaje'>
                <p>Contraseña es incorrecta</p></div><br>";
                echo"<a href='login.php'><button class='btn'>Regresar<button></a>";
            }
        }else{
            echo"<div class='mensaje'><p>Email o la contraseña son incorrectos</p></div><br>";
            echo"<a href='login.php'><button class='btn'>Regresar</button></a>";
        }
    }else{
?>
<header>Login</header>
<form action="#" method="POST">
    <div class="form-box">
        <div class="input-container">
            <input class="input-field" type="email" placeholder="correo electronico" name="email"></div>
        <div class="input-container">
            <input class="input-field" type="password" placeholder="Contraseña" name="password"></div>
        <div class="recordar">
            <input type="checkbox" class="check" name="recordar">
            <label for="recordar">Recuerdame</label><span><br><a href="reestablecer.php">Recuperar contraseña</a></span>
        </div>
</div>
<input type="submit" name="login" id="submit" value="Login" class="button">
<div class="links">¿No tienes cuenta?<a href="registrarse.php">Registrarse</a>
</div>         
</form>

<?php
}
?>