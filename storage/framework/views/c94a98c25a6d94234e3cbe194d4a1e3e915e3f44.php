<div>
    <input wire:model='search' wire:keydown.debounce.1000ms="findProfile('<?php echo e($search); ?>')" type="text"
        placeholder='<?php echo e(__("search")); ?>' class="border border-gray-300 border-solid text-center p-0">

    <?php if($results != null): ?>
    <ul class="absolute mt-2 w-auto bg-white p-1 shadow-lg border border-gray-500 border-solid z-10">
        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="flex flex-row items-center justify-between my-1">
            <a class="font-bold text-blue-500 hover:underline" href="/profile/<?php echo e($profile['username']); ?>">
                <img src="<?php echo e($profile['profile_photo_url']); ?>" class="rounded-full h-10 w-10 me-24"
                    alt="<?php echo e($profile['username']); ?>" srcset="">
            </a>
            <span>
                <a class="font-bold text-blue-500 hover:underline" href="/profile/<?php echo e($profile['username']); ?>">
                    <?php echo e($profile['username']); ?></a>
            </span>
        </li>
        <?php if(!$loop->last): ?>
        <hr class="h-2">
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <?php endif; ?>
</div><?php /**PATH D:\MyProjects\instagram\resources\views/livewire/search.blade.php ENDPATH**/ ?>