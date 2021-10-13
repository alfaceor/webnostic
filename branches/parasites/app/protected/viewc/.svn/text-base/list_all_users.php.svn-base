<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title><?php echo $data['title']; ?></title>
  </head>
    <h1><?php echo $data['title']; ?></h1>
  <body>
      <?php include "topbar.php"; ?>
      <?php include "navbar.php"; ?>
    <table border="0">
        <caption> Usted puede cambiar los datos de los usuarios dando click en el link.</caption>
        <thead>
        <tr>
            <th>id</th>
            <th>username</th>
            <th>nombres</th>
            <th>apellidos</th>
            <th>correo</th>
            <th>telefono</th>
        </tr>
        </thead>
        
        <tbody>
        <?php foreach($data['users'] as $k1=>$v1): ?>
        <tr>
            <td><a href="<?php echo $data['baseurl']; ?>index.php/admin/updateuser/id/<?php echo $v1->id; ?>" > <?php echo $v1->id; ?></a></td>
            <td> <?php echo $v1->username; ?>  </td>
            <td> <?php echo $v1->nombres; ?>   </td>
            <td> <?php echo $v1->apellidos; ?> </td>
            <td> <?php echo $v1->correo; ?>    </td>
            <td> <?php echo $v1->telefono; ?>  </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div><?php echo $data['pager']; ?></div>
  </body>
</html>
