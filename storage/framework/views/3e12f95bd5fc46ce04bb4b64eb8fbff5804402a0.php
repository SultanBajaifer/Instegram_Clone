<div class="min-h-screen flex flex-row sm:justify-center items-center pt-6 sm:pt-0 dark:bg-gray-700">
    <div>
        <img src=<?php echo e(asset("logo.png")); ?> alt="logo" srcset="" style="margin-right: 50px;" class="w-80 h-80 ">
    </div>
    <div class="flex flex-col">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <?php echo e($slot); ?>

        </div>
        <?php if(str_contains(url()->current(),'login')): ?>
        <div
            class="w-full sm:max w-md mt-6 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg flex justify-center items-center">
            <span class="text-sm text-gray-600 pe-5"><?php echo e(__("Dont't Have an Account? ")); ?><a href="<?php echo e(route('register')); ?>"
                    class=" text-blue-600 hover:text-red-600 text-base font-bold mx-2"><?php echo e(__('Sign Up')); ?></a></span>
        </div>
        <?php endif; ?>
    </div>
</div><?php /**PATH D:\MyProjects\instagram\resources\views/components/authentication-card.blade.php ENDPATH**/ ?>