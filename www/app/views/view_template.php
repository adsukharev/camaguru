<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>Template</title>
    <link rel="stylesheet" href="/css/common.css?ts=<?=time()?>">
    <link rel="stylesheet" href="/css/auth.css">
    <link rel="stylesheet" href="/css/header.css?ts=<?=time()?>">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/gallery.css?ts=<?=time()?>">
</head>

<body>
<header>
    <div class="container header">
        <div>
            <a href="/main" class="">InstaCamaguru</a>
        </div>

        <div>
            <a href="/gallery" class="">Gallery</a>
        </div>

        <div>
            <a href="/profile" class="">Profile</a>
        </div>

        <div>
            <a href="/auth/signOut" class="">SignOut</a>
        </div>

    </div>
</header>
<br>
<main>
    <?php include 'app/views/'.$content_view; ?>
</main>

<footer>
    <p>made my Andrei Sukharev</p>
</footer>
</body>

</html>