function showFormData() {
    var inputNome = document.getElementById('inputNome').value;
    var inputCognome = document.getElementById('inputCognome').value;
    var inputCap = document.getElementById('inputCap').value;
    var inputIndirizzo = document.getElementById('inputIndirizzo').value;
    var inputNumeroCivico = document.getElementById('inputNumeroCivico').value;
    var inputProvincia = document.getElementById('inputProvincia').value;
    var inputComune = document.getElementById('inputComune').value;
    var inputNumeroDocumento = document.getElementById('inputNumeroDocumento').value;
    var inputScadenzaDocumento = document.getElementById('inputScadenzaDocumento').value;
    var inputCodiceFiscale = document.getElementById('inputCodiceFiscale').value;
    var inputDataNascita = document.getElementById('inputDataNascita').value;
    var inputNumeroTelefono = document.getElementById('inputNumeroTelefono').value;


    // Ottieni le opzioni selezionate dalla multi-select
    var inputDescrizione = [];
    var selectDescrizione = document.getElementById('inputDescrizione');
    for (var i = 0; i < selectDescrizione.options.length; i++) {
        if (selectDescrizione.options[i].selected) {
            inputDescrizione.push(selectDescrizione.options[i].value);
        }
    }

    // Visualizza i dati nella console
    console.log("Nome:", inputNome);
    console.log("Cognome:", inputCognome);
    console.log("CAP:", inputCap);
    console.log("Indirizzo:", inputIndirizzo);
    console.log("Numero Civico:", inputNumeroCivico);
    console.log("Provincia:", inputProvincia);
    console.log("Comune:", inputComune);
    console.log("Numero Documento:", inputNumeroDocumento);
    console.log("Scadenza Documento:", inputScadenzaDocumento);
    console.log("Codice Fiscale:", inputCodiceFiscale);
    console.log("Data di Nascita:", inputDataNascita);
    console.log("Numero di Telefono:", inputNumeroTelefono);

}
