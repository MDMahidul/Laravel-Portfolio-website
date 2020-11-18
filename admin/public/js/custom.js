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
                        "<td><a class='serviceEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='serviceDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#service_table')
                });


                //Service Table Delete Icon Click
                $('.serviceDeleteBtn').click(function() {
                    var id = $(this).data('id');

                    $('#serviceDeleteId').html(id);
                    $('#deleteModal').modal('show');
                });


                //Service Table Edit Icon Click
                $('.serviceEditBtn').click(function() {
                    var id = $(this).data('id');
                    $('#serviceEditId').html(id);

                    ServiceUpdateDetails(id);

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


//Service Delete Modal Yes Button
$('#serviceDeleteConfirmBtn').click(function() {
    var id = $('#serviceDeleteId').html();
    ServiceDelete(id);
})

//Service Delete
function ServiceDelete(deleteID) {

    $('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //set loadin animation

    axios.post('/ServiceDelete', {
            id: deleteID
        })
        .then(function(response) {
            $('#serviceDeleteConfirmBtn').html("Yes");

           if(response.status==200){
            if (response.data == 1) {
                $('#deleteModal').modal('hide');
                toastr.success('Delete Successfully');
                getServicesData();
            } else {
                $('#deleteModal').modal('hide');
                toastr.error('Delete Failed');
                getServicesData();
            }
           }else{
            $('#deleteModal').modal('hide');
            toastr.error('Something Went Wrong !');
           }

        }).catch(function(error) {
            $('#deleteModal').modal('hide');
            toastr.error('Something Went Wrong !');
        });
}


//Each Service Update Details
function ServiceUpdateDetails(detailsID) {
    axios.post('/ServiceDetails', {
            id: detailsID
        })
        .then(function(response) {

            if (response.status == 200) {
                $('#serviceEditForm').removeClass('d-none');
                $('#serviceEditLoader').addClass('d-none');
                $('#serviceEditWrong').addClass('d-none');

                var jsonData = response.data;
                $('#serviceNameID').val(jsonData[0].service_name);
                $('#serviceDesID').val(jsonData[0].service_des);
                $('#serviceImgID').val(jsonData[0].service_img);
            }else{
                $('#serviceEditLoader').addClass('d-none');
                $('#serviceEditWrong').removeClass('d-none');
            }

        }).catch(function(error) {
            $('#serviceEditLoader').addClass('d-none');
            $('#serviceEditWrong').removeClass('d-none');
        });
}


 //Service Update Modal Save Button
 $('#serviceEditConfirmBtn').click(function() {
    var id = $('#serviceEditId').html();
    var name = $('#serviceNameID').val();
    var des = $('#serviceDesID').val();
    var img = $('#serviceImgID').val();

    ServiceUpdate(id,name,des,img);
})

//Each Service Update Data
function ServiceUpdate(serviceID,serviceName,serviceDes,serviceImg) {

   if(serviceName.length==0){
        toastr.error('Service Name Required');
    }
    else if(serviceDes.length==0){
        toastr.error('Service Description Required');
    }
    else if(serviceImg.length==0){
        toastr.error('Service Image Required');
    }
    else{
        $('#serviceEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //set loadin animation
        axios.post('/ServiceUpdate', {
            id: serviceID,
            name: serviceName,
            des: serviceDes,
            img: serviceImg
        })
        .then(function(response) {
            $('#serviceEditConfirmBtn').html("Save");
            if(response.status==200){
                if (response.data == 1) {
                    $('#editModal').modal('hide');
                    toastr.success('Data Update Successfully');
                    getServicesData();
                } else {
                    $('#editModal').modal('hide');
                    toastr.error('Data Update Failed');
                    getServicesData();
                }
            }else{
                $('#editModal').modal('hide');
                toastr.error('Something Went Wrong !');
            }
            
        }).catch(function(error) {
            $('#editModal').modal('hide');
            toastr.error('Something Went Wrong !');
        });
    }
   
}