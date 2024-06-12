<!-- on reprend l'entête de l'Ex, on change les href pour ne plus mettre le nom des pages, mais seulement ce que l'on veut dans l'url -->

<ul class="flexible space-evenly">
    <!-- grand écran -->
    <li class="menu"><a href="/">Home</a></li>  <!-- index.php devient / -->
    <!-- deux possibilités de menu selon qu'on est connecté ou pas -->
    <?php if (isset($_SESSION["user"])) : ?>
        <li  class="menu"><a href="mesEcoles">Mes écoles</a></li>
        <li  class="menu"><a href="messages">Messages</a></li>
        <li  class="menu"><a href="profil">Profil</a></li>
        <li  class="menu"><a href="deconnexion">Déconnexion</a></li>    
    <?php else : ?>
        <li  class="menu"><a href="inscription">Inscription</a></li>
        <li  class="menu"><a href="connexion">Connexion</a></li>    
    <?php endif ?>
    <!-- à voir...
    <li class="imageMenu"><a href="/"><ion-icon size="large" name="home-outline"></ion-icon></a></li>
    <li class="imageMenu"><a href="inscription"><ion-icon size="large" name="person-outline"></ion-icon></a></li>
    <li class="imageMenu"> <a href="connexion"><ion-icon size="large" name="enter-outline"></ion-icon></a></li>
    -->
</ul>