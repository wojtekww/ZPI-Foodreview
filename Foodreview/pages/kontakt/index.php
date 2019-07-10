<?php
	session_start();
    if ((isset($_SESSION['zalogowany'])))
	{
		require_once '../../templates/headers/header-loggedin.php';
	}else{
        require_once '../../templates/headers/header-login.php';
    }
    require_once '../../templates/htmlheads/main.php';
?>
<div class="container">
    <div class="p-2 col-lg-12 mt-5">
    <section class="mb-4">

        <h2 class="h1-responsive font-weight-bold text-center my-4">Skontaktuj się z nami</h2>
        <p class="text-center w-responsive mx-auto mb-5">Masz jakies pytania? Napisz do nas!</p>

        <div class="row">

            <div class="col-md-9 mb-md-0 mb-5">
                <form id="contact-form" name="contact-form" action="/modules/mail.php" method="POST">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <input type="text" id="name" name="name" class="form-control">
                                <label for="name" class="">Twoje imie</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <input type="text" id="email" name="email" class="form-control">
                                <label for="email" class="">Twój adres e-mail</label>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                                <input type="text" id="subject" name="subject" class="form-control">
                                <label for="subject" class="">Temat</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="md-form">
                                <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                <label for="message">Twoja wiadomość</label>
                            </div>

                        </div>
                    </div>

                </form>

                <div class="text-center text-md-left">
                    <a class="btn btn-danger" onclick="document.getElementById('contact-form').submit();">Send</a>
                </div>
                <div class="status"></div>
            </div>
            <div class="col-md-3 text-center">
                <ul class="list-unstyled mb-0">
                    <li><i class="fas fa-map-marker-alt fa-2x"></i>
                        <p>Wrocław</p>
                    </li>

                    <li><i class="fas fa-phone mt-4 fa-2x"></i>
                        <p>+ 01 234 567 89</p>
                    </li>

                    <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                        <p>kontakt@foodreview.com</p>
                    </li>
                </ul>
            </div>

        </div>

        </section>
    </div>
</div>

<?php
    require_once '../../templates/footers/footer.php';
?>