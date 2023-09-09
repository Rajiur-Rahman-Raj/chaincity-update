<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('Blog List'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="media mb-4 float-right">
                <a href="<?php echo e(route('admin.blogCreate')); ?>" class="btn btn-sm btn-primary btn-rounded mr-2">
                    <span><i class="fa fa-plus-circle"></i> <?php echo app('translator')->get('Create New'); ?></span>
                </a>
            </div>

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered" id="zero_config">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><?php echo app('translator')->get('SL No.'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Category'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Author'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Title'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('status'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td data-label="<?php echo app('translator')->get('SL No.'); ?>"><?php echo e($loop->index+1); ?></td>
                            <td data-label="<?php echo app('translator')->get('Category'); ?>">
                                <?php echo app('translator')->get(optional($blog->category->details)->name); ?>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Category'); ?>">
                                <?php echo app('translator')->get(optional($blog->details)->author); ?>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Category'); ?>">
                                <?php echo app('translator')->get(optional($blog->details)->title); ?>
                            </td>
                            <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                <span class="custom-badge <?php echo e($blog->status == 1 ? 'bg-success' : 'bg-danger'); ?>"><?php echo app('translator')->get($blog->status == 1 ? 'Active' : 'Deactive'); ?></span>
                            </td>
                            <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                <a href="<?php echo e(route('admin.blogEdit',$blog->id)); ?>" class="btn btn-sm btn-outline-primary btn-rounded edit-button">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
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

    <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="primary-header-modalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header modal-colored-header bg-primary">
                   <h4 class="modal-title" id="primary-header-modalLabel"><?php echo app('translator')->get('Delete Confirmation'); ?>
                   </h4>
                   <button type="button" class="close" data-dismiss="modal"
                           aria-hidden="true">×
                   </button>
               </div>
               <div class="modal-body">
                   <p><?php echo app('translator')->get('Are you sure to delete this?'); ?></p>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger btn-rounded"
                           data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                   <form action="" method="post" class="deleteRoute">
                       <?php echo csrf_field(); ?>
                       <?php echo method_field('delete'); ?>
                       <button type="submit" class="btn btn-primary btn-rounded"><?php echo app('translator')->get('Yes'); ?></button>
                   </form>
               </div>
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

    <script>
        'use strict'
        $('.notiflix-confirm').on('click', function () {
            var route = $(this).data('route');
            $('.deleteRoute').attr('action', route)
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chaincity_update\project\resources\views/admin/blog/blogList.blade.php ENDPATH**/ ?>