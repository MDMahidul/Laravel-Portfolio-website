@extends('Layout.app')

@section('content')
<div id="mainDiv" class="container d-none">
    <div class="row">
      <div class="col-md-12 p-5">
      <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm">Image</th>
            <th class="th-sm">Name</th>
            <th class="th-sm">Description</th>
            <th class="th-sm">Edit</th>
            <th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="service_table">   
          
        </tbody>
      </table>
      
      </div>
    </div>
  </div>

<!-- loader div -->
<div id="loaderDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">

     <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    
    </div>
  </div>
</div>

<!-- went wrong div -->
<div id="wrongDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>



<!--Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <h5 class="mt-4">Do You Want To Delete</h5>
        <h6 id="serviceDeleteId" class="mt-4"></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="serviceDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>
<!--Delete Modal end -->

<!--Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body  p-5 text-center">
        <h6 id="serviceEditId" class="mt-4"></h6>
        <div id="serviceEditForm" class="w-100 d-none">
          <input type="text" id="serviceNameID" class="form-control mb-4" placeholder="Service Name">
          <input type="text" id="serviceDesID" class="form-control mb-4" placeholder="Service Description">
          <input type="text" id="serviceImgID" class="form-control mb-4" placeholder="Image Link">
        </div>
          <!-- loader img -->
          <img id="serviceEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          <h6 id="serviceEditWrong" class="d-none">Something Went Wrong !</h6>  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="serviceEditConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
<!--Edit Modal End -->
    
@endsection

@section('script')
    <script type="text/javascript">
         getServicesData();
    </script>
@endsection