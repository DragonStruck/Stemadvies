<?php

?>

<div class="add-partij-container">
    <div class="logo">
        <h1 class="title">Partij toevoegen</h1>
        <hr>
    </div>
    <div class="add-partij-content-container">
        <div class="input-container">
            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" maxlength="255">
        </div>
        <div class="input-container">
            <label for="afkorting">Afkorting:</label>
            <input type="text" id="afkorting" name="afkorting" maxlength="10">
        </div>
        <div class="submit-container">
            <button data-type="party" id="button-save-partij" class="add-button">Partij opslaan</button>
            <button id="button-cancel-partij" class="add-button">Annuleren</button>
        </div>
    </div>
</div>