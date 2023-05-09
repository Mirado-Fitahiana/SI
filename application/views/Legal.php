<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php echo form_open('FormControl/insertLegal','class="form"') ?>
        <?php for ($i=0; $i < count($legal['idinfo']); $i++) { ?>
            <label for=""><?php echo $legal['intitule'][$i] ?></label>
            <input type="text" name="<?php echo "legal_".$legal['idinfo'][$i] ?>" id="">
            <br>
            <br>
        <?php } ?>
        <input type="submit" value="Inserer">   
        <p><?php echo validation_errors() ?></p>     
    </form>
</body>
</html>