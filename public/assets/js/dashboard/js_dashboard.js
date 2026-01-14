$(document).ready(function(){

    $('#btnFacultyAdd').click(function()    
    {
        $('#divModalFaculty').modal('show');
        
    });

var btnText_Category_setup = `<button class="btn btn-info btn-sm me-1" onclick="edit_category(event)"><i class="fa-solid fa-pen-to-square"></i></button><button class="btn btn-danger btn-sm" onclick="delete_Category(event)"><i class="fa-solid fa-trash"></i></button>`;
var dtblCategory = $('#dtblCategory').DataTable({
    ajax: url,
    paging: true,
    stateSave: true,
    lengthChange: true,
    searching: true,
    ordering: false,
    info: true,
    autoWidth: false,
    retrieve: true,
    dom:
        "<'row mb-2'<'col-lg-5 col-md-6 categorygroupbutton'>\<'col-lg-4 col-md-6'l><'col-lg-3'f>>" +"t" +"<'row mt-2'<'col-lg-6'i><'col-lg-6'p>>",
    columns: [
        { data: 'no', width: "10%", className: "text-center" },
        { data: 'category_name', width: "50%" },
        {
            data: null,
            className: "text-center",
            orderable: false,
            render: function () {
                return btnText_Category_setup;
            }
        }
    ]
});

$("div.categorygroupbutton").html(`<button id="categoryaddbtn" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</button>`);


});