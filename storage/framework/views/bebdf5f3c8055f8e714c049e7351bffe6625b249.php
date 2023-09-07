<?php $__env->startSection('title', trans('Investor Details')); ?>

<?php $__env->startSection('content'); ?>
    <!-- Investor profile section -->
    <section class="agent-profile-section">
        <div class="overlay">
            <div class="container">
                <div class="row g-lg-5 g-4">
                    <div class="col-lg-8">
                        <div class="agent-box">
                            <div class="img-box">
                                <img src="<?php echo e(asset(getFile(config('location.user.path').$investorInfo->image))); ?>"
                                     class="img-fluid profile" alt="<?php echo app('translator')->get('not found'); ?>"/>


                                <div
                                    class="property-count"> <?php echo app('translator')->get('Total'); ?> <?php echo e(optional(optional($properties[0]->getInvestment[0])->user)->countTotalInvestment() == 1 ? trans('Property') : trans('Properties')); ?> (<?php echo e(optional(optional($properties[0]->getInvestment[0])->user)->countTotalInvestment()); ?>) </div>
                                </div>
                            <div class="text-box">
                                <h4 class="agent-name"><?php echo app('translator')->get($investorInfo->fullname); ?></h4>
                                <span
                                    class="title"><span><?php echo app('translator')->get('Member since'); ?> <?php echo e($investorInfo->created_at->format('M Y')); ?></span></span>
                                <ul>

                                    <?php if($investorInfo->address): ?>
                                        <li>
                                            <i class="fal fa-map-marker-alt" aria-hidden="true"></i>
                                            <span><?php echo app('translator')->get($investorInfo->address); ?></span>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>

                        <!-- agent description -->
                        <div class="agent-description">
                            <div class="navigator">
                                <button tab-id="tab1" class="tab active"><?php echo app('translator')->get('Description'); ?></button>
                                <button tab-id="tab2" class="tab"><?php echo app('translator')->get('Running Properties'); ?>
                                    (<?php echo e(count($properties)); ?>)
                                </button>
                            </div>
                            <!-- description -->
                            <div id="tab1" class="content active">
                                <p>
                                    <?php echo app('translator')->get(optional(optional($properties[0]->getInvestment[0])->user)->bio); ?>
                                </p>
                            </div>

                            <div id="tab2" class="content">
                                <h4><?php echo app('translator')->get('Properties'); ?></h4>
                                <div class="row g-4">
                                    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-12">
                                                <?php echo $__env->make($theme.'partials.propertyBox', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            <?php echo e($properties->appends($_GET)->links()); ?>

                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="side-bar">
                            <div class="side-box">
                                <h4><?php echo app('translator')->get('Send a Message'); ?></h4>
                                <form action="<?php echo e(route('user.sendMessageToPropertyInvestor')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="investor_id" value="<?php echo e(optional(optional($properties[0]->getInvestment[0])->user)->id); ?>">
                                    <div class="row g-3">
                                        <div class="input-box col-12">
                                            <input class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name"
                                                   type="text"
                                                   <?php if(\Auth::check() == true): ?>
                                                       <?php if(\Auth::user()->id == optional(optional($properties[0]->getInvestment[0])->user)->id): ?>
                                                           placeholder="<?php echo app('translator')->get('Full name'); ?>"
                                                   <?php else: ?>
                                                       value="<?php echo app('translator')->get(\Illuminate\Support\Facades\Auth::user()->fullname); ?>"
                                                   <?php endif; ?>
                                                   <?php else: ?>
                                                       placeholder="<?php echo app('translator')->get('Full name'); ?>"
                                                <?php endif; ?>/>
                                            <div class="invalid-feedback">
                                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo app('translator')->get($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="input-box col-12">
                                            <textarea class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                      cols="30" rows="3" name="message"
                                                      placeholder="<?php echo app('translator')->get('Your message'); ?>"></textarea>
                                            <div class="invalid-feedback">
                                                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo app('translator')->get($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="input-box col-12">
                                            <button class="btn-custom w-100" type="submit"><?php echo app('translator')->get('submit'); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <?php $__env->startPush('frontendModal'); ?>
        <?php echo $__env->make($theme.'partials.investNowModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset($themeTrue.'js/investNow.js')); ?>"></script>
    <script>
        'use strict'
        var isAuthenticate = '<?php echo e(Auth::check()); ?>';

        $(document).ready(function () {
            $('.wishList').on('click', function () {
                var _this = this.id;
                let property_id = $(this).data('property');
                if (isAuthenticate == 1) {
                    wishList(property_id, _this);
                } else {
                    window.location.href = '<?php echo e(route('login')); ?>';
                }
            });
        });

        function wishList(property_id = null, id = null) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('user.wishList')); ?>",
                type: "POST",
                data: {
                    property_id: property_id,
                },
                success: function (data) {
                    if (data.data == 'added') {
                        $(`.save${id}`).removeClass("fal fa-heart");
                        $(`.save${id}`).addClass("fas fa-heart");
                        Notiflix.Notify.Success("Wishlist added");
                    }
                    if (data.data == 'remove') {
                        $(`.save${id}`).removeClass("fas fa-heart");
                        $(`.save${id}`).addClass("fal fa-heart");
                        Notiflix.Notify.Success("Wishlist removed");
                    }
                },
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xammp\htdocs\chaincity_update\project\resources\views/themes/original/investorProfile.blade.php ENDPATH**/ ?>