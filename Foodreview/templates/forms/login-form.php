<form class="form-signin" action="/modules/login.php" method="post">
<div class ="col-14">
    <h1 class="h3 mb-3 font-weight-normal">Zaloguj się</h1>
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
        </div>
        <input type="text" id="inputLogin" name="login" class="form-control" placeholder="Login" required autofocus>
    </div>
    <div class="form-group input-group" >
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
        </div>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Hasło" required>
    </div>
    <!--<input type="text" id="inputLogin" name="login" class="form-control" placeholder="Login" required autofocus>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Hasło" required>-->
    <div class="form-check input-group mb-3 ">
        <input type="checkbox" class="form-check-input" id="rememberMeCheck" name="rememberMe" value="1">
        <label class="form-check-label" for="rememberMe">Zapamiętaj mnie</label>
    </div>
    <div class="form-group">
        <button class="btn btn-lg btn-danger btn-block" type="submit">Zaloguj się</button>
    </div>   
</div>


    
    
    <?php
        if(isset($_SESSION['loginer'])){
            echo "Niepoprawny login lub haslo.";
            unset($_SESSION['loginer']);
        }
        if(isset($_SESSION['emptyfields'])){
            echo "Login i hasło nie mogą być puste!";
            unset($_SESSION['emptyfields']);
        }
    ?>
</form>