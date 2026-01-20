$(document).ready(function () {

    // $('#tabs_profile').click('leaveauth', function (event, ui) {
	//     isDelete= false;
	// 	isEdit = false;

	// 	var oTable2 = $('#dtbldept').dataTable();
    // });

    var dtbldept = $('#dtbldept').DataTable({
		"sAjaxSource":  "GET_DEPT_LIST",
		"bPaginate": true,
		"bStateSave": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort":false,
        "bStateSave": true,
        "bInfo": true,
        "bAutoWidth": false, 
        "bRetrieve": true,
        "pageLength": 7, 
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-8' <'row' <'col-xs-8 deptgroupbutton' >>><'col-xs-4'p>>",
		"aoColumns": [
			{ "data": "sl_no", "className": "text-center"},
            { "data": "dept_name","sWidth":"30%", "className": "text-center"},
            { "data": "dept_type", "className": "text-center"},
        ]
	});
	
	$("div.deptgroupbutton").html('<div class="btngroup"><button id="deptaddbtn" class="btn btn-primary custombtn"><i class="fa fa-plus"></i> Add</button>&nbsp;<button class="btn btn-warning custombtn" id="depteditbtn"><i class="fa fa-pencil"></i> Edit</button>&nbsp;<button class="btn btn-danger custombtn" id="deptdeletebtn"><i class="fa fa-trash-o"></i> Delete</button></div>');

   $('#deptaddbtn').click(function () {

		$("#lblModalDept").html('ADD');
		$('#deptbtnSave').html('<i class="fa fa-save"></i> Save');
		$('#hidcodedept').val('');
		$('#hidDeptname').val('');
		$('#txtdescriptiondept').val('');
		$('#cmbdeptType').val('');
		$('#frmdept')[0].reset();
		$('#divModaldept').modal('show');
		$('#cmbdeptType').prop('disabled', false);
	});


	$('#frmdept').off('submit').on('submit', function (e) {
		e.preventDefault();

		var deptId = $('#hidcodedept').val();
		var url = '';

		if (deptId === '') {
			url = 'InsertDepartment';
		} else {
			url = 'UpdateDepartment';
		}

		$.ajax({
			url: url,
			type: 'POST',
			data: $(this).serialize(),
			success: function (result) {

				if (result.dbStatus === 'SUCCESS') {
					toastr.success(result.dbMessage);
					$('#divModaldept').modal('hide');
					var dtbldept = $("#dtbldept").DataTable();
			 		dtbldept.ajax.reload(null, false);
					$('#dtbldept tbody tr').removeClass('table-success');

				}
				else if (result.dbStatus === 'FAILURE') {
					toastr.error(result.dbMessage);
					$('#divModaldept').modal('hide');
					var dtbldept = $("#dtbldept").DataTable();
					$('#dtbldept tbody tr').removeClass('table-success');

				}
				else if (result.dbStatus === 'EXIST') {
					toastr.error(result.dbMessage);
					$('#divModaldept').modal('hide');
					var dtbldept = $("#dtbldept").DataTable();
					$('#dtbldept tbody tr').removeClass('table-success');

				}
				else if (result.dbStatus === 'NOT_VALID') {
					toastr.error(result.dbMessage);
					$('#divModaldept').modal('hide');
					var dtbldept = $("#dtbldept").DataTable();
					$('#dtbldept tbody tr').removeClass('table-success');

				}
			},
			error:function(){
				toastr.error('Unable to process please contact support');
			}
		});
	});

	/* Edit Department */
	var selectedRowData = null;

	$('#dtbldept tbody').on('click', 'tr', function () {
		$('#dtbldept tbody tr').removeClass('table-success');

		$(this).addClass('table-success');

		var table = $('#dtbldept').DataTable();
		selectedRowData = table.row(this).data();
	});

	$('#depteditbtn').click(function () {

		if (selectedRowData == null) {
			toastr.error('Please select a row first');
			return;
		}

		$('#cmbdeptType').prop('disabled', true);
		$('#lblModalDept').html('EDIT');
		$('#deptbtnSave').html('<i class="fa fa-edit"></i> Update');

		// Fill form fields
		$('#hidcodedept').val(selectedRowData.dept_code);
		$('#txtdescriptiondept').val(selectedRowData.dept_name);
		$('#cmbdeptType').val(selectedRowData.dept_type);

		// Open modal
		$('#divModaldept').modal('show');
	});

	$('#deptdeletebtn').click(function (){
		if (selectedRowData == null) {
			toastr.error('Please select a row first');
			return;
		}
		var oper = 'DeleteDept';
		Swal.fire({
			title: 'Are you sure you want to delete?',
			text: "This action cannot be undone!",
			icon: 'warning',       
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: 'Cancel',
			reverseButtons: true,
			allowOutsideClick: false,
			width: 450,
    		padding: '2rem', 
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url:oper,
					type:'POST',
					data:{id:selectedRowData.id},
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					success: function(result){
						if(result.dbStatus == 'SUCCESS'){
							toastr.success(result.dbMessage);
							var dtbldept = $("#dtbldept").DataTable();
							dtbldept.ajax.reload(null, false);
							$('#dtbldept tbody tr').removeClass('table-success');
						}
						else if (result.dbStatus == 'FAILURE'){
							toastr.error(result.dbMessage);
							var dtbldept = $("#dtbldept").DataTable();
							$('#dtbldept tbody tr').removeClass('table-success');
						}
					},
					error:function(){
						toastr.error('Unable to process please contact support');
					}
				})
			}
		});

	});


});
