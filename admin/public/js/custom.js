//For Courses Table(showing data)
function getProjectsData() {

    axios.get('/getProjectsData')
        .then(function(response) {
    
            if (response.status == 200) {
    
                $('#mainDivProject').removeClass('d-none');
                $('#loaderDivProject').addClass('d-none');
    
                 //to refresh the table
                $('#projectDataTable').DataTable().destroy();
                $('#project_table').empty();
    
                var jsonData = response.data;
    
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
    
                        "<td>"+ jsonData[i].project_name +"</td>" +
                        "<td>" + jsonData[i].project_des + "</td>" +
    
                        "<td><a class='projectEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        
                        "<td><a class='projectDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
    
                    ).appendTo('#project_table')
                });
    
              /*  //Course Table Delete Icon Click
                $('.projectDeleteBtn').click(function() {
                    var id = $(this).data('id');
    
                    $('#CourseDeleteId').html(id);
                    $('#deleteCourseModal').modal('show');
                });
    
                //Course Table Update Icon Click
                $('.projectEditBtn').click(function() {
                    var id = $(this).data('id');
                    $('#courseEditId').html(id);
                    CourseUpdateDetails(id);
                    $('#updateCourseModal').modal('show');
                }); */
    
    
                 //add data table libraies
                $('#projectDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');
    
    
            } else {
    
                $('#loaderDivProject').addClass('d-none');
                $('#wrongDivProject').removeClass('d-none');
            }
    
        }).catch(function(error) {
    
            $('#loaderDivProject').addClass('d-none');
            $('#wrongDivProject').removeClass('d-none');
    
        });
    }