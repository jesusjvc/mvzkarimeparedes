<section id="contacto" >

        <div class="imagen">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Logo3.png" alt="Logo" width="206" height="157">
           
        </div>

        <hr>

        <div class="information-contacto">
            <div class="contain">
                <div class="grid-contacto">

                    <div class="grid-contacto-information">
                        <h1>Datos de contacto:</h1>
                        <hr>

                        <div>

                            <div class="grid-contacto-information-media-item">
                                <div class="grid-contacto-information-media-item-imagen">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/ubicacion.png" alt="Logo" width="65" height="65">
                                </div>

                                <div class="grid-contacto-information-media-item-text">
                                    <p>Calle 5 de mayo 515, Col. Campo Sotelo, Temixco, Morelos.</p>
                                </div>
                            </div>

                            <div class="grid-contacto-information-media-item">
                                <div class="grid-contacto-information-media-item-imagen">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/whatsapp.png" alt="Logo" width="65" height="65">
                                </div>

                                <div class="grid-contacto-information-media-item-text">
                                    <a href ="https://api.whatsapp.com/send/?phone=5277778740881&text=Hola%2C+quiero+informacion&type=phone_number&app_absent=0" >+52 777 787 4088</a>
                                </div>
                            </div>

                            <div class="grid-contacto-information-media-item">
                                <div class="grid-contacto-information-media-item-imagen">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/instagram.png" alt="Logo" width="65" height="65">
                                </div>

                                <div class="grid-contacto-information-media-item-text">
                                    <a href="#">mvz.karimepc</a>
                                </div>
                            </div>

                            <div class="grid-contacto-information-media-item">
                                <div class="grid-contacto-information-media-item-imagen">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/email.png" alt="Logo" width="65" height="65">
                                </div>

                                <div class="grid-contacto-information-media-item-text">
                                    <a href="mailto:karime@mvzkarimeparedes.mx">karime@mvzkarimeparedes.mx</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="grid-contacto-form">
                        <div class="contacto-formulario">
                            <h1>¡Escríbenos!</h1>
                            <p>En breve nos pondremos en contacto contigo.</p>
                            <?php echo FrmFormsController::get_form_shortcode( array( 'id' => 1 ) ); ?>
                        </div>

                    </div>


                </div>

            </div>

        </div>
      
            
        

</section>

