
function loadProvinces() {
    var provincesSelect = document.getElementById('inputProvincia');

    // Rimuovi opzioni precedenti
    provincesSelect.innerHTML = '<option value="" disabled selected>Seleziona Provincia</option>';

    var uniqueProvinces = [...new Set(provincesData.map(province => province.provincia.nome))];
    uniqueProvinces.sort(); // Ordina in ordine alfabetico

    uniqueProvinces.forEach(function (provinceName) {
        var option = document.createElement('option');
        option.value = provinceName;
        option.text = provinceName;
        provincesSelect.appendChild(option);
    });
}

function loadCommunes() {
    var selectedProvince = document.getElementById('inputProvincia').value;
    var communesSelect = document.getElementById('inputComune');
    var capsSelect = document.getElementById('inputCAP');

    // Rimuovi opzioni precedenti
    communesSelect.innerHTML = '<option value="" disabled selected>Seleziona Comune</option>';
    capsSelect.innerHTML = '<option value="" disabled selected>Seleziona CAP</option>';

    // Filtra i comuni in base alla provincia selezionata
    var filteredCommunes = provincesData.filter(function (province) {
        return province.provincia.nome === selectedProvince;
    });

    // Popola l'elenco dei comuni
    filteredCommunes.forEach(function (commune) {
        var option = document.createElement('option');
        option.value = commune.nome;
        option.text = commune.nome;
        communesSelect.appendChild(option);
    });

    // Abilita l'inputComune
    communesSelect.disabled = false;
}

function loadCAPs() {
    var selectedCommune = document.getElementById('inputComune').value;
    var capsSelect = document.getElementById('inputCAP');

    // Verifica se il comune è selezionato
    if (selectedCommune === "") {
        capsSelect.disabled = true;
        return;
    }

    // Rimuovi opzioni precedenti
    capsSelect.innerHTML = '<option value="" disabled selected>Seleziona CAP</option>';

    // Filtra i CAP in base al comune selezionato
    var filteredCAPs = provincesData
        .filter(function (province) {
            return province.nome === selectedCommune;
        })
        .flatMap(function (province) {
            return province.cap;
        });

    // Ordina i CAP in ordine numerico
    var uniqueCAPs = [...new Set(filteredCAPs)].sort(function(a, b) {
        return a - b;
    });

    // Popola l'elenco dei CAP
    uniqueCAPs.forEach(function (cap) {
        var option = document.createElement('option');
        option.value = cap;
        option.text = cap;
        capsSelect.appendChild(option);
    });

    // Abilita l'inputCAP
    capsSelect.disabled = false;
}

// Chiamata iniziale per caricare le province al caricamento della pagina
document.addEventListener('DOMContentLoaded', function () {
    loadProvinces();
});