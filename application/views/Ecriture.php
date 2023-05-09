<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script src="<?php echo base_url('assets/js/ecriture.js') ?>"></script>
    <h1>Insertion ecriture</h1>
    <form action="<?php echo base_url('FormControl/insertEcriture') ?>" id="form">
        <input type="hidden" name="idjournal" value="<?php echo $_GET['idjournal'] ?>">
        <label for="">Code journal</label>
        <input type="text" name="codejournal" id="code" value="<?php echo $journal[0]['numero']; ?>" disabled>
        <label for="piece">Reference Piece</label>
        <select name="piece" id="ref">
            <?php for ($i=0; $i < count($reference['idref']); $i++) { ?>
                <option value="<?php echo $reference['code'][$i] ?>"><?php echo $reference['code'][$i] ?>\</option>
            <?php } ?>
        </select>
        <label for="numero">Numero piece</label>
        <input type="text" name="numero" id="piece">
        <select name="idpcg" id="pcg">
            <?php for ($i=0; $i < count($pcg['id']); $i++) { ?>
                <option value="<?php echo $pcg['id'][$i] ?>"><?php echo $pcg['intitule'][$i] ?></option>
            <?php } ?>
        </select>
        <select name="idtier" id="tier">
            <option value="">Compte tier</option>
            <?php for ($i=0; $i < count($tier['id']); $i++) { ?>
                <option value="<?php echo $tier['id'][$i] ?>"><?php echo $tier['intitule'][$i] ?></option>
            <?php } ?>
        </select>
        <label for="libelle">Libelle ecriture</label>
        <input type="text" name="libelle" id="libelle">
        <select name="iddevise" id="devise">
            <?php for ($i=0; $i < count($devise['iddevise']); $i++) { ?>
                <option value="<?php echo $devise['iddevise'][$i] ?>"><?php echo $devise['intitule'][$i] ?></option>
            <?php } ?>
        </select>
        <label for="number">Montant en devise</label>
        <input type="number" name="montant" id="montant">
        <label for="choix">Debit</label>
        <input type="radio" name="choix" id="choix" value="0" checked>
        <label for="choix">Credit</label>
        <input type="radio" name="choix" id="choix" value="1">
        
        <h3 id="valueDebit">Debit: 0</h3>
        <input type="hidden" name="debit" id="debit" value="0">
        <input type="hidden" name="credit" id="credit" value="0">
        <h3 id="valueCredit">Credit: 0</h3>
        <input type="submit" value="Valider">
    </form>

    <p id="error"></p>
    
    <div class="table-container">
        <h1>Details</h1>
        <?php if(!empty($ecriture)) { ?>
            <table border="1" id="table-values">
                <tr>
                    <th>Code Journal</th>
                    <th>Reference Piece</th>
                    <th>Compte general</th>
                    <th>Compte tier</th>
                    <th>Libelle ecriture</th>
                    <th>Devise</th>
                    <th>Montant Devise</th>
                    <th>Debit</th>
                    <th>Credit</th>
                </tr>
                <?php for ($i=0; $i < count($ecriture['idecriture']); $i++) { ?>
                    <tr>
                        <td><?php echo $journal[0]['numero'] ?></td>
                        <td><?php echo $ecriture['reference'][$i] ?></td>
                        <td><?php echo $ecriture['pcg'][$i] ?></td>
                        <td><?php echo $ecriture['tier'][$i] ?></td>
                        <td><?php echo $ecriture['libelle'][$i] ?></td>
                        <td><?php echo $ecriture['devise'][$i] ?></td>
                        <td><?php echo $ecriture['montantdevise'][$i] ?></td>
                        <td><?php echo $ecriture['debit'][$i] ?></td>
                        <td><?php echo $ecriture['credit'][$i] ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <table border="1" id="table-values">
                <tr>
                    <th>Code Journal</th>
                    <th>Reference Piece</th>
                    <th>Compte general</th>
                    <th>Compte tier</th>
                    <th>Libelle ecriture</th>
                    <th>Devise</th>
                    <th>Montant Devise</th>
                    <th>Debit</th>
                    <th>Credit</th>
                </tr>
            </table>
        <?php } ?>
        <?php echo anchor('RoutesController/validate?idjournal='.$_GET['idjournal'],'Valider journal'); ?>    
    </div>
</body>
</html>