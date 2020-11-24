@extends('Layout.app')

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


@endsection

@section('script')
<script type="text/javascript">
    getProjectsData();
</script>
@endsection