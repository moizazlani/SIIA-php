<?php
require_once __DIR__ . '/../../controllers/EventController.php';

// Vérifie si l'ID de l'événement est passé dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $event_id = $_GET['id'];

    // Création du contrôleur pour l'événement
    $eventController = new EventController();

    try {
        // Supprimer l'événement
        $eventController->delete($event_id);
        // Redirige vers la liste des événements après suppression
        header('Location: list_events.php');
        exit;
    } catch (Exception $e) {
        // Si une erreur survient, affiche un message
        echo "<p style='color:red;'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
    }
} else {
    echo "<p style='color:red;'>Événement non trouvé.</p>";
}
?> 
