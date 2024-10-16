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
    var inputNomeFile = document.getElementById('inputNomeFile').value;
    var inputDataCaricamento = document.getElementById('inputDataCaricamento').value;
    var inputFile = document.getElementById('inputFile').value;

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
    console.log("Nome del File:", inputNomeFile);
    console.log("Data di Caricamento:", inputDataCaricamento);
    console.log("File:", inputFile);
    console.log("Descrizione:", inputDescrizione);
}

document.addEventListener("DOMContentLoaded", function () {
    // Dati di esempio
    var data = [
        {
            Nome: document.getElementById('inputNome').value,
            Cognome: document.getElementById('inputCognome').value,
            CAP: document.getElementById('inputCap').value,
            Indirizzo: document.getElementById('inputIndirizzo').value,
            NumeroCivico: document.getElementById('inputNumeroCivico').value,
            Provincia: document.getElementById('inputProvincia').value,
            Comune: document.getElementById('inputComune').value,
            NumeroDocumento: document.getElementById('inputNumeroDocumento').value,
            ScadenzaDocumento: document.getElementById('inputScadenzaDocumento').value,
            CodiceFiscale: document.getElementById('inputCodiceFiscale').value,
            DataNascita: document.getElementById('inputDataNascita').value,
            NumeroTelefono: document.getElementById('inputNumeroTelefono').value,
            NomeFile: document.getElementById('inputNomeFile').value,
            CaricamentoFile: document.getElementById('inputFile').value, // Aggiorna con il campo giusto
            Descrizione: document.getElementById('inputDescrizione').value,
        },
        // Aggiungi altri dati come necessario
    ];

    // Ottieni il riferimento alla tabella
    var table = document.getElementById("dataTable");

    // Popola la tabella con i dati
    data.forEach(function (item) {
        var row = table.insertRow(-1);
        Object.values(item).forEach(function (value) {
            var cell = row.insertCell(-1);
            cell.textContent = value;
        });
    });
});
