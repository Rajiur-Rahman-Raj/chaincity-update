<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('Due Installment Invested User List'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $base_currency = config('basic.currency_symbol');
    ?>

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped" id="zero_config">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><?php echo app('translator')->get('User'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Invested Amount'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Due Amount'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Due Installments'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Installment Last Date'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $investedUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td data-label="<?php echo app('translator')->get('User'); ?>">
                                <a href="<?php echo e(route('admin.user-edit',$invest->user_id)); ?>" target="_blank">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="mr-3"><img
                                                src="<?php echo e(getFile(config('location.user.path').optional($invest->user)->image)); ?>"
                                                alt="user" class="rounded-circle" width="45" height="45">
                                        </div>
                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                                <?php echo app('translator')->get(optional($invest->user)->firstname); ?> <?php echo app('translator')->get(optional($invest->user)->lastname); ?>
                                            </h5>
                                            <span class="text-muted font-14"><span>@</span><?php echo app('translator')->get(optional($invest->user)->username); ?></span>
                                        </div>
                                    </div>
                                </a>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Invested Amount'); ?>">
                                <?php echo e(config('basic.currency_symbol')); ?><?php echo e($invest->amount); ?>

                            </td>

                            <td data-label="<?php echo app('translator')->get('Due Amount'); ?>">
                                <?php echo e(config('basic.currency_symbol')); ?><?php echo e(optional(($invest)->property)->totalDueInvestUserAndAmount()['totalDueAmount']); ?>

                            </td>

                            <td data-label="<?php echo app('translator')->get('Due Installments'); ?>">
                                <span class="custom-badge badge-pill bg-warning"><?php echo e($invest->due_installments); ?></span>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Installment Last Date'); ?>">
                                <?php echo e(customDate($invest->next_installment_date_end)); ?>

                            </td>


                            <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                <a class="btn btn-sm  btn-outline-primary btn-rounded btn-sm investPaymentSingleUser"
                                   href="<?php echo e(route('admin.send-email',$invest->user_id)); ?>">
                                    <span>
                                        <i class="fas fa-envelope-open text-blue"></i> <?php echo app('translator')->get(' Send Mail'); ?>
                                    </span>
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="100%" class="text-center text-na"><?php echo app('translator')->get('No Data Found'); ?></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link href="<?php echo e(asset('assets/admin/css/dataTables.bootstrap4.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('assets/admin/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/datatable-basic.init.js')); ?>"></script>

    <?php if($errors->any()): ?>
        <?php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        ?>
        <script>
            "use strict";
            <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            Notiflix.Notify.Failure("<?php echo e(trans($error)); ?>");
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xammp\htdocs\chaincity_update\project\resources\views/admin/property/dueInvestedUserList.blade.php ENDPATH**/ ?>