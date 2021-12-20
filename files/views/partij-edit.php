<?php

?>

<div class="add-partij-container">
    <div class="logo">
        <h1 class="title">Partij bewerken</h1>
        <hr>
    </div>
    <div class="add-partij-content-container">
        <div>
            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" maxlength="255">
        </div>
        <div>
            <label for="afkorting">Afkorting:</label>
            <input type="text" id="afkorting" name="afkorting" maxlength="10">
            <input type="hidden" name="eid" id="eid">
        </div>
        <div>
            <button data-type="party" id="button-update-partij" class="add-button">Partij opslaan</button>
            <button id="button-cancel-partij" class="add-button">Annuleren</button>
        </div>
    </div>
</div>