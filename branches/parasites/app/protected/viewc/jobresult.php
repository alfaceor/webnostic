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
        <caption><h2>Data general</h2></caption>
        <thead>
            <tr>
                <th>id</th>
                <th>user_id</th>
                <th>calibration_value</th>
                <th>status_id</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $data['id']; ?>               </td>
                <td><?php echo $data['user_id']; ?>          </td>
                <td><?php echo $data['calibration_value']; ?></td>
                <td><?php echo $data['status_id']; ?>        </td>
            </tr>
        </tbody>
    </table>

    <table border="0">
        <caption><h3>Trichuris</h3></caption>
        <thead>
            <tr>
                <th>result</th>
                <th>score</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $data['trichu_result']; ?>           </td>
                <td><?php echo $data['trichu_score']; ?>            </td>
            </tr>
        </tbody>
    </table>

    <table border="0">
        <caption><h3>Diphy</h3></caption>
        <thead>
            <tr>
                <th>resultado</th>
                <th>score</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $data['diphy_result']; ?>           </td>
                <td><?php echo $data['diphy_score']; ?>            </td>
            </tr>
        </tbody>
    </table>

    <table border="0">
        <caption><h3>Fasciola</h3></caption>
        <thead>
            <tr>
                <th>resultado</th>
                <th>score</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $data['fascio_result']; ?>           </td>
                <td><?php echo $data['fascio_score']; ?>            </td>
            </tr>
        </tbody>
    </table>

    <table border="0">
        <caption><h3>Taenia</h3></caption>
        <thead>
            <tr>
                <th>resultado</th>
                <th>score</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $data['taenia_result']; ?>           </td>
                <td><?php echo $data['taenia_score']; ?>            </td>
            </tr>
        </tbody>
    </table>

    </div>

    <div id="image_portrait">
        <img src="<?php echo $data['image_url']; ?>" ></img>
    </div>

  </body>
</html>
