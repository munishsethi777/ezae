<?include("userMenu.php");
    $moduleSeq = $_POST['moduleSeq'];
    $companySeq = $_POST['companySeq'];
    $compModStr = $companySeq."/".$moduleSeq;
    $userSeq = $session->getUserLoggedInSeq();
?>
<!DOCTYPE html>
<html>
<head>
<script>
	var userSeq = <?echo $userSeq;?>;
</script>
<head>
<body>
    <center>
    If you see any error message after pressing submit button, please take the screenshot of this page and send it to the administrator.
    
        <iframe frameborder="0" src="Modules/<?echo $compModStr;?>/story.php" width="1000" height="670"></iframe>
    </center>
</body>
</html>