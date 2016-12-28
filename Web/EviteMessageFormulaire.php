<?php
//évite le message d'erreur 'Confirmer le nouvel envoi du formulaire'
session_start();

if(!empty($_POST) OR !empty($_FILES))
{
    $_SESSION['sauvegarde'] = $_POST ;//sauvegarde les $_post
    $_SESSION['sauvegardeFILES'] = $_FILES ;//sauvegarde les eventuels $_files
    
    $fichierActuel = $_SERVER['PHP_SELF'] ;//enregistre le fichier courant
    if(!empty($_SERVER['QUERY_STRING']))
    {
        $fichierActuel .= '?' . $_SERVER['QUERY_STRING'] ;//ajoute la chaine de requete utilisée pour acceder a la page
    }
    
    header('Location: ' . $fichierActuel);//redirige le repondeur vers fichier actuel
    exit;//termine le script
}

if(isset($_SESSION['sauvegarde']))//si une sauvegarde a été faite
{
    $_POST = $_SESSION['sauvegarde'] ;//reinjecte les $_post sauvegardés
    $_FILES = $_SESSION['sauvegardeFILES'] ;//reinjecte les $_files sauvegardés
    
    unset($_SESSION['sauvegarde'], $_SESSION['sauvegardeFILES']);//supprime les sauvegardes
}

?>
