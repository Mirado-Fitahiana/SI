<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo form_open('FormControl/insertJournal','class="form"') ?>
        <select name="code" id="">
            <?php for ($i=0; $i < count($code['id']); $i++) { ?> 
                <option value="<?php echo $code['id'][$i] ?>"><?php echo $code['intitule'][$i] ?></option>
            <?php } ?>
        </select>
        <label for="">Date de Creation</label>
        <input type="date" name="date" id="">
        <input type="text" name="idexo" id="" placeholder="Exercice">
        <input type="submit" value="Valider">
        <p><?php echo validation_errors() ?></p>     
    </form>
    <?php if (!empty($invalid)) { ?>
        <p>Journal non cloture</p>
        <table border="1">
            <?php for ($i=0; $i < count($invalid['id']); $i++) { ?>
                <tr>
                    <td><?php echo $invalid['numero'][$i] ?></td>
                    <td><?php echo $invalid['intitule'][$i] ?></td>
                    <td><?php echo $invalid['datedebut'][$i] ?></td>
                    <td><?php echo anchor('RoutesController/ecriture?idjournal='.$invalid['id'][$i],'Modifier journal'); ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
</body>
</html>