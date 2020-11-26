//For Courses Table(showing data)
function getContactData() {

    axios.get('/getContactData')
        .then(function(response) {
    
            if (response.status == 200) {
    
                $('#mainDivContact').removeClass('d-none');
                $('#loaderDivContact').addClass('d-none');
    
                 //to refresh the table
                $('#contactDataTable').DataTable().destroy();
                $('#contact_table').empty();
    
                var jsonData = response.data;
    
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
    
                        "<td>"+ jsonData[i].contact_name +"</td>" +
                        "<td>" + jsonData[i].contact_mobile + "</td>" +
                        "<td>" + jsonData[i].contact_email + "</td>" +
                        "<td>" + jsonData[i].contact_msg + "</td>" +
                        
                        "<td><a class='contactDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
    
                    ).appendTo('#contact_table')
                });
    
                //Course Table Delete Icon Click
                $('.contactDeleteBtn').click(function() {
                    var id = $(this).data('id');
    
                    $('#ContactDeleteId').html(id);
                    $('#deleteContactModal').modal('show');
                }); 
    
    
                 //add data table libraies
                $('#contactDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');
    
    
            } else {
    
                $('#loaderDivContact').addClass('d-none');
                $('#wrongDivContact').removeClass('d-none');
            }
    
        }).catch(function(error) {
    
            $('#loaderDivContact').addClass('d-none');
            $('#wrongDivContact').removeClass('d-none');
    
        });
}

//Service Delete Modal Yes Button
$('#ContactDeleteConfirmBtn').click(function() {
    var id = $('#ContactDeleteId').html();
    ContactDelete(id);
    })
    
//Service Delete
function ContactDelete(deleteID) {

    $('#ContactDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //set loadin animation

    axios.post('/ContactDelete', {
        id: deleteID
    })
    .then(function(response) {
        $('#ContactDeleteConfirmBtn').html("Yes");

        if(response.status==200){
            if (response.data == 1) {
                $('#deleteContactModal').modal('hide');
                toastr.success('Delete Successfully');
                getContactData();
            } else {
                $('#deleteContactModal').modal('hide');
                toastr.error('Delete Failed');
                getContactData();
            }
        }else{
        $('#deleteContactModal').modal('hide');
        toastr.error('Something Went Wrong !');
        }

    }).catch(function(error) {
        $('#deleteContactModal').modal('hide');
        toastr.error('Something Went Wrong !');
    });
}

