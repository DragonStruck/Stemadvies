<?php

?>

<div class="add-stelling-container">
    <div class="logo">
        <h1 class="title">Stelling toevoegen</h1>
        <hr>
    </div>
    <div class="add-stelling-content-container">
        <div class="input-container">
            <label for="onderwerp">Onderwerp:</label>
            <input type="text" id="onderwerp" name="onderwerp">
        </div>
        <div class="input-container">
            <label for="stelling">Stelling:</label>
            <textarea id="stelling" name="stelling"></textarea>
        </div>
        <div class="partijen-container">
            <div>
                <h1 class="title">Partijen:</h1>
                <p class="p">Selecteer de checkbox als de desbetreffende partij het eens is met de stelling</p>
            </div>
            <div class="partijen-radios">
                <div class="partij-keuze">
                    <label class="partij-keuze-label" for="rad1">ABC:</label>
                    <input class="partij-keuze-checkbox" type="checkbox" id="rad1" name="rad1">
                </div>
                <div class="partij-keuze">
                    <label class="partij-keuze-label" for="rad2">VVD:</label>
                    <input class="partij-keuze-checkbox" type="checkbox" id="rad2" name="rad2">
                </div>
                <div class="partij-keuze">
                    <label class="partij-keuze-label" for="rad3">LAL:</label>
                    <input class="partij-keuze-checkbox" type="checkbox" id="rad3" name="rad3">
                </div>
                <div class="partij-keuze">
                    <label class="partij-keuze-label" for="rad4">YaJ:</label>
                    <input class="partij-keuze-checkbox" type="checkbox" id="rad4" name="rad4">
                </div>
            </div>
        </div>
        <div class="submit-container">
            <button data-type="question" id="button-save-stelling" class="add-button">Stelling opslaan</button>
            <button id="button-cancel-stelling" class="add-button">Annuleren</button>
        </div>
    </div>
</div>