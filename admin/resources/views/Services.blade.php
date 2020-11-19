@extends('Layout.app')

@section('content')
<div id="mainDiv" class="container d-none">
    <div class="row">
      <div class="col-md-12 p-5">

        <button id="addNewBtnId" class="btn my-3 btn-sm btn-danger">Add New</button>

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
 
<!--Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body  p-5 text-center">
        <div id="serviceAddForm" class="w-100 ">
          <h6 class="mb-4">Add New Service</h6>
          <input type="text" id="serviceNameAddID" class="form-control mb-4" placeholder="Service Name">
          <input type="text" id="serviceDesAddID" class="form-control mb-4" placeholder="Service Description">
          <input type="text" id="serviceImgAddID" class="form-control mb-4" placeholder="Image Link">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="serviceAddConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
<!--Add Modal End -->


@endsection





@section('script')
    <script type="text/javascript">
         getServicesData();

         
//For Services Table(showing data)
function getServicesData() {

axios.get('/getServicesData')
    .then(function(response) {

        if (response.status == 200) {

            $('#mainDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');

            $('#service_table').empty();

            var jsonData = response.data;

            $.each(jsonData, function(i, item) {
                $('<tr>').html(

                    "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                    "<td>" + jsonData[i].service_name + "</td>" +
                    "<td>" + jsonData[i].service_des + "</td>" +
                    "<td><a class='serviceEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                    "<td><a class='serviceDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"

                ).appendTo('#service_table')
            });


            //Service Table Delete Icon Click
            $('.serviceDeleteBtn').click(function() {
                var id = $(this).data('id');

                $('#serviceDeleteId').html(id);
                $('#deleteModal').modal('show');
            });


            //Service Table Edit Icon Click
            $('.serviceEditBtn').click(function() {
                var id = $(this).data('id');
                $('#serviceEditId').html(id);

                ServiceUpdateDetails(id);

                $('#editModal').modal('show');
            });

        } else {

            $('#loaderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');
        }

    }).catch(function(error) {

        $('#loaderDiv').addClass('d-none');
        $('#wrongDiv').removeClass('d-none');

    });
}


//Service Delete Modal Yes Button
$('#serviceDeleteConfirmBtn').click(function() {
var id = $('#serviceDeleteId').html();
ServiceDelete(id);
})

//Service Delete
function ServiceDelete(deleteID) {

$('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //set loadin animation

axios.post('/ServiceDelete', {
        id: deleteID
    })
    .then(function(response) {
        $('#serviceDeleteConfirmBtn').html("Yes");

       if(response.status==200){
        if (response.data == 1) {
            $('#deleteModal').modal('hide');
            toastr.success('Delete Successfully');
            getServicesData();
        } else {
            $('#deleteModal').modal('hide');
            toastr.error('Delete Failed');
            getServicesData();
        }
       }else{
        $('#deleteModal').modal('hide');
        toastr.error('Something Went Wrong !');
       }

    }).catch(function(error) {
        $('#deleteModal').modal('hide');
        toastr.error('Something Went Wrong !');
    });
}


//Each Service Update Details
function ServiceUpdateDetails(detailsID) {
axios.post('/ServiceDetails', {
        id: detailsID
    })
    .then(function(response) {

        if (response.status == 200) {
            $('#serviceEditForm').removeClass('d-none');
            $('#serviceEditLoader').addClass('d-none');
            $('#serviceEditWrong').addClass('d-none');

            var jsonData = response.data;
            $('#serviceNameID').val(jsonData[0].service_name);
            $('#serviceDesID').val(jsonData[0].service_des);
            $('#serviceImgID').val(jsonData[0].service_img);
        }else{
            $('#serviceEditLoader').addClass('d-none');
            $('#serviceEditWrong').removeClass('d-none');
        }

    }).catch(function(error) {
        $('#serviceEditLoader').addClass('d-none');
        $('#serviceEditWrong').removeClass('d-none');
    });
}


//Service Update Modal Save Button
$('#serviceEditConfirmBtn').click(function() {
var id = $('#serviceEditId').html();
var name = $('#serviceNameID').val();
var des = $('#serviceDesID').val();
var img = $('#serviceImgID').val();

ServiceUpdate(id,name,des,img);
})

//Each Service Update Data
function ServiceUpdate(serviceID,serviceName,serviceDes,serviceImg) {

if(serviceName.length==0){
    toastr.error('Service Name Required');
}
else if(serviceDes.length==0){
    toastr.error('Service Description Required');
}
else if(serviceImg.length==0){
    toastr.error('Service Image Required');
}
else{
    $('#serviceEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //set loadin animation
    axios.post('/ServiceUpdate', {
        id: serviceID,
        name: serviceName,
        des: serviceDes,
        img: serviceImg
    })
    .then(function(response) {
        $('#serviceEditConfirmBtn').html("Save");
        if(response.status==200){
            if (response.data == 1) {
                $('#editModal').modal('hide');
                toastr.success('Data Update Successfully');
                getServicesData();
            } else {
                $('#editModal').modal('hide');
                toastr.error('Data Update Failed');
                getServicesData();
            }
        }else{
            $('#editModal').modal('hide');
            toastr.error('Something Went Wrong !');
        }
        
    }).catch(function(error) {
        $('#editModal').modal('hide');
        toastr.error('Something Went Wrong !');
    });
}

}




// Service Add New Btn Click
$('#addNewBtnId').click(function(){
$('#addModal').modal('show');
})

//Service Add Modal Save Button
$('#serviceAddConfirmBtn').click(function() {
var name = $('#serviceNameAddID').val();
var des = $('#serviceDesAddID').val();
var img = $('#serviceImgAddID').val();

ServiceAdd(name,des,img);
})

//Service Add Method
function ServiceAdd(serviceName,serviceDes,serviceImg) {

if(serviceName.length==0){
     toastr.error('Service Name Required');
 }
 else if(serviceDes.length==0){
     toastr.error('Service Description Required');
 }
 else if(serviceImg.length==0){
     toastr.error('Service Image Required');
 }
 else{
     $('#serviceAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //set loadin animation
     axios.post('/ServiceAdd', {
         name: serviceName,
         des: serviceDes,
         img: serviceImg
     })
     .then(function(response) {
         $('#addNeserviceAddConfirmBtnwBtnId').html("Save");
         if(response.status==200){
             if (response.data == 1) {
                 $('#addModal').modal('hide');
                 toastr.success('Data Added Successfully');
                 getServicesData();
             } else {
                 $('#addModal').modal('hide');
                 toastr.error('Data Addition Failed');
                 getServicesData();
             }
         }else{
             $('#addModal').modal('hide');
             toastr.error('Something Went Wrong !');
         }
         
     }).catch(function(error) {
         $('#addModal').modal('hide');
         toastr.error('Something Went Wrong !');
     });
 }

}
    </script>
@endsection