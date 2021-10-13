<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <?php include "header.php"; ?>
  </head>
  <body>
    <?php include "topbar.php"; ?>
    <?php include "navbar.php"; ?>
    <div id="content">
    <h1>Enviar <?php echo $data['jobtype']; ?></h1>
        <h2>Parametros Obligatorios</h2>
        <form id="jobform" method="post" action="<?php echo $data['action']; ?>" enctype="multipart/form-data">

        <?php if( $data['jobtype'] == sample ): ?>
            
            <?php if( $data['calibrations'] == NULL ): ?>
            Usted <b>tiene</b> que tener un factor de calibracion, por favor envie una imagen de <a href="<?php echo $data['baseurl']; ?>index.php/jobs/calibration/submit">calibracion</a>.
            <?php else: ?>
            prueba_appconf: <?php echo $data['prueba_appconf']; ?>.
            Suba una imagen de muestra: <input id="uploadedfile" name="uploadedfile" type="file"/><br /><br />
            Escoja un miscroscopio:
            <select name="calibration_value" id="calibration_value">
                <?php foreach($data['calibrations'] as $k1=>$v1): ?>
                <option value="<?php echo $v1->value; ?>" /><?php echo $v1->description; ?> - Value: <?php echo $v1->value; ?>
                <?php endforeach; ?>
            </select>
            <input value="submit" type="submit" />
            <?php endif; ?>
        <br />
        <?php else: ?>
            Suba una imagen de calibracion: <input id="uploadedfile" name="uploadedfile" type="file"/><br /><br />
            Nombre de descripcion para el factor de calibracion: <input id="description" name="description" type="text"/><br /><br />
            <input value="submit" type="submit" />

        <?php endif; ?>
        </form>
    </div>
  </body>
</html>
