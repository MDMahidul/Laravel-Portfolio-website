//visitor Page Table
$(document).ready(function() {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});


//For Services Table(showing data)
function getServicesData() {

    axios.get('/getServicesData')
        .then(function(response) {

            if (response.status == 200) {

                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

                $('#service_table').empty();

                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $('<tr>').html(

                        "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                        "<td>" + jsonData[i].service_name + "</td>" +
                        "<td>" + jsonData[i].service_des + "</td>" +
                        "<td><a class='serviceEditBtn' ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='serviceDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#service_table')
                });


                //Service Table Delete Icon Click
                $('.serviceDeleteBtn').click(function() {
                    var id = $(this).data('id');

                    $('#serviceDeleteId').html(id);
                    $('#deleteModal').modal('show');
                });


                //Service Delete Modal Yes Button
                $('#serviceDeleteConfirmBtn').click(function() {
                    var id = $('#serviceDeleteId').html();
                    ServiceDelete(id);
                })

                //Service Table Edit Icon Click
                $('.serviceEditBtn').click(function() {

                    $('#editModal').modal('show');
                });

            } else {

                $('#loaderDiv').addClass('d-none');
                $('#wrongDiv').removeClass('d-none');
            }

        }).catch(function(error) {

            $('#loaderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');

        });
}


//Service Delete
function ServiceDelete(deleteID) {
    axios.post('/ServiceDelete', {
            id: deleteID
        })
        .then(function(response) {

            if (response.data == 1) {
                $('#deleteModal').modal('hide');
                toastr.success('Delete Successfully');
                getServicesData();
            } else {
                $('#deleteModal').modal('hide');
                toastr.error('Delete Failed');
                getServicesData();
            }

        }).catch(function(error) {


        });
}