

<?php $__env->startSection('content'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo e(__('Detail Company')); ?></h1>

    <div class="row">

        <div class="col-lg-12 order-lg-1">

            <div class="card shadow mb-4">

               

                <div class="card-body">

                    <form method="POST" action="<?php echo e(route('company.store')); ?>" autocomplete="off"  enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                        <input type="hidden" name="_method" value="POST">

                        <h6 class="heading-small text-muted mb-4">Company information</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Name<span class="small text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" disabled value="<?php echo e($company->name); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Email address<span class="small text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control" name="email" disabled value="<?php echo e($company->email); ?>">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                            <div class="col-lg-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="last_name">Website</label>
                                        <input type="text" id="website" class="form-control" name="website" disabled value="<?php echo e($company->website); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Logo</label>
                                        <img style="height: 180px; width: 180px;"  src="<?php echo e(asset('logo/'.$company->logo)); ?>" >
                                    </div>
                                </div>
                            </div>

                            
                        </div>

        
                    </form>

                </div>

            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grtech\resources\views/detail_company.blade.php ENDPATH**/ ?>