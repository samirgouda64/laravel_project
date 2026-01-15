$(document).ready(function () {

    $('#tabs_profile').click('leaveauth', function (event, ui) {
	    isDelete= false;
		isEdit = false;

		var oTable2 = $('#dtbldept').dataTable();
		$(oTable2.fnSettings().aoData).each(function (){
		$(this.nTr).removeClass('success');
		});
    });

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
						
            { "data": "sl_no" },
            { "data": "dept_name","sWidth":"30%"},
            { "data": "dept_type"},
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

		$('#divModaldept').modal('show');
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
				}
				else if (result.dbStatus === 'FAILURE') {
					toastr.error(result.dbMessage);
					$('#divModaldept').modal('hide');
				}
				else if (result.dbStatus === 'EXIST') {
					toastr.error(result.dbMessage);
					$('#divModaldept').modal('hide');
				}
				else if (result.dbStatus === 'NOT_VALID') {
					toastr.error(result.dbMessage);
					$('#divModaldept').modal('hide');
				}
			},
			error:function(responsedata)
			{

			}
		});
	});

	/* Edit Department */
	$('#depteditbtn').click(function () {

		if (isEdit) {

			$("#lblModalDept").html('UPDATE');
			$("#deptbtnSave").html('<i class="fa fa-pencil"></i> Update');

			$('#divModaldept').modal('show');

		} else {
			toastr.error("Please select a record");
		}
	});

	$('#dtbldept').DataTable().on( 'search.dt', function () {
	    isEdit = false;	
		isDelete = false;
		var oTable = $('#dtbldept').dataTable();
		$(oTable.fnSettings().aoData).each(function (){
			$(this.nTr).removeClass('success');
		});
	});

	$('#dtbldept tbody').on('click','tr' ,function (event) {
		var fdata = $('#dtbldept').dataTable().fnGetData(this);
		console.log(fdata);
		if(fdata != null)
		{
			var data = dtbldept.row(this).data();
			isEdit = true;	
			isDelete = true;
			var oTable = $('#dtbldept').dataTable();			
				$(oTable.fnSettings().aoData).each(function (){
				$(this.nTr).removeClass('success');
			});
			
			$(event.target.parentNode).addClass('success');
			$('#hidcodedept').val(data.dept_code);//GETTING VALUE FOR HIDDEN COLUMN
			$('#hidDeptname').val(data.dept_name);//GETTING VALUE FOR HIDDEN COLUMN
			$('#txtcodedept').val(data.dept_code);
			$('#txtdescriptiondept').val(data.dept_name);
			
		}
	});



});
