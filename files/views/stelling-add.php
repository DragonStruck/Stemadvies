<?php

?>

<div class="add-stelling-container">
    <div class="logo">
        <h1 class="title">Stelling toevoegen</h1>
        <hr>
    </div>
    <div class="add-stelling-content-container">
        <form name="stelling-add-form" id="stelling-add-form">
            <div class="input-container">
                <label for="subject">Onderwerp:</label>
                <input type="text" id="subject" name="subject">
            </div>
            <div class="input-container">
                <label for="question">Stelling:</label>
                <textarea id="question" name="question"></textarea>
            </div>
            <input type="hidden" name="add" value="question">
            <div class="partijen-container">
                <div>
                    <h1 class="title">Partijen:</h1>
                    <p class="p">Selecteer de checkbox als de desbetreffende partij het eens is met de stelling</p>
                </div>
                <div id="partijen-radios" class="partijen-radios"></div>
            </div>
        </form>

        <div class="submit-container">
            <button data-type="question" id="button-save-stelling" class="add-button">Stelling opslaan</button>
            <button id="button-cancel-stelling" class="add-button">Annuleren</button>
        </div>
    </div>
</div>