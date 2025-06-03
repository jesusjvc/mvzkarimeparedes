<section id="banner" class="padding">
    <div class="contain">
        <div>
            <img class="banner" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fondomvz.jpg" alt="imagen">
            <img class="banner-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Imagen.png" alt="imagen">
        </div>
    </div>
</section>
<style>
	#banner .banner{
    width: 100%;
    display: block;
    margin: auto;
}
#banner .banner-responsive{
    display: none;
}
@media(max-width:600px){
    #banner .banner{
        display: none;
    }
    #banner .banner-responsive{
        display: block;
    }
}
</style>