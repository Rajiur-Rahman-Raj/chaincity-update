<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('Profit Return Schedule'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="bd-callout bd-callout-warning m-0 m-md-4 my-4 m-md-0">
        <i class="fas fa-info-circle mr-2 text-warning"></i> You can now set how often you will return the profits to the investors. If you want to give daily profit return to your investors then create 1 day schedule. And select 1 day while <a href="<?php echo e(route('admin.propertyCreate')); ?>" target="_blank">creating investment property.</a>. Then your investors will get daily profit return
    </div>

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">

        <div class="card-body">
            <?php if(adminAccessRoute(config('role.manage_property.access.add'))): ?>
            <button class="btn btn-sm  btn-primary btn-rounded float-right mb-2 ml-3" type="button"
                    data-toggle="modal"
                    data-target="#addModal">
                <span><i class="fas fa-plus"></i> <?php echo app('translator')->get('Create New'); ?></span>
            </button>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered" id="zero_config">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><?php echo app('translator')->get('Duration'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Duration Type'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                        <?php if(adminAccessRoute(config('role.manage_property.access.edit'))): ?>
                            <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $manageTimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td data-label="<?php echo app('translator')->get('Duration'); ?>">
                                <?php echo app('translator')->get($item->time); ?>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Duration Type'); ?>">
                                <?php if($item->time_type == 'days' && $item->time == 1): ?>
                                    <?php echo app('translator')->get('Day'); ?>
                                <?php elseif($item->time_type == 'months' && $item->time == 1): ?>
                                    <?php echo app('translator')->get('Month'); ?>
                                <?php elseif($item->time_type == 'years' && $item->time == 1): ?>
                                    <?php echo app('translator')->get('Year'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get($item->time_type); ?>
                                <?php endif; ?>
                            </td>
                            <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                <span
                                    class="custom-badge badge-pill <?php echo e($item->status == 0 ? 'bg-danger' : 'bg-success'); ?>"><?php echo e($item->status == 0 ? 'Inactive' : 'Active'); ?></span>
                            </td>
                            <?php if(adminAccessRoute(config('role.manage_property.access.edit'))): ?>
                            <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                <button class="btn btn-sm  btn-outline-primary btn-rounded btn-sm edit-button" type="button"
                                        data-toggle="modal"
                                        data-target="#editModal"
                                        data-timetype="<?php echo e($item->time_type); ?>"
                                        data-time="<?php echo e($item->time); ?>"
                                        data-status="<?php echo e($item->status); ?>"
                                        data-route="<?php echo e(route('admin.update.schedule',['id'=>$item->id])); ?>">
                                    <span><i class="fas fa-edit"></i></span>
                                </button>
                            </td>
                            <?php endif; ?>
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

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><?php echo app('translator')->get('Create New Schedule'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.store.schedule')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">

                        <div class="form-group">
                            <label><?php echo app('translator')->get('Time'); ?></label>
                            <div class="input-group mb-3">
                                <input type="number" name="time" class="form-control" value="<?php echo e(old('time')); ?>" placeholder="<?php echo app('translator')->get('schedule time'); ?>">
                                <div class="input-group-append">
                                    <select name="time_type" id="time_type" class="form-control">
                                        <option value="days"><?php echo app('translator')->get('Day(s)'); ?></option>
                                        <option value="months"><?php echo app('translator')->get('Months(s)'); ?></option>
                                        <option value="years"><?php echo app('translator')->get('Year(s)'); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('Status'); ?></label>
                            <div class="input-group mb-3">
                                <select class="form-control  w-100 edit_status"
                                        data-live-search="true" name="status"
                                        required="">
                                    <option value="1"><?php echo e(trans('Active')); ?></option>
                                    <option value="0"><?php echo e(trans('Deactive')); ?></option>
                                </select>
                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e(trans($message)); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">
                            <span><?php echo app('translator')->get('Cancel'); ?></span>
                        </button>
                        <button type="submit" class="btn btn-primary btn-rounded">
                            <span><i class="fas fa-save"></i> <?php echo app('translator')->get('Save Changes'); ?></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><?php echo app('translator')->get('Edit Schedule'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="editForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('put'); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Time'); ?></label>
                            <div class="input-group mb-3">
                                <input type="number" name="time" class="form-control edit_time" value="<?php echo e(old('time')); ?>" placeholder="<?php echo app('translator')->get('schedule time'); ?>">
                                <div class="input-group-append">
                                    <select name="time_type" id="edit_time_type" class="form-control edit_time_type">
                                        <option value="days" ><?php echo app('translator')->get('Day(s)'); ?></option>
                                        <option value="months" ><?php echo app('translator')->get('Months(s)'); ?></option>
                                        <option value="years"><?php echo app('translator')->get('Year(s)'); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('Status'); ?></label>
                            <div class="input-group mb-3">
                                <select class="form-control w-100 edit_status"
                                        data-live-search="true" name="status"
                                        required="">
                                    <option value="1"><?php echo e(trans('Active')); ?></option>
                                    <option value="0"><?php echo e(trans('Deactive')); ?></option>
                                </select>
                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e(trans($message)); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">
                            <span><?php echo app('translator')->get('Cancel'); ?></span>
                        </button>
                        <button type="submit" class="btn btn-primary btn-rounded">
                            <span><i class="fas fa-save"></i> <?php echo app('translator')->get('Save Changes'); ?></span></button>
                    </div>
                </form>
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

    <script>
        "use strict";
        $(document).ready(function () {
            $(document).on('click', '.edit-button', function () {
                $('#editForm').attr('action', $(this).data('route'))
                $('.edit_time').val($(this).data('time'))
                $('.edit_time_type').val($(this).data('timetype'));
                $('.edit_status').val($(this).data('status'));
            })

        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chaincity_update\project\resources\views/admin/property/schedule.blade.php ENDPATH**/ ?>