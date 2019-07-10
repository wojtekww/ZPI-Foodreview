<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
    <h4 class="card-title mt-3 text-center">Utwórz konto</h4>
	<form action="/modules/create_user.php" method="post">
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input type="text" id="inputfirstName" name="firstName" class="form-control" placeholder="Imię" value="<?php $firstNameInput = isset($_SESSION['firstName']) ? $_SESSION['firstName'] : ''; echo  $firstNameInput; ?>" required autofocus>
        </div> <!-- form-group// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input type="text" id="inputlastName" name="lastName" class="form-control" placeholder="Nazwisko" value ="<?php $lastNameInput = isset($_SESSION['lastName']) ? $_SESSION['lastName'] : ''; echo  $lastNameInput; ?>"required>
        </div> <!-- form-group// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input type="text" id="inputlastName" name="login" class="form-control" placeholder="Login" value =""required>
        </div> <!-- form-group// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
            </div>
            <input name="email" id="inputEmail" class="form-control" placeholder="Adres e-mail" type="email" value ="<?php $emailNameInput = isset($_SESSION['email']) ? $_SESSION['email'] : ''; echo  $emailNameInput; ?>"required>
        </div> <!-- form-group// -->
        <!-- php unseting session values-->
        <?php unset($_SESSION['firstName']); unset($_SESSION['lastName']); unset($_SESSION['email']);?>
        <!-- php unseting session values-->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Podaj hasło" required>
        </div>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input type="password" name="repeatPassword" id="inputRepeatPassword" class="form-control" placeholder="Powtórz hasło" required>
        </div> 
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <div class="form-group mb-0">
            <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI" data-callback="captcha_onclick"></div>
            <input type="text" name="recaptcha" value="" id="recaptchaValidator" pattern="1" data-error="Sorry, no robots!" style="visibility: hidden; height: 1px;" required>
            <script>
                function captcha_onclick() {
                    $('#recaptchaValidator').val(1);
                    $('#register-form').validator('validate');
                }   
            </script>
        </div>                                     
        <div class="form-group">
            <button type="submit" class="btn btn-danger btn-block"> Utwórz konto </button>
        </div>   
        <p class="text-danger"><?php 
            if(isset($_SESSION['dubelLogin'])){
                echo "Użytkownik o podanym loginie już istnieje!";
                unset($_SESSION['dubelLogin']);
            }
            if(isset($_SESSION['dubelMail'])){
                echo "Użytkownik o podanym mailu już istnieje!";
                unset($_SESSION['dubelMail']);
            }
            if(isset($_SESSION['passErr'])){
                echo "Hasła nie mogą być różne!";
                unset($_SESSION['passErr']);
            }
        ?></p>
        <p class="text-success">
            <?php
                if(isset($_SESSION['poprawnieDodany'])){
                    echo "Użytkownik pomyślnie dodany! Musisz potwierdzić swoją tożsamość klikając w link, który wysłaliśmy ci na adres mailowy.";
                    unset($_SESSION['poprawnieDodany']);
                }
            ?>
        </p>
        <p class="text-center">Masz już konto? <a class = "text-danger" href="/pages/zaloguj/index.php">Zaloguj się</a> </p>                                                                 
    </form>
</article>
</div> 