<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
      <?php include "header.php"; ?>
  </head>
  <body>
      <?php include "topbar.php"; ?>
      <?php include "navbar.php"; ?>
    <div id="result_table">
    Data Table
    <table border="0">
        <thead>
            <tr>
                <th>id</th>
                <th>user_id</th>
                <th>result</th>
                <th>score</th>
                <th>calibration_value</th>
                <th>status_id</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $data['id']; ?>               </td>
                <td><?php echo $data['user_id']; ?>          </td>
                <td><?php echo $data['result']; ?>           </td>
                <td><?php echo $data['score']; ?>            </td>
                <td><?php echo $data['calibration_value']; ?></td>
                <td><?php echo $data['status_id']; ?>        </td>
            </tr>
        </tbody>
    </table>
    </div>

    <div id="image_portrait">
        <img src="<?php echo $data['image_url']; ?>" ></img>
    </div>

  </body>
</html>
