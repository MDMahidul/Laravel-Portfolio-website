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

@endsection

@section('script')
<script type="text/javascript">
    getProjectsData();
</script>
@endsection