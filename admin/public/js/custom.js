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
    