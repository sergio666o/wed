<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Ubicación</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>

<?php include __DIR__ . '/menu.php'; ?>

<div class="container mt-5">
    <h1>Ubicación</h1>
    <div class="ratio ratio-16x9">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.087707273541!2d-99.17131972562134!3d19.427025441795347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ff3af790bcf1%3A0xf90d4b35f86bbdc9!2sEl%20%C3%81ngel%20de%20la%20Independencia!5e0!3m2!1ses-419!2smx!4v1715542196037!5m2!1ses-419!2smx" 
            width="600" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
