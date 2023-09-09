<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get($title); ?>
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
                        <th scope="col"><?php echo app('translator')->get('Profit'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Profit Return Date'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Profit Return Times'); ?></th>
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

                            <td data-label="<?php echo app('translator')->get('Profit'); ?>">
                                <?php if($invest->how_many_times != 0 && $invest->how_many_times != null && $invest->return_date != null): ?>
                                    <?php echo e(config('basic.currency_symbol')); ?><?php echo e($invest->profit_type == 0 ? $invest->profit : $invest->net_profit); ?>

                                <?php elseif($invest->how_many_times != null && $invest->return_date == null): ?>
                                    <?php echo e(config('basic.currency_symbol')); ?><?php echo app('translator')->get('0.00'); ?>
                                <?php elseif($invest->how_many_times == null && $invest->return_date != null): ?>
                                    <?php echo e(config('basic.currency_symbol')); ?><?php echo e($invest->net_profit); ?>

                                <?php endif; ?>

                            </td>

                            <td data-label="<?php echo app('translator')->get('Profit Return Date'); ?>">
                                <?php if($invest->how_many_times != 0 && $invest->how_many_times != null && $invest->return_date != null): ?>
                                    <?php echo e(dateTime($invest->return_date)); ?>

                                <?php elseif($invest->how_many_times != null && $invest->return_date == null): ?>
                                    <span class="custom-badge badge-pill bg-warning }}"><?php echo app('translator')->get('After Installments Clear'); ?></span>
                                <?php elseif($invest->how_many_times == null && $invest->return_date != null): ?>
                                    <?php echo e(dateTime($invest->return_date)); ?>

                                <?php endif; ?>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Profit Return Times'); ?>">
                                <?php if($invest->how_many_times == 0 && $invest->status == 1): ?>
                                    <span class="custom-badge bg-success badge-pill"><?php echo app('translator')->get('Completed'); ?></span>
                                <?php elseif($invest->how_many_times == null && $invest->status == 0): ?>
                                    <span class="custom-badge bg-success badge-pill"><?php echo app('translator')->get('Life Time'); ?></span>
                                <?php else: ?>
                                    <span class="custom-badge bg-success badge-pill"><?php echo e($invest->how_many_times); ?><?php echo app('translator')->get(' times'); ?></span>
                                <?php endif; ?>
                            </td>


                            <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                <?php if(($invest->how_many_times == null || $invest->how_many_times != 0) && $invest->status == 0 ): ?>
                                    <?php if(now()->gt(optional($invest->property)->expire_date) && optional($invest->property)->is_payment == 0): ?>
                                        <button class="btn btn-sm  btn-outline-primary btn-rounded btn-sm investPaymentSingleUser "
                                                type="button"
                                                data-route="<?php echo e(route('admin.investPaymentSingleUser', $invest->id)); ?>"
                                                data-property="<?php echo e($invest); ?>"
                                                data-toggle="modal"
                                                data-target="#investPaymentSingleUserModal">
                                            <span>
                                                <i class="fa fa-credit-card"></i> <?php echo app('translator')->get(' Pay Manually Single User'); ?>
                                            </span>
                                        </button>
                                    <?php else: ?>
                                        --
                                    <?php endif; ?>
                                <?php else: ?>
                                    --
                                <?php endif; ?>
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

    <?php if(!$investedUser->isEmpty()): ?>
        <div class="modal fade" id="investPaymentSingleUserModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title"><?php echo app('translator')->get('Payment now'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="post" id="investPaymentSingleUserForm">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" name="amount" class="form-control edit_time pay_amount"
                                           value="">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><?php echo app('translator')->get(config('basic.currency_symbol')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">
                                <span><?php echo app('translator')->get('Cancel'); ?></span>
                            </button>
                            <button type="submit" class="btn btn-primary btn-rounded">
                                <span><i class="fas fa-save"></i> <?php echo app('translator')->get('Submit'); ?></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>


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

    <script>
        'use strict'
        $(document).ready(function () {
            $(document).on('click', '.investPaymentSingleUser', function () {
                let dataProperty = $(this).data('property');
                $('.pay_amount').val(dataProperty.net_profit);
                $('#investPaymentSingleUserForm').attr('action', $(this).data('route'))
            })

            $(document).on('input', '#actualGetProfit', function () {
                let actual_profit = $('#actualGetProfit').val();
                let investAmount = $('.invest_amount').val();
                let actualAmount = investAmount * actual_profit / 100;
                let netActualAmount = actualAmount.toFixed(2);
                $('.pay_amount').val(netActualAmount);
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chaincity_update\project\resources\views/admin/property/investedUserList.blade.php ENDPATH**/ ?>