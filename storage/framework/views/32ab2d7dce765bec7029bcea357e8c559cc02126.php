

<?php $__env->startSection('content'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo e(__('Employees')); ?></h1>

    <!-- Main Content goes here -->

    <div class="card shadow mb-4">
    </br>
    <form class="form-horizontal"  id="form1" method="GET" action="<?php $_PHP_SELF ?>">
    <div class="col-12 text-right">
              <a href="<?php echo e(route('create_employees')); ?>" class="btn btn-sm btn-primary btn-round btn-icon">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                <span class="btn-inner--text">Create Employees</span>
              </a>
            </div>
   
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>CompanyID</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                            
                       <tbody>
                                       
                        </tbody>
                    </table>
                    </div>
                </div>
            </form>
        </div>

    <!-- End of Main Content -->

     <!-- Edit Modal-->
     <div class="modal fade" id="edit-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Edit Employee')); ?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="edit-form" action="<?php echo e(route('employees.update')); ?>" method="POST" >
                    <?php echo csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">First Name</label>
                        <div class="col-sm-4">
                        <input type="text" name="first_name" id="first_name" class="form-control first_name">
                        
                        </div>
                        <label  class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-4">
                        <input type="text" name="last_name" id="last_name" class="form-control last_name">               
                        </div>
                                      
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-4">
                        <input type="text" name="email" id="email" class="form-control email">
                        
                        </div>
                        <label  class="col-sm-2 control-label">Company</label>
                        <div class="col-sm-4">
                        <select name="company" id="company" class="form-control company">
                        <option value="">Please Select...</option>
                            <?php $__currentLoopData = $company; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($data->id); ?>"><?php echo e($data->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>                  
                        </div>
                                      
                    </div>

                <input type="hidden" name="user_id" id="user_id" class="form-control"> 
                </div>   
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                <button type="submit" class="btn btn-primary">Save</button>
                
            </div>
            </form>
        </div>
    </div>
</div>

    <!-- Delete Modal-->
    <div class="modal fade" id="delete-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Delete Employee')); ?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure?
            <form id="delete-form" action="<?php echo e(route('employees.delete')); ?>" method="POST" >
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="user_id" id="user_id" class="form-control"> 
                   
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                <button type="submit" class="btn btn-primary">Save</button>
                
            </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>
<script>
   
$(document).ready( function () {
   
    $('#start_date').on('change', function () {
		  $('#form1').submit(); 

	});
    $('#end_date').on('change', function () {
		  $('#form1').submit(); 

	});

    var tbl = $('#dataTable').DataTable({
		"scrollX": true,
		"responsive": true,
		"lengthChange": true,
		"autoWidth": true,
		"ajax": {
            "headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			"url": "<?php echo e(route('datauser')); ?>",
			"type": "POST",
			"data": function(d){
				d.startdate = $('#start_date').val();
				d.enddate = $('#end_date').val();
               
				
			}
		},
		"columnDefs": [ {"targets": 1,"className" : 'text-left', "width" :"300px"},
        {"targets": '_all',"className" : 'text-center'},
        {"targets": 5,"visible": false,"searchable": false},
            {
            "targets": 6,
            "data": null,
			 "render": function ( data, type, row, meta ) {
				 if (data[0]=='' || data[0]== null){
					return '';
				 }else{		
					return '<a class="btn-sm btn-success btn-round btn-icon" id="edit-click" data-user-id="'+data[0]+'" data-first-name="'+data[1]+'" data-last-name="'+data[2]+'" data-email="'+data[3]+'" data-company="'+data[5]+'" data-toggle="modal" data-target="#edit-modal"><i class="fa fa-pen"></i></a>'+' '+
                    '<a class="btn-sm btn-danger btn-round btn-icon" id="delete-click" data-user-id="'+data[0]+'" data-toggle="modal" data-target="#delete-modal"><i class="fa fa-trash"></i></a>';
                 }
				}
		
            },
            {
            "targets": 4,
            "data": null,
			 "render": function ( data, type, row, meta ) {
				 if (data[4]=='' || data[4]== null){
					return '';
				 }else{		
					return '<a class="btn-sm btn-dark btn-round btn-icon" href="detail_company/'+data[5]+'" target="_blank">'+data[4]+'</a>';
                 }
				}
		
            }

		],createdRow: function(row){
			   $(row).find(".truncate").each(function(){
			   $(this).attr("title", this.innerText);
		       });
		   }
		,
		dom: 'Bfrtip',
//		stateSave: true,
        lengthMenu: [
            [ 10,15, 25, 50, -1 ],
            [ '10 rows','15 rows', '25 rows', '50 rows', 'Show all' ]
        ],
		buttons: [
        'pageLength','copy', 'csv', 'excel', 'pdf'
		],

		}

		
	);


    $(document).on('click', "#delete-click", function() {
            $(this).addClass('clicked');
            var id = $(this).data('user-id');
 
            $(".modal-body #user_id").val( id );

            var options = {
              'backdrop': 'static'
            };
            $('#delete-modal').modal(options)
          })

 
          // on modal hide
          $('#delete-modal').on('hide.bs.modal', function() {
            $('.clicked').removeClass('clicked')
            $("#delete-form").trigger("reset");
          })

    $(document).on('click', "#edit-click", function() {
            $(this).addClass('clicked');
            var id = $(this).data('user-id');
            var email = $(this).data('email');
            var first_name = $(this).data('first-name');
            var last_name = $(this).data('last-name');
            var company = $(this).data('company');
          
            $(".modal-body #user_id").val( id );
            $(".modal-body #email").val( email );
            $(".modal-body #first_name").val( first_name );
            $(".modal-body #last_name").val( last_name );
            $(".modal-body #company").val( company );
        
  
            var options = {
              'backdrop': 'static'
            };
            $('#edit-modal').modal(options)
          })

 
          // on modal hide
          $('#edit-modal').on('hide.bs.modal', function() {
            $('.clicked').removeClass('clicked')
            $("#edit-form").trigger("reset");
          })


});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\grtech\resources\views/employees.blade.php ENDPATH**/ ?>