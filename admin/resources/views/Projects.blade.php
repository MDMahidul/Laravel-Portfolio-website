@extends('Layout.app')
@section('title','Projects')

@section('content')

<div id="mainDivProject" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">

            <button id="addNewProjectBtnId" class="btn my-3 btn-sm btn-danger">Add New</button>

        <table id="projectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
            <th class="th-sm">Name</th>
            <th class="th-sm">Description</th>
            <th class="th-sm">Edit</th>
            <th class="th-sm">Delete</th>
            </tr>
        </thead>
        <tbody id="project_table">
        	
        </tbody>
        </table>
        
        </div>
    </div>
</div>


<!-- loader div -->
<div id="loaderDivProject" class="container">
    <div class="row">
      <div class="col-md-12 text-center p-5">
  
       <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
      
      </div>
    </div>
  </div>
  
  <!-- went wrong div -->
  <div id="wrongDivProject" class="container d-none">
    <div class="row">
      <div class="col-md-12 text-center p-5">
        <h3>Something Went Wrong !</h3>
      </div>
    </div>
  </div>


  <!--Delete Modal -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-3 text-center">
                <h5 class="mt-4">Do You Want To Delete</h5>
                <h6 id="ProjectDeleteId" class="mt-4 d-none"></h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                <button  id="ProjectDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>
<!--Delete Modal end -->


  <!--Update Courses Modal -->
  <div class="modal fade" id="updateProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
              <h5 class="modal-title">Update Project</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
         </div>
        <div class="modal-body  text-center">
            <h6 id="projectEditId" class="mt-4 d-none"></h6>
            <div id="projectEditForm" class="w-100 d-none">
                <input type="text" id="projectNameUpdateID" class="form-control mb-4" placeholder="Project Name">
                <input type="text" id="projecteDesUpdateID" class="form-control mb-4" placeholder="Project Description">
                <input type="text" id="projecteLinkUpdateID" class="form-control mb-4" placeholder="Project Link">
                <input type="text" id="projectImgUpdateID" class="form-control mb-4" placeholder="Project Image">
              </div>

          <!-- loader img -->
          <img id="projectEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          <h6 id="projectEditWrong" class="d-none">Something Went Wrong !</h6>  

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button  id="ProjectUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div>

<!--Add Modal -->
<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body  p-5 text-center">
        <div id="serviceAddForm" class="w-100 ">
          <h6 class="mb-4">Add New Project</h6>
          <input type="text" id="ProjectNameAddID" class="form-control mb-4" placeholder="Project Name">
          <input type="text" id="ProjectDesAddID" class="form-control mb-4" placeholder="Project Description">
          <input type="text" id="ProjectLinkAddID" class="form-control mb-4" placeholder="Project Link">
          <input type="text" id="ProjectImgAddID" class="form-control mb-4" placeholder="Project Image">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="projectAddConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
<!--Add Modal End -->
  
  
@endsection

@section('script')
<script type="text/javascript">
    getProjectsData();

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

// Project Add New Btn Click
    $('#addNewProjectBtnId').click(function(){
    $('#addProjectModal').modal('show');
    })
    
    //Service Add Modal Save Button
    $('#projectAddConfirmBtn').click(function() {
    var ProjectName = $('#ProjectNameAddID').val();
    var ProjectDes = $('#ProjectDesAddID').val();
    var ProjectLink = $('#ProjectLinkAddID').val();
    var ProjectImg = $('#ProjectImgAddID').val();
    
    ProjectsAdd(ProjectName,ProjectDes,ProjectLink,ProjectImg);
    })
    
    //Service Add Method
    function ProjectsAdd(ProjectName,ProjectDes,ProjectLink,ProjectImg) {
    
    if(ProjectName.length==0){
         toastr.error('Project Name Required');
     }
     else if(ProjectDes.length==0){
         toastr.error('Project Description Required');
     }
     else if(ProjectLink.length==0){
         toastr.error('Project Link Required');
     }
     else if(ProjectImg.length==0){
        toastr.error('Project Image Required');
    }
     else{
         $('#projectAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //set loadin animation
         axios.post('/ProjectsAdd', {
            project_name: ProjectName,
            project_des: ProjectDes,
            project_link: ProjectLink,
            project_img: ProjectImg
         })
         .then(function(response) {
             $('#projectAddConfirmBtn').html("Save");
             if(response.status==200){
                 if (response.data == 1) {
                     $('#addProjectModal').modal('hide');
                     toastr.success('Data Added Successfully');
                     getProjectsData();
                 } else {
                     $('#addProjectModal').modal('hide');
                     toastr.error('Data Addition Failed');
                     getProjectsData();
                 }
             }else{
                 $('#addProjectModal').modal('hide');
                 toastr.error('Something Went Wrong !');
             }
             
         }).catch(function(error) {
             $('#addProjectModal').modal('hide');
             toastr.error('Something Went Wrong !');
         });
     }
    
    }
</script>
@endsection