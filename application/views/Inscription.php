<?php
    // var_dump($titles);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Informations de base</h1>
    <p><strong>* Champ requis</strong></p>
    <?php echo form_open('FormControl/insertBase','class="form"') ?>
        <?php for ($i=0; $i < count($titles['name']); $i++) { 
            $label=$titles['name'][$i];
            if ($titles['importance'][$i]==1) {
                $label=$label."*";
            }
            ?>
            <label for=""><?php echo $label ?></label>
            <input type="text" name="<?php echo "form_".$titles['idtitles'][$i] ?>" id="">
            <br>
            <br>
        <?php } ?>
        <input type="submit" value="Inserer">   
        <p><?php echo validation_errors() ?></p>     
    </form>
</body>
</html>