</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<!-- Google Recaptcha -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
    var x = window.matchMedia("(max-width: 700px)");
    var xx = window.matchMedia("(min-width: 700px)");
    myFunction(x) // Call listener function at run time
    x.addListener(myFunction)
    $(".container").toggleClass("pr-3 pl-3");
    $("#padi").toggleClass("pt-5 pb-5 p-3");

    function myFunction(x) {
        if (x.matches) { // If media query matches
            $(".container").toggleClass("pr-3 pl-3");
            $("#padi").toggleClass("pt-5 pb-5 p-3");
        }
    };

    function myFunction(x) {
        if (xx.matches) { // If media query matches
            $(".container").toggleClass("");
            $("#padi").toggleClass("p-5");
        }
    };

    $('.se-pre-con').fadeOut('slow');
</script>
</body>

</html>