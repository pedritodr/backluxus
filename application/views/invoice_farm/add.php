<link rel="stylesheet" type="text/css" href="<?= base_url() ?>admin_template/plugins/jquery-step/jquery.steps.css">
<link href="<?= base_url() ?>admin_template/assets/css/elements/search.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>admin_template/assets/css/apps/invoice.css" rel="stylesheet" type="text/css" />

<div class="main-container" id="container">

    <div class="layout-px-spacing" style="width:100%">
        <h3>
            <?= translate('manage_bouquets_lang') ?> | <a href="<?= site_url('bouquet/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>

        <div class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4><?= translate('add_invoice_farm_lang') ?></h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
             <div id="circle-basic" class="">
                        <h3>Paso 1</h3>
                        <section>
                            <p>Try the keyboard navigation by clicking arrow left or right!</p>
                        </section>
                        <h3>Paso 2</h3>
                        <section>
                            <p>Wonderful transition effects.</p>
                        </section>
                        <h3>Paso 3</h3>
                        <section>
                            <p>The next and previous buttons help you to navigate through your content.</p>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.row -->
</div><!-- /.content-wrapper -->
<script src="<?= base_url() ?>admin_template/plugins/jquery-step/jquery.steps.min.js"></script>

<script>
var is_async_step = false;
$("#circle-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
        autoFocus: true,
        cssClass: 'circle wizard',
        labels: {
            current: "Paso actual:",
            pagination: "Paginación",
            finish: "Finalizar",
            next: "Siguiente",
            previous: "Anterior",
            loading: "Cargando..."
        },
        enableAllSteps: true,
        enableFinishButton: false,
    onStepChanging: function (event, currentIndex, newIndex){
        if (is_async_step) {
            is_async_step = false;
            //ALLOW NEXT STEP
            return true;
        }
        if(currentIndex==0){
           //do your stuff
            is_async_step = true;
            $("#circle-basic").steps("next");
        }
    }
});

/*     $("#circle-basic").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        autoFocus: true,
        cssClass: 'circle wizard',
        labels: {
            current: "Paso actual:",
            pagination: "Paginación",
            finish: "Finalizar",
            next: "Siguiente",
            previous: "Anterior",
            loading: "Cargando..."
        },
        enableAllSteps: true,
        enableFinishButton: false,
        	onInit: function(event, currentIndex) {

        	},
       onStepChanging: function(event, currentIndex, newIndex) {

         if (currentIndex == 0) {
                          $('#circle-basic-h-0').removeClass('current');
                          $('.disabled ').removeClass('disabled ').addClass('current').prop('aria-selected','true');
                          $('.first').removeClass('current').addClass('done').prop('aria-selected','false');
                          $('#circle-basic-p-0').removeClass('current').prop('aria-hidden', false).hide();
                          $('#circle-basic-h-1').addClass('current');
                          $('#circle-basic-p-1').addClass('current').prop('aria-hidden', true).show();


        }}
    }); */
</script>