<?php
require_once __DIR__ . '/../../controllers/EventController.php';
require_once __DIR__ . '/../layout/header.php';

$eventController = new EventController();
$message = '';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $event_id = $_GET['id'];
    try {
        $event = $eventController->getById($event_id);
    } catch (Exception $e) {
        $message = "<p style='color:red;'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
    }
} else {
    $message = "<p style='color:red;'>Événement non trouvé.</p>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $titre = $_POST['titre'] ?? '';
        $date = $_POST['date_evenement'] ?? '';
        $description = $_POST['description'] ?? '';

        $eventController->update($event_id, $titre, $date, $description);
        $message = "<p style='color:green;'>Événement modifié avec succès !</p>";
    } catch (Exception $e) {
        $message = "<p style='color:red;'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'Événement</title>
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
        input[type="date"],
        textarea {
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
        input[type="date"]:focus,
        textarea:focus {
            outline: none;
            border-color: #feb47b;
            box-shadow: 0 0 0 3px rgba(254, 180, 123, 0.2);
            background-color: #fff;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
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
            
            <h2>Modifier l'Événement</h2>
            
            <div id="message-container">
                <?php if(!empty($message)): ?>
                    <?= $message ?>
                <?php endif; ?>
            </div>
            
            <?php if (isset($event)): ?>
                <form method="post">
                    <div class="form-group">
                        <label for="titre">Titre de l'événement</label>
                        <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($event['titre']) ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="date_evenement">Date de l'événement</label>
                        <input type="date" name="date_evenement" id="date_evenement" value="<?= htmlspecialchars($event['date_evenement']) ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description détaillée</label>
                        <textarea name="description" id="description"><?= htmlspecialchars($event['description']) ?></textarea>
                    </div>
                    
                    <button type="submit">Mettre à jour l'Événement</button>
                </form>
            <?php endif; ?>
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
<?php require_once __DIR__ . '/../layout/footer.php'; ?>