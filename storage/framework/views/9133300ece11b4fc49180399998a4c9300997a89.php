<div class="flex flex-col items-start ps-4 pb-1">
    <div class="flex flex-row items-center">
        <button class="text-2xl me-3 focus:outline-none" wire:model='like-button' wire:click='ToggleLike(<?php echo e($post_id); ?>)'>
            <i class="<?php echo e($isLiked ? " fa text-red-500": "far"); ?> fa-heart"></i></button>
        <button class="text-2xl me-3 focus:outline-none" onclick="comment(this)">
            <i class="far fa-comment">
            </i>
        </button>
        <button class="text-2xl me-3 focus:outline-none" id="<?php echo e($post_id); ?>" onclick="copyToClipboard(<?php echo e($post_id); ?>)"
            value="<?php echo e(url('')); ?>/posts/<?php echo e($post_id); ?>"><i class="far fa-share-square"></i></button>
    </div>

    <span><?php echo e(__("Liked By ")); ?> <?php echo e($likeCount); ?></span>
</div><?php /**PATH D:\MyProjects\instagram\resources\views/livewire/like-button.blade.php ENDPATH**/ ?>