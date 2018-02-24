<?php
require_once 'partials/header.php';

// Détruit toutes les variables de session (vide le tableau $_SESSION)
session_unset($_SESSION);

// Détruit la session côté serveur (supprime le fichier /tmp/sess_XXXXXX)
session_destroy();

// Détruit le cookie client avec l'identifiant de session
setcookie(session_name(), false, 1, '/');
?>
<div class="alert alert-success">Déconnexion réussie</div>
<script>setTimeout(function() { location.href = "index.php"; }, 1500);</script>
<?php
require_once 'partials/footer.php';