<?include("userMenu.php");?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
            $(document).ready(function () {
                $("#launchTraining").click(function () {
                    window.location = "userModules.php";
                });
            });


</script>
<head>
<body>
<h1>Instructions</h1>
<ul style="font-size:16px">
    <li>
        Please update the flash player of the browser before starting the training.
    </li>
    <li>
        This training will take 1hour 45 mins to complete, if you leave the training midway you may have to complete the training again, so slot your time for uninterrupted completion of this training.
    </li>
    <li>
        If your internet connection is slow, you may face some delays in loading of screens in that case be patient .Faster 1 mbps connection or more is advised for better experience.
    </li>
    <li>
        There is assessment throughout the training, you will get a cumulative score in the end, and this score is also getting tracked, so pay attention and participate wholeheartedly in this training.
    </li>
    <li>
        You can also raise a ticket on this URL to report any problems you may face during the training delivery. our support teams will get back to you with solutions.
    </li>
</ul>
  <div class="col-sm-offset-0 col-sm-12" style="margin-top:30px;">
      <button type="button" id="launchTraining" class="btn btn-primary btn-lg">Launch APO Training</button>
  </div>
</body>
</html>