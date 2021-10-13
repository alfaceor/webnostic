<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "header.php"; ?>
<script src="<?php echo $data['baseurl']; ?>global/js/plupload.full.js"></script>
</head>
<body>


<div data-role="page" class="ui-responsive-panel">
    <div data-role="header" data-theme="b" data-position="fixed">
       
        <a href="#nav-panel" data-icon="bars">MENU / <?php echo $data['title']; ?></a>
        
       <h1><?php echo $data['disease']." (<i>".$data['user']['nombres']." ".$data['user']['apellidos']."</i>)"; ?></h1>
        
        <a href="#" data-rel="back" data-icon="back" data-iconpos="notext">Regresar</a>   
        
     </div><!-- /header -->
    
    <div data-role="content" class="jqm-content">
    
        
        <form id="jobform" method="post" action="<?php echo $data['action']; ?>" enctype="multipart/form-data" data-ajax="false">

        <?php if( $data['jobtype'] == sample ): ?>
            
            <?php if( $data['calibrations'] == NULL and $data['disease']<>"MELANOMA" ): ?>
            Antes de subir una muestra, primero debe <a href="<?php echo $data['baseurl']; ?>index.php/jobs/calibration/submit">Agregar una calibración</a>
            <?php else: ?>
            
            <?php if ($data['disease']<>"MELANOMA" ) { ?>
            <label for="calibration_value" class="select">Seleccione el Microscopio:</label>
            <select name="calibration_value" id="calibration_value" data-native-menu="false" data-mini="true">
                <?php foreach($data['calibrations'] as $k1=>$v1): ?>
                <option value="<?php echo $v1->value."|".$v1->description; ?>" /><?php echo $v1->description; ?> - Value: <?php echo $v1->value; ?>
                <?php endforeach; ?>
            </select>
            <?php } else { ?>
            <input name="calibration_value" id="calibration_value" type="hidden" value="0|-">
            <?php } ?>
            
            <ul data-role="listview" data-inset="true">
    		<li data-role="list-divider">Subir un <?php echo $data['jobtype']; ?> (Imágen)</li>
   			<li>
    		<input id="uploadedfile0" name="uploadedfile0" type="file" accept="image/jpeg"/>

            <div id="uploader">
                <div id="filelist"> </div>
               
                <a id="pickfiles" href="javascript:;">Add Files</a>
                <a id="uploadfiles" href="javascript:;">Start Upload</a> 
            
            </div>
            
            <script type="text/javascript">
            //<![CDATA[
            
                var uploader = new plupload.Uploader({
                    runtimes: 'html5',
                    max_file_size : '1mb',
                    browse_button: 'pickfiles',
                    url: 'http://localhost:8888/plupload/examples/upload.php',
                    //resize : {width : 320, height : 240, quality : 90},
                    filters : [
                        {title : "Imáges en jpg", extensions : "jpg,jpeg"}//,
                        //{title : "Zip files", extensions : "zip"}
                    ]
                });
                
                uploader.init();
            
               uploader.bind('FilesAdded', function(up, files) {
                    // loop through the files array
                    for (var i in files) {
                        document.getElementById('filelist').innerHTML += '<div id="' + files[i].id + '">' + files[i].name + ' (' + plupload.formatSize(files[i].size) + ') <b></b></div>';
                    }
                });
                
                uploader.bind('UploadProgress', function(up, file) {
                    document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                });
                
                uploader.bind('Error', function(up, args) {
                    alert(args.code + ': ' + args.message);
                });
                
                document.getElementById('uploadfiles').onclick = function() {
                    uploader.start();
                };
            
            //]]>
            </script>
            
            <?php endif; ?>
        <br />
        <?php else: ?>
            <label for="uploadedfile">Subir una <?php echo $data['jobtype']; ?> (Imágen)</label>
            <input id="uploadedfile" name="uploadedfile" type="file" accept="image/jpeg"/>
            <label for="description">Nombre del Microscopio</label>
            <input id="description" name="description" type="text" data-clear-btn="true" />
        <?php endif; ?>
       </li>
       </ul>
       
        <input value="Enviar" type="submit" data-icon="check" data-iconpos="left" data-mini="true" data-theme="e" data-inline="true" />
        </form>
    </div><!-- /content -->
    <div data-role="footer" data-position="fixed" data-theme="b">
        
    </div><!-- /footer -->
    <div data-role="panel" data-position-fixed="true" data-theme="e" id="nav-panel">
        <ul data-role="listview" data-inset="true">

          <?php include "navbar.php"; ?>
            
        </ul>
    </div><!-- /panel -->
    <div data-role="panel" data-position="right" data-position-fixed="true" data-display="overlay" data-theme="b" id="add-form">
         <?php include "topbar.php"; ?>
    </div><!-- /panel -->
</div>
</body>
</html>
