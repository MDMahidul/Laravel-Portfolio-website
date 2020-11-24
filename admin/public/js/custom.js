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
    
                //Course Table Delete Icon Click
                $('.projectDeleteBtn').click(function() {
                    var id = $(this).data('id');
    
                    $('#ProjectDeleteId').html(id);
                    $('#deleteProjectModal').modal('show');
                });
    
                 //Course Table Update Icon Click
                $('.projectEditBtn').click(function() {
                    var id = $(this).data('id');
                    $('#projectEditId').html(id);
                    ProjectUpdateDetails(id);
                    $('#updateProjectModal').modal('show');
                }); 
    
    
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

//Service Delete Modal Yes Button
$('#ProjectDeleteConfirmBtn').click(function() {
    var id = $('#ProjectDeleteId').html();
    ProjectDelete(id);
    })
    
//Service Delete
function ProjectDelete(deleteID) {

    $('#ProjectDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //set loadin animation

    axios.post('/ProjectsDelete', {
        id: deleteID
    })
    .then(function(response) {
        $('#ProjectDeleteConfirmBtn').html("Yes");

        if(response.status==200){
            if (response.data == 1) {
                $('#deleteProjectModal').modal('hide');
                toastr.success('Delete Successfully');
                getProjectsData();
            } else {
                $('#deleteProjectModal').modal('hide');
                toastr.error('Delete Failed');
                getProjectsData();
            }
        }else{
        $('#deleteProjectModal').modal('hide');
        toastr.error('Something Went Wrong !');
        }

    }).catch(function(error) {
        $('#deleteProjectModal').modal('hide');
        toastr.error('Something Went Wrong !');
    });
}


//Project Update details
function ProjectUpdateDetails(detailsID){
    axios.post('/ProjectsDetails', {
        id: detailsID
    })
    .then(function(response) {

        if (response.status == 200) {
            $('#projectEditForm').removeClass('d-none');
            $('#projectEditLoader').addClass('d-none');
            $('#projecteEditWrong').addClass('d-none');

            var jsonData = response.data;
            $('#projectNameUpdateID').val(jsonData[0].project_name);
            $('#projecteDesUpdateID').val(jsonData[0].project_des);
            $('#projecteLinkUpdateID').val(jsonData[0].project_link);
            $('#projectImgUpdateID').val(jsonData[0].project_img);
        }else{
            $('#projectEditLoader').addClass('d-none');
            $('#projectEditWrong').removeClass('d-none');
        }

    }).catch(function(error) {
        $('#projectEditLoader').addClass('d-none');
        $('#projectEditWrong').removeClass('d-none');
    });
}


//Project Update Modal Save Button
$('#ProjectUpdateConfirmBtn').click(function() {

    var projectID = $('#projectEditId').html();
    var projectName = $('#projectNameUpdateID').val();
    var projectDes = $('#projecteDesUpdateID').val();
    var projectLink = $('#projecteLinkUpdateID').val();
    var projectImg = $('#projectImgUpdateID').val();
    
    ProjectUpdate(projectID, projectName, projectDes, projectLink,projectImg);
    })
    
    //Each Course Update Data
    function ProjectUpdate(ProjectID,ProjectName, ProjectDes, ProjectLink, ProjectImg) {
    
    if (ProjectName.length == 0) {
        toastr.error('Project Name Required');
    } 
    else if (ProjectDes.length == 0) {
        toastr.error('Project Description Required');
    }  
    else if (ProjectLink.length == 0) {
        toastr.error('Project Link Required');
    } 
    else if (ProjectImg.length == 0) {
        toastr.error('Project Image Required');
    } 
    else {
        $('#ProjectUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //set loadin animation
        axios.post('/ProjectsUpdate', {
                id: ProjectID,
                project_name: ProjectName,
                project_des: ProjectDes,
                project_link: ProjectLink,
                project_img: ProjectImg
            })
            .then(function(response) {
                $('#ProjectUpdateConfirmBtn').html("Save");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#updateProjectModal').modal('hide');
                        toastr.success('Data Update Successfully');
                        getProjectsData();
                    } else {
                        $('#updateProjectModal').modal('hide');
                        toastr.error('Data Update Failed');
                        getProjectsData();
                    }
                } else {
                    $('#updateProjectModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }
    
            }).catch(function(error) {
                $('#updateProjectModal').modal('hide');
                toastr.error('Something Went Wrong !');
            });
    }
    
    }