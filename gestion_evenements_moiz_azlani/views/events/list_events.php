<?php
require_once __DIR__ . '/../../controllers/EventController.php';
require_once __DIR__ . '/../layout/header.php';

$eventController = new EventController();
$events = $eventController->getAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Événements</title>
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

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        th, td {
            padding: 16px 20px;
            text-align: left;
        }

        th {
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            color: white;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background-color: #f9fafc;
        }

        tr:hover {
            background-color: #fff8f3;
        }

        td {
            border-bottom: 1px solid #e1e5eb;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .action-links a {
            display: inline-block;
            margin-right: 10px;
            color: #ff7e5f;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .action-links a:hover {
            color: #e05e3f;
            transform: translateY(-2px);
        }

        .action-links a.delete-link {
            color: #e74c3c;
        }

        .action-links a.delete-link:hover {
            color: #c0392b;
        }

        .empty-message {
            text-align: center;
            color: #95a5a6;
            padding: 40px;
            background-color: #f9fafc;
            border-radius: 8px;
            border: 1px dashed #e1e5eb;
            font-size: 18px;
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

            table {
                box-shadow: none;
            }

            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #e1e5eb;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            }

            td {
                border: none;
                border-bottom: 1px solid #e1e5eb;
                position: relative;
                padding-left: 50%;
                text-align: right;
            }

            td:before {
                position: absolute;
                top: 16px;
                left: 16px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                content: attr(data-label);
                font-weight: 600;
                text-align: left;
                color: #ff7e5f;
            }

            td:last-child {
                border-bottom: none;
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
            
            <h2>Liste des Événements</h2>

            <?php if (empty($events)): ?>
                <div class="empty-message">
                    <p>Aucun événement n'a été trouvé.</p>
                    <p>Créez votre premier événement pour commencer.</p>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event): ?>
                            <tr>
                                <td data-label="Titre"><?= htmlspecialchars($event['titre']) ?></td>
                                <td data-label="Date"><?= htmlspecialchars($event['date_evenement']) ?></td>
                                <td data-label="Description"><?= htmlspecialchars($event['description']) ?></td>
                                <td data-label="Actions" class="action-links">
                                    <a href="edit_event.php?id=<?= $event['id'] ?>">Modifier</a>
                                    <a href="delete_event.php?id=<?= $event['id'] ?>" class="delete-link" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        
      
    </div>
</body>
</html>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>