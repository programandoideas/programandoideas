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
    <?php if(!empty($data['mensaje'])){ ?>

        <div id="<?php echo $data['id']?>" class="alert <?php echo $data['clase'] ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $data['mensaje'] ?>
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
            <form id="main-contact-form"  name="contact-form" method="post" action="<?php echo base_url(); ?>index.php/email/Envio_email" role="form">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <input type="text" name="nombre" id="nombre" tabindex="1" class="form-control" required="required" placeholder="Nombre" value="<?php echo set_value('nombre');?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="apellido" tabindex="2" class="form-control" required="required" placeholder="Apellido" value="<?php echo set_value('apellido');?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" tabindex="3" class="form-control" required="required" placeholder="Email" value="<?php echo set_value('email');?>">
                        </div>
                        <div class="form-group">
                            <table class="form-group">
                                <tr>
                                    <td><input type="text" name="captcha" tabindex="5" class="form-control" required="required" placeholder="Captcha"></td>
                                    <td><span><?php echo $captcha['image']; ?></span></td>
                            </table>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Enviar" tabindex="6" class="btn btn-primary btn-lg"/>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <textarea name="mensaje" tabindex="4" id="message" required="required" class="form-control" rows="8" placeholder="Mensaje"><?php echo set_value('mensaje');?></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section><!--/#contact-page-->

<script>
    document.getElementById('nombre').focus();
    
    $(document).ready(function() {
        if ($("#mensaje")) {
            setTimeout(function() {
                $("#mensaje").hide(1500);
            },4000);
        }
    });
</script>