<form id ="register-form" class="form-signin" action="/modules/part-register.php" method="post" data-toggle="validator" role="form">
<div class ="col-14">
    <h1 class="h3 mb-3 font-weight-normal">Jeżeli nie masz jeszcze konta, zarejestruj się!</h1>
    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input type="text" id="inputfirstName" name="firstName" class="form-control" placeholder="Imię" required autofocus>
    </div>
    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input type="text" name="lastName" id="inputlastName" class="form-control" placeholder="Nazwisko" required>
    </div>
    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Adres e-mail" required>
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
    <div class="form-group mt-0">
        <button class="mt-2 btn btn-lg btn-danger btn-block" id="submitBtn" type="submit">Zarejestruj się</button>
    </div>
</div>
</form>