<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <link rel="icon" href="<?php echo e(asset('logo.png')); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Norican&display=swap" rel="stylesheet">


    <!-- Scripts -->
    
    
    <link rel="stylesheet" href=<?php echo e(mix("css/app.css")); ?>>

</head>
<style>
    .rtl {
        direction: rtl;
    }

    .ltr {
        direction: ltr;
    }
</style>

<body class="<?php echo e(isset($rtl)?'rtl':'ltr'); ?> rtl">
    <div class="font-sans text-gray-900 antialiased">
        <?php echo e($slot); ?>

    </div>
    <div class="text-center bg-gray-100 py-4">
        <span>
            <a href="setlang/en" class="mx-2 text-blue-700">English</a>
            -
            <a href="setlang/ar" class="mx-2 text-blue-700">العربية</a>
        </span>
    </div>
</body>

</html><?php /**PATH D:\MyProjects\instagram\resources\views/layouts/guest.blade.php ENDPATH**/ ?>