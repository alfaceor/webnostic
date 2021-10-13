<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <?php include "header.php"; ?>
  </head>
  <body>
    <?php include "topbar.php"; ?>
    <?php include "navbar.php"; ?>
    <div id="content">
    <h1>Submit <?php echo $data['jobtype']; ?></h1>
        <h2>Mandatory parameters</h2>
        <form id="jobform" method="post" action="<?php echo $data['action']; ?>" enctype="multipart/form-data">

        <?php if( $data['jobtype'] == sample ): ?>
            
            <?php if( $data['calibrations'] == NULL ): ?>
            You <b>must</b> have a calibration value, please submit a <a href="<?php echo $data['baseurl']; ?>index.php/jobs/calibration/submit">calibration</a>  image.
            <?php else: ?>
            Upload a <?php echo $data['jobtype']; ?> image: <input id="uploadedfile" name="uploadedfile" type="file"/><br /><br />
            Choose a microscope:
            <select name="calibration_value" id="calibration_value">
                <?php foreach($data['calibrations'] as $k1=>$v1): ?>
                <option value="<?php echo $v1->value; ?>" /><?php echo $v1->description; ?> - Value: <?php echo $v1->value; ?>
                <?php endforeach; ?>
            </select>
            <input value="submit" type="submit" />
            <?php endif; ?>
        <br />
        <?php else: ?>
            Upload a <?php echo $data['jobtype']; ?> image: <input id="uploadedfile" name="uploadedfile" type="file"/><br /><br />
            Description name for the calibration factor: <input id="description" name="description" type="text"/><br /><br />
            <input value="submit" type="submit" />

        <?php endif; ?>
        </form>
    </div>
  </body>
</html>
