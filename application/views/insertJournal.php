<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal</title>
</head>
<body>
<?php echo form_open('FormControl/journal','class="form"') ?>
        <label for="numero">Numero</label>
        <input type="text" name="numero" value="<?php echo set_value('numero'); ?>" id="" >
        <label for="nom">Intitule</label>
        <input type="text" name="nom" id="" value="<?php echo set_value('nom'); ?>">
        <input type="submit" value="Valider">
    </form>

    <p><?php echo validation_errors(); ?></p>
</body>
</html>