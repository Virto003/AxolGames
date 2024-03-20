<style>
    .iframe-container {
        text-align: center;
        margin-top: 7em;
        margin-bottom: 4em;
    }

    .iframe-item {
        width: 330px;
        height: 20em;
        display: grid;
        flex-direction: column;
        align-items: center;
    }

    .item-background {
        width: 95%;
        z-index: -1;
        position: absolute;
    }

    .item-image {
        z-index: -2;
        position: absolute;
        margin-left: 3em;
        margin-right: 3em;
        margin-top: 2.624em;
        margin-bottom: 4.5em;
    }

    .item-text,
    .item-btn-play {
        margin-left: auto;
        margin-right: auto;
        max-width: 290px;
    }

    .item-text {
        margin-top: 1.874em;
        margin-bottom: 2.625em;
    }

    .item-btn-play {
        margin-bottom: 1.874em;
    }

    .item-image {
        position: relative;
        height: 11.063em;
        width: auto;
        padding: auto;
        background-color: black;
        /* ADD FILTER TO THE COVER GAME */
    }

    .game-cover {
        height: auto;
        width: 18.875em;
        object-fit: cover;
    }

    .game-name {
        font-family: "Upheavtt", sans-serif;
        color: #fff;
        text-transform: uppercase;
        line-height: 60px;
        font-size: 2.5em;
        font-weight: 800;
        margin-bottom: 0;
    }

    .play-button {
        font-family: "Montserrat", sans-serif;
        font-weight: 700;
        font-size: 1.5em;
        color: #fff;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        max-height: 2.25;
        /*36px*/
    }

    a:-webkit-any-link {
        color: #fff;
        cursor: pointer;
        text-decoration: none;
    }

    /* Small screens */
    @media only screen and (max-width: 600px) {
        .iframe-container {
            margin-top: 4em;
        }
    }
</style>

<div class="iframe-item">
    <img class="item-background" src="../img/fliperama/fliperama_cyan.png" alt="img fundo">
    <div class="item-text">
        <p class="game-name">AxolSchool</p>
    </div>
    <div class="item-image">
        <img class="game-cover" src="../img/teste/axolrun.png" alt="capa">
    </div>
    <div class="item-btn-play">
        <a href="#" class="play-button">Jogar</a>
    </div>
</div>