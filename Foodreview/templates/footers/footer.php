<footer class="pt-4 my-md-5 pt-md-5 border-top container">
    <div class="row">
        <div class="col-12 col-md">
            <small class="d-block mb-3 text-muted">&copy; FoodReview</small>
        </div>
        <div class="col-6 col-md">
            <h5>O nas</h5>
            <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="/pages/info/index.php">O stronie</a></li>
            <li><a class="text-muted" href="#">Oferta</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>Działania</h5>
            <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="/pages/zaloguj/index.php">Zarejestruj się</a></li>
            <li><a class="text-muted" href="/pages/zaloguj/index.php">Zaloguj się</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>Dowiedz się więcej</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="/pages/regulamin/index.php">Regulamin</a></li>
                <li><a class="text-muted" href="/pages/kontakt/index.php">Kontakt</a></li>
            </ul>
        </div>
    </div>
</footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        // Initialize and add the map
        function initMap() {
        // The location of Uluru
        var uluru = {lat: -25.344, lng: 131.036};
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 4, center: uluru});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: uluru, map: map});
        }
            </script>
        <script async defer
        src="">
        </script>
        <script>

    $('.hamburger').on('click', function(e) {
      $('.belt').toggleClass("hvisible");
      $('.mobile-menu').toggleClass("vis");
      e.preventDefault();
    });

        </script>
         <script>

$('.arrow-down').on('click', function(e) {
  $(this).toggleClass("rot");
  $(this).parents('div').next('.rev-bod').toggleClass("rot-b");
  $(this).parent().find('.stars-top').toggleClass("d-none");
  e.preventDefault();
});

    </script>
        <script>
            $(window).scroll(function() {    
            var scroll = $(window).scrollTop();
            //console.log(scroll);
            if (scroll >= 100) {
                //console.log('a');
                $(".logo-top").addClass("scrolled");
                $(".logo-bot").addClass("scrolled");
                $(".unscroll").addClass("usc");
            } else {
                //console.log('a');
                $(".logo-top").removeClass("scrolled");
                $(".logo-bot").removeClass("scrolled");
                $(".unscroll").removeClass("usc");
            }
        });
        </script>

</body>
</html>