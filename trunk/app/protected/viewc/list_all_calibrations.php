<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include "header.php"; ?>
  </head>
    <?php include "topbar.php"; ?>
    <?php include "navbar.php"; ?>
    <h1><?php echo $data['title']; ?></h1>
  <body>
    <table border="0">
        <caption> You can change the users data.</caption>

        <thead>
        <tr>
            <th>id</th>
            <th>user id</th>
            <th>value</th>
            <th>status_id</th>
            <th>ts</th>
            <th>description</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach($data['calibrations'] as $k1=>$v1): ?>
        <tr>
            <td><a href="<?php echo $data['baseurl']; ?>index.php/admin/updateuser/id/<?php echo $v1->id; ?>" > <?php echo $v1->id; ?></a></td>
            <td> <?php echo $v1->user_id; ?>       </td>
            <td> <?php echo $v1->value; ?>         </td>
            <td> <?php echo $v1->status_id; ?>     </td>
            <td> <?php echo $v1->ts; ?>            </td>
            <td> <?php echo $v1->description; ?>   </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div><?php echo $data['pager']; ?></div>
  </body>
</html>
