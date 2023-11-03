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
    

    <link rel="stylesheet" href=<?php echo e(asset("css/all.css")); ?>>
    <link rel="stylesheet" href=<?php echo e(asset("css/app.css")); ?>>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="<?php echo e(mix('js/app.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/alpine@3.0.6/dist/alpine.js"></script>

    <!-- Styles -->
    <?php echo \Livewire\Livewire::styles(); ?>

</head>
<style>
    .post {
        position: relative;
        flex: 1 0 220px;
        color: #fff;
        cursor: pointer;
        width: 293px;
        height: 293px;
    }

    .post:hover .post-info,
    .post.focus .post-info {
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;

        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgb(0, 0, 0, 0.3);
    }

    .post-info {
        display: none;
    }

    .rtl {
        direction: rtl;
    }

    .ltr {
        direction: ltr;
    }

    tailwind.config= {
        content: [ './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
            './vendor/laravel/jetstream/**/*.blade.php',
            './storage/framework/views/*.php',
            './resources/views/**/*.blade.php',
            './resources/**/*.blade.php',
            './resources/**/*.js',
            './resources/**/*.vue', ],

    }
</style>

<body class="font-sans antialiased <?php echo e(isset($rtl)?'rtl':'ltr'); ?>">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.banner','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>


    <div class="min-h-screen bg-gray-100">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('navigation-menu')->html();
} elseif ($_instance->childHasBeenRendered('cDxYKEy')) {
    $componentId = $_instance->getRenderedChildComponentId('cDxYKEy');
    $componentTag = $_instance->getRenderedChildComponentTagName('cDxYKEy');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('cDxYKEy');
} else {
    $response = \Livewire\Livewire::mount('navigation-menu');
    $html = $response->html();
    $_instance->logRenderedChild('cDxYKEy', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

        <!-- Page Heading -->
        <?php if(isset($header)): ?>
        <?php echo e($header); ?>


        <?php endif; ?>

        <!-- Page Content -->
        <main class="mb-10 pb-2">
            <?php echo e($slot); ?>

        </main>
    </div>

    <?php echo $__env->yieldPushContent('modals'); ?>

    <?php echo \Livewire\Livewire::scripts(); ?>

</body>
<script>
    const oldHeight = document.getElementById('commentArea').style.maxHeight;
    var state = true;
    function showEditCommentForm(buttonElement) {
    // Get the comment text and show the edit form
    const commentTextElement = buttonElement.parentNode.parentNode.querySelector('.comment-text');
    const cancelButton = buttonElement.nextElementSibling;
    const commentFormElement = buttonElement.parentNode.parentNode.querySelector('.comment-form');
    const commentInputElement = commentFormElement.querySelector('#comment-input');
    const saveButton = commentFormElement.querySelector('.btn-primary');

    commentInputElement.value = commentTextElement.textContent.trim();
    commentTextElement.classList.add('hidden');
    buttonElement.classList.add('hidden');
    commentFormElement.classList.remove('hidden');
    saveButton.classList.remove('hidden');
    cancelButton.classList.remove('hidden');
}

function cancelEditComment(buttonElement) {
    // Hide the edit form, input, and cancel button, and show the original text
    const commentTextElement = buttonElement.parentNode.parentNode.querySelector('.comment-text');
    const commentFormElement = buttonElement.parentNode.parentNode.querySelector('.comment-form');
    const commentInputElement = commentFormElement.querySelector('#comment-input');
    const saveButton = commentFormElement.querySelector('.btn-primary');
    const editButton = buttonElement.previousElementSibling;

    commentFormElement.classList.add('hidden');
    commentFormElement.querySelector('input[name="comment"]').value = '';
    commentFormElement.querySelector('input[name="comment"]').classList.add('hidden');
    buttonElement.classList.add('hidden');
    saveButton.classList.add('hidden');
    editButton.classList.remove('hidden');
    commentInputElement.classList.remove('hidden');
    commentTextElement.classList.remove('hidden');
}
function deleteComment() {
    // Implement the delete comment functionality here
    alert('Delete comment functionality not implemented yet.');
}
function copyToClipboard(id){
    postLink = document.getElementById(id);
    navigator.clipboard.writeText(postLink.value);
    alert('The Shareable Link: ' + postLink.value);
}
function Focus(post_id){
    document.getElementById(post_id).focus();
}
function comment(button){
    commentSection = document.getElementById('sec4');
    if (state) {
        commentSection.classList.remove('hidden');
        state = false;
        var img = document.getElementById('postImage');
        var sec1 = document.getElementById('sec1');
        var sec3 = document.getElementById('sec3');
        var sec4 = document.getElementById('sec4');
        if(img!=null){
            var imgheight = img.offsetHeight;
            var sec1height = sec1.offsetHeight;
            var sec3height = sec3.offsetHeight;
            var sec4height = sec4.offsetHeight;
            var height = imgheight - (sec1height + sec3height +sec4height);
            document.getElementById('commentArea').style.maxHeight = height.toString() + "px";
        }

    } else {
        commentSection.classList.add('hidden');
        state = true;
        hieght = parseFloat(document.getElementById('commentArea').style.maxHeight);
        var img = document.getElementById('postImage');
        var sec1 = document.getElementById('sec1');
        var sec3 = document.getElementById('sec3');
        if(img!=null){
            var imgheight = img.offsetHeight;
            var sec1height = sec1.offsetHeight;
            var sec3height = sec3.offsetHeight;
            console.log(commentSection.offsetHeight.toString());
            var height = imgheight - (sec1height + sec3height);
            document.getElementById('commentArea').style.maxHeight = height.toString() + "px";
    }
    }

}
    var img = document.getElementById('postImage');
    var sec1 = document.getElementById('sec1');
    var sec3 = document.getElementById('sec3');
    var sec4 = document.getElementById('sec4');
    if(img!=null){
        var imgheight = img.offsetHeight;
        var sec1height = sec1.offsetHeight;
        var sec3height = sec3.offsetHeight;
        var sec4height = sec4.offsetHeight;
        var height = imgheight - (sec1height + sec3height +sec4height);
        document.getElementById('commentArea').style.maxHeight = height.toString() + "px";
    }

</script>

</html><?php /**PATH D:\MyProjects\instagram\resources\views/layouts/app.blade.php ENDPATH**/ ?>