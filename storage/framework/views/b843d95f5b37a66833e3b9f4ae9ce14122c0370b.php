<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <header>
            <div class="grid grid-cols-5 gap-4">
                <div class="col-start-2 col-span-1 flex justify-center w-auto mt-5">
                    <img class="w-40 h-40 rounded-full object-cover" src="<?php echo e($profile->profile_photo_url); ?>" alt="hi">
                </div>
                <div class="col-start-3 col-span-2 flex justify-start items-center w-auto m-0">
                    <div class="grid grid-rows-2">
                        <div class="flex flex-row items-center">
                            <h1 class="font-light text-3xl me-14"><?php echo e($profile->username); ?></h1>
                            <?php if(Auth::check() && Auth::user()->name == $profile->name): ?>
                            <a href="<?php echo e(route('profile')); ?>"
                                class="border border-solid border-gray-300 rounded-md py-0 px-5 me-16 whitespace-nowrap">
                                <?php echo e(__("Edit Profile")); ?></a>
                            <a href="/posts/create">
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['class' => 'ms-8 leading-none whitespace-nowrap']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ms-8 leading-none whitespace-nowrap']); ?>
                                    <?php echo e(__('Add Post')); ?>

                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            </a>

                            <?php else: ?>
                            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('follow-button',['profile_id'=>$profile->id])->html();
} elseif ($_instance->childHasBeenRendered($profile->id)) {
    $componentId = $_instance->getRenderedChildComponentId($profile->id);
    $componentTag = $_instance->getRenderedChildComponentTagName($profile->id);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild($profile->id);
} else {
    $response = \Livewire\Livewire::mount('follow-button',['profile_id'=>$profile->id]);
    $html = $response->html();
    $_instance->logRenderedChild($profile->id, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                            <?php endif; ?>
                        </div>
                        <div>
                            <ul class="flex flex-row mb-5">
                                <li class="me-10 cursor-pointer"><span
                                        class="font-semibold"><?php echo e($profile->posts->count()); ?> </span><?php echo e(__('posts')); ?></li>
                                <li class="me-10 "><a href="/<?php echo e($profile->username); ?>/followers">
                                        <span class="font-semibold"><?php echo e($profile->followers()->count()); ?></span><?php echo e(__('followers')); ?>

                                    </a></li>
                                <li class="me-10 "><a href="/<?php echo e($profile->username); ?>/following">
                                        <span
                                            class="font-semibold"><?php echo e($profile->follows()->count()); ?></span><?php echo e(__('following')); ?>

                                </li>
                            </ul>
                            <p class="mb-1 font-black"><?php echo e($profile->name); ?></p>
                            <p><?php echo e($profile->bio); ?></p>
                            <p class="text-blue-500"><a href="<?php echo e($profile->url); ?>"></a> <?php echo e($profile->url); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </header>
     <?php $__env->endSlot(); ?>

    <div class="max-w-4xl my-0 mx-auto">
        <hr class="mb-10">
        <?php if($profile->status == 'public'): ?>
        <div class="grid grid-cols-3 gap-4 mx-0 mt-0 mb-6">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="post">
                <a href="/posts/<?php echo e($post->id); ?>" class="w-full h-full">
                    <img src="/storage/<?php echo e($post->image_path); ?>" alt="logo"
                        class="w-full h-full object-cover border-2 border-solid border-gray-300">
                    <div class="post-info">
                        <ul>
                            <li class="inline-block font-semibold me-7">
                                <span class="absolute h-1 w-1 overflow-hidden"><?php echo e(__("Likes")); ?></span>
                                <i class="fas fa-heart" aria-hidden="true"></i>
                                <?php echo e($post->likedByUsers()->count()); ?>

                            </li>
                            <li class="inline-block font-semibold">
                                <span class="absolute h-1 w-1 overflow-hidden"><?php echo e(__("Comments")); ?></span>
                                <i class="fas fa-comment" aria-hidden="true"></i>
                                <?php echo e($post->comments()->count()); ?>

                            </li>
                        </ul>
                    </div>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        <?php else: ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-profile',$profile)): ?>
        <div class="grid grid-cols-3 gap-4 mx-0 mt-0 mb-6">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="post">
                <a href="/posts/<?php echo e($post->id); ?>" class="w-full h-full">
                    <img src="/storage/<?php echo e($post->image_path); ?>" alt="logo"
                        class="w-full h-full object-cover border-2 border-solid border-gray-300">
                    <div class="post-info">
                        <ul>
                            <li class="inline-block font-semibold me-7">
                                <span class="absolute h-1 w-1 overflow-hidden"><?php echo e(__("Likes")); ?></span>
                                <i class="fas fa-heart" aria-hidden="true"></i>
                                <?php echo e($post->likedByUsers()->count()); ?>

                            </li>
                            <li class="inline-block font-semibold">
                                <span class="absolute h-1 w-1 overflow-hidden"><?php echo e(__("Comments")); ?></span>
                                <i class="fas fa-comment" aria-hidden="true"></i>
                                <?php echo e($post->comments()->count()); ?>

                            </li>
                        </ul>
                    </div>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div>
            <h1 class="text-center"><?php echo e(__("This Account Is Private")); ?></h1>
            <h1 class="text-center"><?php echo e(__("Follow To See Thier Posts")); ?></h1>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <div class="pagination">
            <?php if($posts->lastPage() > 1): ?>
            <ul class="pagination-list">
                <?php if($posts->currentPage() == 1): ?>
                <li class="pagination-item is-disabled"><span>&laquo;</span></li>
                <?php else: ?>
                <li class="pagination-item"><a href="<?php echo e($posts->previousPageUrl()); ?>" rel="prev">&laquo;</a></li>
                <?php endif; ?>

                <?php for($i = 1; $i <= $posts->lastPage(); $i++): ?>
                    <?php if($i == $posts->currentPage()): ?>
                    <li class="pagination-item is-active"><span><?php echo e($i); ?></span></li>
                    <?php else: ?>
                    <li class="pagination-item"><a href="<?php echo e($posts->url($i)); ?>"><?php echo e($i); ?></a></li>
                    <?php endif; ?>
                    <?php endfor; ?>

                    <?php if($posts->currentPage() == $posts->lastPage()): ?>
                    <li class="pagination-item is-disabled"><span>&raquo;</span></li>
                    <?php else: ?>
                    <li class="pagination-item"><a href="<?php echo e($posts->nextPageUrl()); ?>" rel="next">&raquo;</a></li>
                    <?php endif; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH D:\MyProjects\instagram\resources\views/profile.blade.php ENDPATH**/ ?>