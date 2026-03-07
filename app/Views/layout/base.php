<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title'); ?> - Twill Architecture</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <?= $this->renderSection('css'); ?>
</head>

<body>
    <?= $this->include('layout/navbar'); ?>

    <main>
        <?= $this->renderSection('content'); ?>
        <a href="https://wa.me/6282211222890?text=Halo,%20saya%20ingin%20bertanya%20tentang%20desain." class="btn-wa-global" target="_blank" rel="noopener noreferrer">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.964 9.964 0 001.333 4.993L2 22l5.233-1.337a9.983 9.983 0 004.779 1.226h.004c5.505 0 9.988-4.478 9.989-9.984A9.979 9.979 0 0012.012 2zm0 16.792h-.003a8.318 8.318 0 01-4.244-1.156l-.304-.18-3.159.808.84-3.003-.198-.314A8.324 8.324 0 013.684 11.98c0-4.582 3.737-8.314 8.33-8.314 2.22 0 4.305.867 5.875 2.44 1.57 1.573 2.434 3.662 2.434 5.88-.002 4.583-3.74 8.32-8.311 8.32zm4.566-6.222c-.25-.125-1.479-.73-1.708-.813-.23-.083-.397-.125-.564.125-.166.25-.646.813-.792.98-.146.166-.292.187-.542.062-.25-.125-1.055-.39-2.011-1.246-.743-.665-1.246-1.488-1.392-1.738-.146-.25-.015-.385.11-.51.112-.112.25-.291.375-.437.125-.146.166-.25.25-.417.083-.166.041-.312-.021-.437-.062-.125-.564-1.354-.772-1.854-.203-.487-.41-.421-.564-.429-.146-.006-.313-.006-.479-.006a.916.916 0 00-.667.312c-.229.25-.875.854-.875 2.083 0 1.229.896 2.417 1.021 2.583.125.166 1.761 2.688 4.267 3.77.597.258 1.062.413 1.425.528.599.19 1.144.163 1.574.099.485-.072 1.479-.604 1.688-1.188.208-.583.208-1.083.146-1.188-.062-.104-.229-.166-.479-.291z" />
            </svg>
        </a>
        </a>
    </main>

    <?= $this->include('layout/footer'); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>
    <script src="<?= base_url('assets/js/main.js'); ?>"></script>

    <?= $this->renderSection('js'); ?>
</body>

</html>