<?php
    require("errors/errors.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/login.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/animate.css'); ?>">
    <title>Log in</title>
</head>
<body>
    <div class="container">
        <div class="middle">
            <div class="img">
                <h2>Vous n'avez pas encore entre vos coordonnees?</h2>
                <button class="btn"><?php echo anchor('welcome/signup','Entrer les proprietes de votre entreprise.'); ?></button>
                <?php echo anchor('Welcome/legal',"Inserer les informations legales."); ?>
            </div>
            <div class="form-container">
                <h1>Connectes toi a ton compte</h1>
                <?php echo form_open('FormControl/Check','class="form"') ?>
                    <input type="text" name="user" id="" placeholder="Username" value="<?php echo set_value('username'); ?>">
                    <input type="password" name="pass" id="" placeholder="Password">
                    <input type="submit" value="Connection">
                </form>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $errors[$_GET['error']] ?></p>
                <?php } ?>
               <?php if (validation_errors()!=" ") { ?>
                   <p class="error"><?php echo validation_errors() ?></p>
               <?php } ?> 
            </div>
        </div>   
        <?php echo anchor('welcome/pcg','PCG'); ?>    
        <?php echo anchor('welcome/journal','Journal'); ?>
        <?php echo anchor('welcome/tier','Tiers'); ?>    
        <?php echo anchor('welcome/newJournal','New Journal'); ?>
    </div>
</body>
</html>