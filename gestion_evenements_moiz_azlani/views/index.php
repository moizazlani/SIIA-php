<?php require_once __DIR__ . '/layout/header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système de Gestion des Événements</title>
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
            max-width: 1200px;
            margin: 40px auto;
            background-color: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            text-align: center;
            flex: 1;
        }

        h1 {
            color: #ff7e5f;
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 32px;
            letter-spacing: -0.02em;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin-bottom: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        nav li {
            margin: 25px 0;
        }

        nav a {
            text-decoration: none;
            color: #ff7e5f;
            font-weight: 500;
            font-size: 18px;
            padding: 12px 24px;
            border: 2px solid #ff7e5f;
            border-radius: 30px;
            transition: all 0.3s ease;
            display: inline-block;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(255, 126, 95, 0.2);
            width: 280px; /* Increased width of buttons */
            text-align: center; /* Center the text within the button */
        }

        nav a:hover {
            background-color: #ff7e5f;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(255, 126, 95, 0.3);
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

            nav a {
                display: block;
                width: 100%;
                margin: 15px 0;
            }

            h1 {
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            nav a {
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        

        <div class="container">
            <h1>Bienvenue</h1>
            <nav>
                <ul>
                    <li><a href="events/create_event.php">Créer un événement</a></li>
                    <li><a href="participants/register_participant.php">Inscrire un participant</a></li>
                    <li><a href="events/list_events.php">Liste des événements</a></li>
                    <li><a href="inscriptions/list_inscriptions.php">Liste des inscriptions</a></li>
                </ul>
            </nav>
        </div>

    </div>
</body>
</html>
<?php
require_once __DIR__ . '/layout/footer.php';
?>