@extends('Layout.app')
@section('title','Review')

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

        //For Services Table(showing data)
function getReviewData() {

axios.get('/getReviewData')
    .then(function(response) {

        if (response.status == 200) {

            $('#mainDivReview').removeClass('d-none');
            $('#loaderDivReview').addClass('d-none');

           //to refresh the table
            $('#reviewDataTable').DataTable().destroy();
            $('#review_table').empty();

            var jsonData = response.data;

            $.each(jsonData, function(i, item) {
                $('<tr>').html(
                    "<td>" + jsonData[i].name + "</td>" +
                    "<td>" + jsonData[i].des + "</td>" +
                    "<td><a class='reviewEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                    "<td><a class='reviewDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"

                ).appendTo('#review_table')
            });


            //Service Table Delete Icon Click
            $('.reviewDeleteBtn').click(function() {
                var id = $(this).data('id');

                $('#ReviewDeleteId').html(id);
                $('#deleteReviewModal').modal('show');
            });


            //Service Table Edit Icon Click
            $('.reviewEditBtn').click(function() {
                var id = $(this).data('id');
                $('#reviewEditId').html(id);
                ReviewUpdateDetails(id);
                $('#updateReviewModal').modal('show');
            });

            //add data table libraies
            $('#reviewDataTable').DataTable({"order":false});
            $('.dataTables_length').addClass('bs-select');


        } else {

            $('#loaderDivReview').addClass('d-none');
            $('#wrongDivReview').removeClass('d-none');
        }

    }).catch(function(error) {

        $('#loaderDivReview').addClass('d-none');
        $('#wrongDivReview').removeClass('d-none');

    });
}

//Review Delete Modal Yes Button
$('#ReviewDeleteConfirmBtn').click(function() {
var id = $('#ReviewDeleteId').html();
ReviewDelete(id);
})

//Review Delete
function ReviewDelete(deleteID) {

$('#ReviewDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //set loadin animation

axios.post('/ReviewDelete', {
        id: deleteID
    })
    .then(function(response) {
        $('#ReviewDeleteConfirmBtn').html("Yes");

       if(response.status==200){
            if (response.data == 1) {
                $('#deleteReviewModal').modal('hide');
                toastr.success('Delete Successfully');
                getReviewData();
            } else {
                $('#deleteReviewModal').modal('hide');
                toastr.error('Delete Failed');
                getReviewData();
            }
       }else{
        $('#deleteReviewModal').modal('hide');
        toastr.error('Something Went Wrong !');
       }

    }).catch(function(error) {
        $('#deleteReviewModal').modal('hide');
        toastr.error('Something Went Wrong !');
    });
}

//open Add new modal
$('#addNewReviewBtnId').click(function(){
$('#addReviewModal').modal('show');
});


//Review Add Modal Save Button
$('#ReviewAddConfirmBtn').click(function() {
var ReviewName = $('#ReviewNameId').val();
var ReviewDes = $('#ReviewDesId').val();
var ReviewImg = $('#ReviewImgId').val();

ReviewAdd(ReviewName,ReviewDes,ReviewImg);
});

//Review Add Method
function ReviewAdd(ReviewName,ReviewDes,ReviewImg) {

if(ReviewName.length==0){
 toastr.error('Review Name Required');
}
else if(ReviewDes.length==0){
 toastr.error('Review Description Required');
}
else if(ReviewImg.length==0){
toastr.error('Review Image Required');
}
else{
 $('#ReviewAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //set loadin animation
 axios.post('/ReviewAdd', {
    name: ReviewName,
    des: ReviewDes,
    img: ReviewImg
 })
 .then(function(response) {
     $('#ReviewAddConfirmBtn').html("Save");
     if(response.status==200){
         if (response.data == 1) {
             $('#addReviewModal').modal('hide');
             toastr.success('Data Added Successfully');
             getReviewData();
         } else {
             $('#addReviewModal').modal('hide');
             toastr.error('Data Addition Failed');
             getReviewData();
         }
     }else{
         $('#addReviewModal').modal('hide');
         toastr.error('Something Went Wrong !');
     }
     
 }).catch(function(error) {
     $('#addReviewModal').modal('hide');
     toastr.error('Something Went Wrong !');
 });
}

}


//review Update details
function ReviewUpdateDetails(detailsID) {
axios.post('/ReviewDetails', {
        id: detailsID
    })
    .then(function(response) {

        if (response.status == 200) {
            $('#reviewEditForm').removeClass('d-none');
            $('#reviewEditLoader').addClass('d-none');
            $('#reviewEditWrong').addClass('d-none');

            var jsonData = response.data;
            $('#ReviewNameUpdateId').val(jsonData[0].name);
            $('#ReviewDesUpdateId').val(jsonData[0].des);
            $('#ReviewImgUpdateId').val(jsonData[0].img);
        }else{
            $('#reviewEditLoader').addClass('d-none');
            $('#reviewEditWrong').removeClass('d-none');
        }

    }).catch(function(error) {
        $('#reviewEditLoader').addClass('d-none');
        $('#reviewEditWrong').removeClass('d-none');
    });
}


//Review Update Modal Save Button
$('#ReviewUpdateConfirmBtn').click(function() {
var id = $('#reviewEditId').html();
var name = $('#ReviewNameUpdateId').val();
var des = $('#ReviewDesUpdateId').val();
var img = $('#ReviewImgUpdateId').val();

ReviewUpdate(id,name,des,img);
});

//Each Service Update Data
function ReviewUpdate(ReviewID,ReviewName,ReviewDes,ReviewImg) {

if(ReviewName.length==0){
    toastr.error('Review Name Required');
}
else if(ReviewDes.length==0){
    toastr.error('Review Description Required');
}
else if(ReviewImg.length==0){
    toastr.error('Review Image Required');
}
else{
    $('#ReviewUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //set loadin animation
    axios.post('/ReviewUpdate', {
        id: ReviewID,
        name: ReviewName,
        des: ReviewDes,
        img: ReviewImg
    })
    .then(function(response) {
        $('#ReviewUpdateConfirmBtn').html("Save");
        if(response.status==200){
            if (response.data == 1) {
                $('#updateReviewModal').modal('hide');
                toastr.success('Data Update Successfully');
                getReviewData();
            } else {
                $('#updateReviewModal').modal('hide');
                toastr.error('Data Update Failed');
                getReviewData();
            }
        }else{
            $('#updateReviewModal').modal('hide');
            toastr.error('Something Went Wrong !');
        }
        
    }).catch(function(error) {
        $('#updateReviewModal').modal('hide');
        toastr.error('Something Went Wrong !');
    });
}

}

    </script>
    
@endsection