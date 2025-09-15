<?php
$target_dir = "images/";
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

?>

<script>
    let a=<?php echo $imageFileType?>
</script>