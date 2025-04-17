<?php
require_once __DIR__ . '/../layout/header.php';
?>
<?php
require_once __DIR__ . '/../../controllers/ParticipantController.php';
require_once __DIR__ . '/../../controllers/EventController.php';
require_once __DIR__ . '/../../controllers/InscriptionController.php';
require_once __DIR__ . '/../layout/header.php';

$participantController = new ParticipantController();
$eventController = new EventController();
$inscriptionController = new InscriptionController();

$message = '';

try {
    $events = $eventController->getAll();
} catch (Exception $e) {
    $message = "<p class='error-message'>Erreur de chargement des événements : " . htmlspecialchars($e->getMessage()) . "</p>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $nom = $_POST['nom'] ?? '';
        $email = $_POST['email'] ?? '';
        $event_id = $_POST['event_id'] ?? '';

        $participantController->create($nom, $email);
        $participants = $participantController->getAll();
        $lastParticipant = end($participants);
        $inscriptionController->create($event_id, $lastParticipant['id']);

        $message = "<p class='success-message'>Inscription réussie !</p>";
    } catch (Exception $e) {
        $message = "<p class='error-message'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscrire un Participant</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            padding: 20px 0;
            color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            flex: 1;
        }

        .back-button {
            display: inline-block;
            padding: 10px 18px;
            background-color: #fff;
            color: #ff7e5f;
            text-decoration: none;
            font-weight: 500;
            border-radius: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(255,126,95,0.2);
            margin-bottom: 30px;
            border: 2px solid #ff7e5f;
        }

        .back-button:hover {
            background-color: #ff7e5f;
            color: white;
            transform: translateY(-2px);
        }

        h2 {
            color: #ff7e5f;
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 28px;
            position: relative;
            padding-bottom: 15px;
        }

        h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #ff7e5f, #feb47b);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
            font-size: 15px;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 14px;
            border: 1px solid #e1e5eb;
            border-radius: 8px;
            box-sizing: border-box;
            background-color: #f9fafc;
            color: #333;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus {
            outline: none;
            border-color: #feb47b;
            box-shadow: 0 0 0 3px rgba(254, 180, 123, 0.2);
            background-color: #fff;
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23555' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px;
            padding-right: 45px;
        }

        button {
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            color: white;
            padding: 14px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            display: inline-block;
            width: 100%;
            box-shadow: 0 4px 12px rgba(255,126,95,0.3);
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255,126,95,0.4);
        }

        .success-message {
            color: #2ecc71;
            background-color: rgba(46, 204, 113, 0.1);
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            margin-bottom: 20px;
            border-left: 4px solid #2ecc71;
        }

        .error-message {
            color: #e74c3c;
            background-color: rgba(231, 76, 60, 0.1);
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            margin-bottom: 20px;
            border-left: 4px solid #e74c3c;
        }

        .footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            text-align: center;
            padding: 20px 0;
            margin-top: auto;
        }

        @media (max-width: 768px) {
            .container {
                padding: 25px;
                margin: 20px;
            }
            
            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        
        
        <div class="container">
            <a href="http://localhost/gestion_evenements/views/" class="back-button">
                ← Retour à l'accueil
            </a>
            
            <h2>Inscrire un Participant</h2>
            
            <div id="message-container">
                <?php if(!empty($message)): ?>
                    <?= $message ?>
                <?php endif; ?>
            </div>
            
            <form method="post">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" placeholder="Entrez votre nom complet" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Entrez votre adresse email" required>
                </div>
                
                <div class="form-group">
                    <label for="event_id">Événement</label>
                    <select name="event_id" id="event_id" required>
                        <option value="">-- Sélectionnez un événement --</option>
                        <?php foreach ($events as $event): ?>
                            <option value="<?= $event['id'] ?>"><?= htmlspecialchars($event['titre']) ?> (<?= $event['date_evenement'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <button type="submit">S'inscrire à l'événement</button>
            </form>
        </div>
        
       
    </div>
    
    <script>
        // Simple animation for message disappearance
        document.addEventListener('DOMContentLoaded', function() {
            const messageContainer = document.getElementById('message-container');
            if (messageContainer.innerHTML.trim()) {
                setTimeout(function() {
                    messageContainer.style.opacity = '0';
                    messageContainer.style.transition = 'opacity 1s ease';
                }, 5000);
            }
        });
    </script>
</body>
</html>

<?php
require_once __DIR__ . '/../layout/footer.php';
?>