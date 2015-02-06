<?php $this->load->view(ADMIN_HEADER) ?>
<html>  
<head>  
</head>  
<body>  
  <?php      echo form_open_multipart('import_file/read_file');
			 echo form_fieldset('IMPORT FILE MASTER BUDGET'); ?>   
  <table>  
    <tr>    
      <td>Upload file (*.xls) : </td>    
      <td><input name="userfile" type="file"></td>  
      <td><input name="upload" type="submit" value="import"></td>  
    </tr>  
  </table>  
  <?php echo form_fieldset_close();  
        echo form_close();?>  
</body>  
</html> 
<?$this->load->view(ADMIN_FOOTER)?>
