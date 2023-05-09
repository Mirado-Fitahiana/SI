Ecriture:
    -Colonnes:
        journal
        Date nanaovana 
        Reference Piece Mila manaomboatra anle base reference d fonction maka anzareo
        id Compte General (tsy maintsy misy) atao select donc mila fonction maka pcg
        id Compte tier (afaka atao null) atao select donc mila fonction maka tier
        libelle ecriture
        Devise (Euro ou ariary) atao select ko 
        Montant de devise (refa en devise le paiement,refa tsisy d ariary)
        Debit (en Ar)
        Credit (en Ar)
    -Reto no atao zany:
        mamorona table devise(iddevise,intitule,type de devise) +
        mamorona table referencePiece(idRef,Code,Intitule) +
        fonction getAllRef +
        fonction getDevise +
        fonction getPcg +
        import csv +
        fonction getTier +
        mamorona table detailDevise(idDetaildevise,iddevise,valeur,jour) +
        fonction getTodaysChange +
        mamorona table ecriture(idEcriture,idjournal,referencePiece (VARCHAR ty),idpcg (NOT NULL),idtier,libelle,iddevise default 1,montantDevise,Debit (taux change*Devise),Credit (taux change*Devise)) +
        fonction getInvalidateJournal +
        affichage:
            -devise +
            -tier +
            -pcg +
            -reference +
            -ecriture efa natao taloha:
                fonction getEcritureOfJournal(idjournal) +
        fonction insertEcriture 
        fonction mivalider ecriture:
            verifiena oe mibalance v
            asina date de fin le journal
Grand livre:
    getDetailCompte(id)
    
