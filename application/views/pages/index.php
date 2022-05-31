<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <meta content="<?= strip_tags($description) ?>" name="description">
    <meta content="<?= strip_tags($keywords) ?>" name="keywords">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= strip_tags($otitle) ?>" />
    <meta property="og:description" content="<?= strip_tags($description) ?>" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:site_name" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/lib/slick.css">
    <link rel="stylesheet" href="/assets/css/main.css">
</head>

<body class="bg-white font-f-regular flex flex-col h-screen">
    <div class="container flex-grow">
        <?php $this->load->view($header); ?>

        <?php $this->load->view($inner_view); ?>
    </div>
    <div class="bg-sky-theme">
        <div class="container">
            <?php $this->load->view($footer); ?>
        </div>
    </div>


    <script defer src="/assets/js/slider/slick.min.js"></script>
    <script defer src="/assets/js/home.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>