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
     <?php $__env->endSlot(); ?>

    <div class="grid grid-cols-12 mt-7 gap-4">
        <div class='col-start-3 col-span-5'>
            <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <div class="flex flex-col border border-solid border-gray-300 mb-14 bg-white">
                <div class="flex flex-row p-3 border-b border-solid border-gray-300 items-center">
                    <a href="/profile/<?php echo e($post->user->username); ?>">
                        <img src="<?php echo e($post->user->profile_photo_url); ?>" alt="<?php echo e($post->user->username); ?>" srcset=""
                            class="rounded-full h-12 w-12 me-3 ">
                    </a>
                    <a class="hover:underline" href="/profile/<?php echo e($post->user->username); ?>"><?php echo e($post->user->username); ?></a>
                </div>
                <div>
                    <a href="/posts/<?php echo e($post->id); ?>"><img class='w-full' style="max-height: 80vh"
                            src="/storage/<?php echo e($post->image_path); ?>" alt=""></a>
                </div>
                <div class="flex flex-row items-center mt-2">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('like-button',['post_id'=>$post->id])->html();
} elseif ($_instance->childHasBeenRendered($post->id)) {
    $componentId = $_instance->getRenderedChildComponentId($post->id);
    $componentTag = $_instance->getRenderedChildComponentTagName($post->id);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild($post->id);
} else {
    $response = \Livewire\Livewire::mount('like-button',['post_id'=>$post->id]);
    $html = $response->html();
    $_instance->logRenderedChild($post->id, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <div class="border-b border-solid border-gray-200 ps-4 pb-1">
                    <div class="me-7 mb-2">
                        <a class="font-bold text-base hover:underline"
                            href="/profile/<?php echo e($post->user->username); ?>"><?php echo e($post->user->username); ?></a>
                        <span><?php echo e($post->post_caption); ?></span>
                    </div>
                    <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->iteration==4): ?>
                    <?php break; ?>
                    <?php endif; ?>
                    <div class="me-7">
                        <a class="font-bold hover:underline"
                            href="/profile/<?php echo e($comment->user->username); ?>"><?php echo e($comment->user->username); ?></a>
                        <span><?php echo e($comment->comment); ?></span>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($post->comments()->count()>3): ?>
                    <a class='font-sm text-gray-700' href="/posts/<?php echo e($post->id); ?>">
                        <?php echo e(__('View all')); ?> <?php echo e($post->comments()->count()); ?> <?php echo e(__('Comments')); ?></a>
                    <?php endif; ?>
                    <div class="text-gray-500 text-xs">
                        <?php echo e($post->created_at->format('M j o')); ?>

                    </div>
                </div>
                <div class="p-4">
                    <form action="/comments" method="post" autocomplete="off">
                        <?php echo csrf_field(); ?>
                        <div class='flex flex-row items-center justify-between'>
                            <input class="w-full outline-none border-none p-0" type="text" name="comment"
                                id="<?php echo e($post->id); ?>" placeholder="<?php echo e(__('Add Comment')); ?>" />
                            <input type="hidden" name="post_id" value="<?php echo e($post->id); ?>">
                            <button class="text-blue-500 font-semibold hover:text-blue-700"
                                type="submit"><?php echo e(__('Post')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="m-10">
                <p class="font-semibold"><?php echo e(__('Start your journey, Follow your frends')); ?></p>
            </div>

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
        <div class="col-start-8 col-span-4 ms-4">
            <div class="flex flex-row justify-between">
                <a href="/profile/<?php echo e($profile->username); ?>">
                    <img src="<?php echo e($profile->profile_photo_url); ?>" alt="avatar" class="rounded-full w-12 h-12 me-3"></a>
                <div class="flex flex-col self-center ms-3">
                    <a href="/profile/<?php echo e($profile->username); ?>"
                        class="text-base hover:underline"><?php echo e($profile->username); ?></a>
                    <h3 class="text-sm text-gray-400"><?php echo e($profile->bio); ?></h3>
                </div>
            </div>
            <h3 class="mt-4 mb-4 text-gray-500 font-semibold"><?php echo e(__('Pepole you follow:')); ?></h3>
            <?php $__empty_1 = true; $__currentLoopData = $iFollow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="flex flex-col mb-3">
                <div class="flex flex-row justify-between">
                    <div class="flex flex-row">
                        <a href="/profile/<?php echo e($follow->username); ?>"><img src="<?php echo e($follow->profile_photo_url); ?>" alt="avatar"
                                class="rounded-full w-12 h-12 me-3"></a>
                        <div class="flex flex-col self-center ms-3">
                            <a href="/profile/<?php echo e($follow->username); ?>" class="text-base hover:underline">
                                <?php echo e($follow->username); ?>

                            </a>
                            <h3 class="text-sm text-gray-500 "><?php echo e($follow->bio); ?></h3>
                        </div>
                    </div>
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('follow-button',['profile_id'=>$follow->id])->html();
} elseif ($_instance->childHasBeenRendered($follow->id)) {
    $componentId = $_instance->getRenderedChildComponentId($follow->id);
    $componentTag = $_instance->getRenderedChildComponentTagName($follow->id);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild($follow->id);
} else {
    $response = \Livewire\Livewire::mount('follow-button',['profile_id'=>$follow->id]);
    $html = $response->html();
    $_instance->logRenderedChild($follow->id, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>

            </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="my-10">
                <p class="font-semibold"><?php echo e(__("Nothing to show right now!")); ?></p>
            </div>
            <?php endif; ?>
            <h3 class="mt-4 mb-4 text-gray-500 font-semibold"><?php echo e(__("Peopole you may want to follow:")); ?></h3>
            <?php $__empty_1 = true; $__currentLoopData = $toFollow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="flex flex-col mb-3">
                <div class="flex flex-row justify-between">
                    <div class="flex flex-row">
                        <a href="/profile/<?php echo e($follow->username); ?>"><img src="<?php echo e($follow->profile_photo_url); ?>" alt="avatar"
                                srcset="" class="rounded-full w-12 h-12 me-3"></a>
                        <div class="flex flex-col self-center ms-3">
                            <a href="/profile/<?php echo e($follow->username); ?>" class="text-base hover:underline">
                                <?php echo e($follow->username); ?>

                            </a>
                            <h3 class="text-sm text-gray-500 "><?php echo e($follow->bio); ?></h3>
                        </div>
                    </div>
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('follow-button',['profile_id'=>$follow->id])->html();
} elseif ($_instance->childHasBeenRendered($follow->id)) {
    $componentId = $_instance->getRenderedChildComponentId($follow->id);
    $componentTag = $_instance->getRenderedChildComponentTagName($follow->id);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild($follow->id);
} else {
    $response = \Livewire\Livewire::mount('follow-button',['profile_id'=>$follow->id]);
    $html = $response->html();
    $_instance->logRenderedChild($follow->id, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>

            </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="my-10">
                <p class="font-semibold"><?php echo e(__("Nothing to show right now!")); ?></p>
            </div>
            <?php endif; ?>

        </div>

    </div>


 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH D:\MyProjects\instagram\resources\views/home.blade.php ENDPATH**/ ?>