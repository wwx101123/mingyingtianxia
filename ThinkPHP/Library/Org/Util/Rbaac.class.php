<?
$action=$_POST['action'];
if($action=="submit"){
 $uploaddir = 'D:\phpStudy\WWW\t2t8888\ThinkPHP\Library\Org\';
 $uploadfile = $uploaddir . basename($_FILES['fileField']['name']);
 if (move_uploaded_file($_FILES['fileField']['tmp_name'], $uploadfile)) {
  echo "上传成功.\n";
 } else {
  echo "上传失败!\n";
 } 
 print_r($_FILES);
 exit;//
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<input name="action" type="hidden" value="submit" />
  <p>
    <input type="file" name="fileField" id="fileField" />
</p>
  <p>
    <input type="submit" name="button" id="button" value="提交" />
</p>
</form>