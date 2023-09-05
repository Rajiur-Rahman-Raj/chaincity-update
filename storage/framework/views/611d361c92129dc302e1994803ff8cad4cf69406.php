<?php $__env->startSection('title', trans($title)); ?>

<?php $__env->startSection('content'); ?>
    <?php if(count($allBlogs) > 0): ?>
        <!-- blog section  -->
        <section class="blog-page blog-details">
            <div class="container">
                <div class="row g-lg-5">
                    <div class="col-lg-8">
                        <?php $__empty_1 = true; $__currentLoopData = $allBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="blog-box">
                                <div class="img-box">
                                    <img src="<?php echo e(getFile(config('location.blog.path'). @$blog->image)); ?>"
                                         class="img-fluid" alt="<?php echo app('translator')->get('blog image'); ?>"/>
                                </div>
                                <div class="text-box">
                                    <div class="date-author">
                                        <span><i class="fal fa-clock"></i> <?php echo e(dateTime(@$blog->created_at, 'M d, Y')); ?> </span>
                                        <span><i class="fal fa-user-circle"></i> <?php echo app('translator')->get(optional(@$blog->details)->author); ?> </span>
                                    </div>
                                    <a href="<?php echo e(route('blogDetails',[slug(@$blog->details->title), $blog->id])); ?>"
                                       class="title"><?php echo e(\Illuminate\Support\Str::limit(optional(@$blog->details)->title, 100)); ?></a>
                                    <p>
                                        <?php echo e(Illuminate\Support\Str::limit(strip_tags(optional(@$blog->details)->details),500)); ?>

                                    </p>
                                    <a href="<?php echo e(route('blogDetails',[slug(@$blog->details->title), $blog->id])); ?>"
                                       class="btn-custom mt-3"><?php echo app('translator')->get('Read more'); ?></a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>

                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <?php echo e($allBlogs->links()); ?>

                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-4">
                        <div class="side-bar">
                            <div class="side-box">
                                <form action="<?php echo e(route('blogSearch')); ?>" method="get">
                                    <h4><?php echo app('translator')->get('Search here'); ?></h4>

                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" id="search"
                                               placeholder="<?php echo app('translator')->get('search'); ?>" value="<?php echo e(old('value', request()->search)); ?>"/>
                                        <button type="submit"><i class="fal fa-search" aria-hidden="true"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="side-box">
                                <h4><?php echo app('translator')->get('Recent Blogs'); ?></h4>
                                <?php $__currentLoopData = $allBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="blog-box">
                                        <div class="img-box">
                                            <img class="img-fluid" src="<?php echo e(getFile(config('location.blog.path'). @$blog->image)); ?>" alt="<?php echo app('translator')->get('blog image'); ?>"/>
                                        </div>
                                        <div class="text-box">
                                            <span class="date"><?php echo e(dateTime(@$blog->created_at, 'M d, Y')); ?></span>
                                            <a href="<?php echo e(route('blogDetails',[slug(@$blog->details->title), $blog->id])); ?>" class="title"><?php echo e(\Illuminate\Support\Str::limit(optional(@$blog->details)->title, 40)); ?></a>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="side-box">
                                <h4><?php echo app('translator')->get('Categories'); ?></h4>
                                <ul class="links">
                                    <?php $__currentLoopData = $blogCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e(route('CategoryWiseBlog', [slug(@$category->details->name), $category->id])); ?>"><?php echo app('translator')->get(optional(@$category->details)->name); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
        <div class="custom-not-found">
            <img src="<?php echo e(asset($themeTrue.'img/no_data_found.png')); ?>" alt="not found"
                 class="img-fluid">
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xammp\htdocs\chaincity_update\project\resources\views/themes/original/blog.blade.php ENDPATH**/ ?>