<section id="content">
    <div class="container">
        <div class="content-pages">
            <div class="about-intro text-center">
                <h2 class="title30 text-center">Contacto</h2>
                <p class="desc">Ranic está aquí para brindarle más información, responder cualquier pregunta que pueda tener con respecto a nuestros implementos deportivos.</p>
            </div>
            <!-- End Intro -->

            <!-- End Contact Map -->
            <div class="choise-faq">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="contact-form">
                            <h2 class="title18">Contacto</h2>
                            <?= get_message_from_operation(); ?>
                            <form action="<?= site_url('front/contacto_mensaje'); ?>" method="post">
                                <div class="input-box">
                                    <label>Nombres <sup>*</sup></label>
                                    <input name="name" required placeholder="Nombres" type="text">
                                </div>
                                <div class="input-box">
                                    <label>E-mail <sup>*</sup></label>
                                    <input name="email" required placeholder="E-mail" type="text">
                                </div>
                                <div class="input-box">
                                    <label>Teléfono</label>
                                    <input name="phone" required placeholder="Teléfono" type="text">
                                </div>
                                <div class="input-box">
                                    <label>Mensaje <sup>*</sup></label>
                                    <textarea name="mensaje" required cols="10" rows="5"></textarea>
                                </div>
                                <div class="buttons-set">
                                    <button id="btn_enviar_mensaje" type="submit" title="Submit" class="shop-button">Enviar mensaje</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.797637303341!2d-78.50933978590368!3d-0.18448813546696458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91d59a585cfc518f%3A0xe5d48e74227ff2c4!2sJuan%20Acevedo%2C%20Quito%20170129!5e0!3m2!1ses-419!2sec!4v1593997273998!5m2!1ses-419!2sec" width="800" height="500" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <!-- End Choise -->
        </div>
    </div>
</section>
<script>
    $('#btn_enviar_mensaje').click(function() {
        $('#btn_enviar_mensaje').prop("disabled", true);
    });
</script>