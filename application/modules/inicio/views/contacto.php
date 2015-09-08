<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <h1>¡Contactanos y cuentanos tus ideas!</h1>
            </div>
            <div class="col-sm-5">
                <ul class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Inicio</a></li>
                    <li class="active">Contacto</li>
                </ul>
            </div>
        </div>
    </div>
</section><!--/#title-->
<br/>
<!--** MENSAJE **-->
<div class="col-md-offset-1 col-lg-10">
    <?php if(!empty($mensaje)){ ?>

        <div id="<?php echo $id?>" class="alert <?php echo $clase ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $mensaje ?>
        </div>

    <?php } ?>
            <!--** FIN MENSAJES **-->
</div>
<br/>
<section id="contact-page" class="container">
    <div class="row">
        <div class="col-sm-12">
            <h4>Formulario de contacto</h4>
            <div class="status alert alert-success" style="display: none"></div>
            <form id="main-contact-form"  name="contact-form" method="post" action="<?php echo base_url(); ?>index.php/inicio/email/Envio_email" role="form">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <input type="text" name="nombre"  class="form-control" required="required" placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <input type="text" name="apellido" class="form-control" required="required" placeholder="Apellido">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" required="required" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Enviar" class="btn btn-primary btn-lg"/>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <textarea name="mensaje" id="message" required="required" class="form-control" rows="8" placeholder="Mensaje"></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section><!--/#contact-page-->

<script>
    
    $(document).ready(function() {
        if ($("div#mensaje")) {
            setTimeout(function() {
                $("div#mensaje").hide("slow");
            });
        }
    }).4000;
</script>