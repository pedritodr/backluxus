<div class="footer-wrapper">
    <div class="footer-section f-section-1">
        <p class="">Copyright © <?= date('Y') ?> <a target="_blank" href="<?= site_url() ?>">Admin</a>, Todos los derechos reservados.</p>
    </div>
    <!--   <div class="footer-section f-section-2">
        <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg></p>
    </div> -->
</div>
</div>
<!--  END CONTENT AREA  -->


</div>
<!-- END MAIN CONTAINER -->
<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="<?= base_url() ?>admin_template/assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="<?= base_url() ?>admin_template/bootstrap/js/popper.min.js"></script>
<script src="<?= base_url() ?>admin_template/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>admin_template/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= base_url() ?>admin_template/assets/js/app.js"></script>
<script>
    $(document).ready(function() {
        App.init();
    });

    function openMenu() {
        if (!$('#compactSidebar').hasClass("left-in")) {
            $('#compactSidebar').addClass("left-in");
        } else {
            $('#compactSidebar').removeClass("left-in");
        }
    }
    var d = null;

    function show_dialog(obj, data) {
        d = data;
        $(obj).modal("show");
    }

    function item_action() {
        window.location.href = d[1] + '/' + d[0];
    }
    setTimeout(hide_dialog, 2000);

    function hide_dialog() {
        $(".alert-success").fadeOut("slow");
    }
</script>
<script src="<?= base_url() ?>admin_template/assets/js/custom.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="<?= base_url() ?>admin_template/plugins/apex/apexcharts.min.js"></script>
<script src="<?= base_url() ?>admin_template/assets/js/dashboard/dash_1.js"></script>
<script src="<?= base_url() ?>admin_template/assets/js/scrollspyNav.js"></script>
<script src="<?= base_url() ?>admin_template/plugins/apex/apexcharts.min.js"></script>
<script src="<?= base_url() ?>admin_template/plugins/apex/custom-apexcharts.js"></script>
<script src="<?= base_url() ?>admin_template/assets/js/custom.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= base_url() ?>admin_template/plugins/table/datatable/datatables.js"></script>
<script src="<?= base_url() ?>admin_template/plugins/select2/select2.min.js"></script>
<!--    <script src="<?= base_url() ?>admin_template/plugins/drag-and-drop/dragula/dragula.min.js"></script>
    <script src="<?= base_url() ?>admin_template/plugins/drag-and-drop/dragula/custom-dragula.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?= base_url() ?>admin_template/plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>admin_template/plugins/sweetalerts/custom-sweetalert.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>admin_template/assets/js/scrollspyNav.js"></script>
<script src="<?= base_url() ?>admin_template/plugins/editors/quill/quill.js"></script>
<script src="<?= base_url() ?>admin_template/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="<?= base_url() ?>admin_template/plugins/editors/markdown/simplemde.min.js"></script>
<script src="<?= base_url() ?>admin_template/plugins/blockui/jquery.blockUI.min.js"></script>
<script src="<?= base_url() ?>admin_template/plugins/blockui/custom-blockui.js"></script>

</body>

<!-- Mirrored from designreset.com/cork/ltr/demo10/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Dec 2020 17:05:36 GMT -->

</html>