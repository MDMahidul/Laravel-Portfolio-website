@extends('Layout.app')

@section('content')

<div id="mainDivContact" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">

        <table id="contactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
            <th class="th-sm">Name</th>
            <th class="th-sm">Mobile</th>
            <th class="th-sm">Email</th>
            <th class="th-sm">Message</th>
            <th class="th-sm">Delete</th>
            </tr>
        </thead>
        <tbody id="contact_table">
        	
        </tbody>
        </table>
        
        </div>
    </div>
</div>


<!-- loader div -->
<div id="loaderDivContact" class="container">
    <div class="row">
      <div class="col-md-12 text-center p-5">
  
       <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
      
      </div>
    </div>
  </div>
  
  <!-- went wrong div -->
  <div id="wrongDivContact" class="container d-none">
    <div class="row">
      <div class="col-md-12 text-center p-5">
        <h3>Something Went Wrong !</h3>
      </div>
    </div>
  </div>


  <!--Delete Modal -->
<div class="modal fade" id="deleteContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-3 text-center">
                <h5 class="mt-4">Do You Want To Delete</h5>
                <h6 id="ContactDeleteId" class="mt-4 d-none"></h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                <button  id="ContactDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>
<!--Delete Modal end -->


@endsection

@section('script')
    <script type="text/javascript">
            
        getContactData() 

    </script>
@endsection