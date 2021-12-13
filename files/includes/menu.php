<nav class="nav">
    <div class="logo">
        <img src="/files/images/stemadvies.svg" alt="Stemadvies logo">
        <hr>
    </div>

    <div class="a-container">
        <a href="/stellingen">
            <button class="menu-button stellingen <?php if ($page == 'stellingen') {echo 'active';} ?> ">Stellingen</button>
        </a>
        <a href="/partijen">
            <button class="menu-button partijen <?php if ($page == 'partijen') {echo 'active';} ?> ">Partijen</button>
        </a>
    </div>
    <div class="logout-container">
        <hr>
        <a href="/logout">
            <button class="logout-button">Uitloggen</button>
        </a>
    </div>
</nav>