@extends('Layout.app')

@section('content')
    <div  id="mainDivReview" class="container d-none" >
        <div class="row">
            <div class="col-md-12 p-5">
                <button id="addNewReviewBtnId" class="btn my-3 btn-sm btn-danger">Add New</button>

                <table id="reviewDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Description</th>
                            <th class="th-sm">Edit</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="review_table">

                    </tbody>
                </table>
            </div>
        </div>
    </div> 
    <!-- loader div -->
    <div id="loaderDivReview" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
            </div>
        </div>
    </div>
  
  <!-- went wrong div -->
  <div id="wrongDivReview" class="container d-none">
    <div class="row">
      <div class="col-md-12 text-center p-5">
        <h3>Something Went Wrong !</h3>
      </div>
    </div>
  </div>  

  <!--Delete Modal -->
<div class="modal fade" id="deleteReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-3 text-center">
                <h5 class="mt-4">Do You Want To Delete</h5>
                <h6 id="ReviewDeleteId" class="mt-4 d-none"></h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                <button  id="ReviewDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>
<!--Delete Modal end -->


  <!--Update Courses Modal -->
  <div class="modal fade" id="updateReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
              <h5 class="modal-title">Update Review</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
         </div>
        <div class="modal-body  text-center">
          <div id="reviewEditForm" class="container d-none">
            <h6 id="reviewEditId" class="mt-4 d-none"></h6>
              <div class="row">
                      <input id="ReviewNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Review Name">
                      <input id="ReviewDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Review Description">
                      <input id="ReviewImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Review Image">
              </div>
          </div>

          <!-- loader img -->
          <img id="reviewEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          <h6 id="reviewEditWrong" class="d-none">Something Went Wrong !</h6>  

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button  id="ReviewUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div>

  <!--Add New Rreview Modal -->
<div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
              <h5 class="modal-title">Add New Review</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
         </div>
        <div class="modal-body  text-center">
          <div class="container">
              <div class="row">
                    <input id="ReviewNameId" type="text" id="" class="form-control mb-3" placeholder="Review Name">
                    <input id="ReviewDesId" type="text" id="" class="form-control mb-3" placeholder="Review Description">
                    <input id="ReviewImgId" type="text" id="" class="form-control mb-3" placeholder="Review Image">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
          <button  id="ReviewAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
        </div>
      </div>
    </div>
  </div>
  


@endsection

@section('script')
    <script type="text/javascript">
        getReviewData();
    </script>
    
@endsection