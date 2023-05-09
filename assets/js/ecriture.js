//Les codes ci dessous sont executé lors que la page est chargée
window.addEventListener("load", function () {
    
    var montant=document.getElementById('montant');
    montant.addEventListener('input',handleRadio);
    function handleRadio() {
        var debit=0;
        var credit=0;
        var array=document.querySelectorAll('#choix');
        if (array[0].checked) {
            debit=montant.value;
            credit=0;
        } else {
            credit=montant.value;
            debit=0;
        }
        document.getElementById('valueDebit').innerHTML="Debit:"+debit;
        document.getElementById('valueCredit').innerHTML="Credit:"+credit;
        document.getElementById('debit').value=debit;
        document.getElementById('credit').value=credit;
    }

    function addToTable() {
        var table=document.getElementById('table-values');
        var tr=document.createElement('tr');
        var code=document.createElement('td');
        code.textContent=document.getElementById('code').value;
        var ref=document.createElement('td');
        let index1=document.getElementById('ref').selectedIndex;
        ref.textContent=document.getElementById('ref').options[index1].innerHTML+document.getElementById('piece').value;
        var pcg=document.createElement('td');
        let index3=document.getElementById('pcg').selectedIndex;
        pcg.textContent=document.getElementById('pcg').options[index3].innerHTML;
        var tier=document.createElement('td');
        tier.textContent=document.getElementById('tier').value;
        var libelle=document.createElement('td');
        libelle.textContent=document.getElementById('libelle').value;
        var devise=document.createElement('td');
        let index2=document.getElementById('devise').selectedIndex;
        devise.textContent=document.getElementById('devise').options[index2].innerHTML;
        var montant=document.createElement('td');
        montant.textContent=document.getElementById('montant').value;
        var debit=document.createElement('td');
        debit.textContent=document.getElementById('debit').value;
        var credit=document.createElement('td');
        credit.textContent=document.getElementById('credit').value;
        
        tr.appendChild(code);
        tr.appendChild(ref);
        tr.appendChild(pcg);
        tr.appendChild(tier);
        tr.appendChild(libelle);
        tr.appendChild(devise);
        tr.appendChild(montant);
        tr.appendChild(debit);
        tr.appendChild(credit);
        table.appendChild(tr);
    }

    function sendData() {
      var xhr; 
      try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
      catch (e) 
      {
          try {   xhr = new ActiveXObject('Microsoft.XMLHTTP'); }
          catch (e2) 
          {
             try {  xhr = new XMLHttpRequest();  }
             catch (e3) {  xhr = false;   }
           }
      }
    
  
      // Liez l'objet FormData et l'élément form
      var formData = new FormData(form);
      
      xhr.onreadystatechange  = function() 
      { 
        if(xhr.readyState  == 4){
          var resultat = document.getElementById("error");
          if(xhr.status  == 200) {
              var retour = JSON.parse(xhr.responseText);
              if (retour==200) {
                addToTable();
              } else {
                resultat.innerHTML = "probleme durant insertion";
              }
          } else {
              document.dyn="Error code " + xhr.status;
          }
      }
      }; 
      
      // Configurez la requête
      xhr.open("POST", form.action);
  
      // Les données envoyées sont ce que l'utilisateur a mis dans le formulaire
      xhr.send(formData);
    }
  
    // Accédez à l'élément form …
    var form = document.getElementById("form");
  
    // … et prenez en charge l'événement submit.
    form.addEventListener("submit", function (event) {
      event.preventDefault(); // évite de faire le submit par défaut
      
      sendData();
    });
  });