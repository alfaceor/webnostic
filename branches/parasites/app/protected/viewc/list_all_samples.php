<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include "header.php"; ?>
  </head>
    
  <body>
    <?php include "topbar.php"; ?>
    <?php include "navbar.php"; ?>
    <h1><?php echo $data['title']; ?></h1>
    <table border="0">
        <thead>
        <tr>
            <th>id</th>
            <th>user_id</th>
            <th>calibration_value</th>
            <th>status_id</th>
            <th>trichu_result</th>
            <th>trichu_score</th>
            <th>diphy_result</th>
            <th>diphy_score</th>
            <th>fascio_result</th>
            <th>fascio_score</th>
            <th>taenia_result</th>
            <th>taenia_score</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach($data['samples'] as $k1=>$v1): ?>
        <tr>
            <td><a href="<?php echo $data['baseurl']; ?>index.php/jobs/sample/<?php echo $v1->id; ?>" > <?php echo $v1->id; ?></a></td>
            <td> <?php echo $v1->user_id; ?>            </td>
            <td> <?php echo $v1->calibration_value; ?>  </td>
            <td> <?php echo $v1->status_id; ?>          </td>
            <td> <?php echo $v1->trichu_result; ?>      </td>
            <td> <?php echo $v1->trichu_score; ?>       </td>
            <td> <?php echo $v1->diphy_result; ?>       </td>
            <td> <?php echo $v1->diphy_score; ?>        </td>
            <td> <?php echo $v1->fascio_result; ?>      </td>
            <td> <?php echo $v1->fascio_score; ?>       </td>
            <td> <?php echo $v1->taenia_result; ?>      </td>
            <td> <?php echo $v1->taenia_score; ?>       </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div><?php echo $data['pager']; ?></div>
  </body>
</html>
