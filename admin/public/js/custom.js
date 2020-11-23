
//For Courses Table(showing data)
function getCoursesData() {

    axios.get('/getCoursesData')
        .then(function(response) {
    
            if (response.status == 200) {
    
                $('#mainDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');
    
                $('#course_table').empty();
    
                var jsonData = response.data;
    
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
    
                        "<td>"+ jsonData[i].course_name +"</td>" +
                        "<td>" + jsonData[i].course_fee + "</td>" +
                        "<td>" + jsonData[i].course_totalenroll + "</td>" +
                        "<td>" + jsonData[i].course_totalclass + "</td>" +

                        "<td><a class='courseEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        
                        "<td><a class='courseDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
    
                    ).appendTo('#course_table')
                });

                //Course Table Delete Icon Click
                $('.courseDeleteBtn').click(function() {
                    var id = $(this).data('id');

                    $('#CourseDeleteId').html(id);
                    $('#deleteCourseModal').modal('show');
                });

                //Course Table Update Icon Click
                $('.courseEditBtn').click(function() {
                    var id = $(this).data('id');
                    $('#courseEditId').html(id);
                    CourseUpdateDetails(id);
                    $('#updateCourseModal').modal('show');
                });

    
            } else {
    
                $('#loaderDivCourse').addClass('d-none');
                $('#wrongDivCourse').removeClass('d-none');
            }
    
        }).catch(function(error) {
    
            $('#loaderDivCourse').addClass('d-none');
            $('#wrongDivCourse').removeClass('d-none');
    
        });
    }

//open Add new modal
    $('#addNewCourseBtnId').click(function(){
        $('#addCourseModal').modal('show');
    });


//Course Add Modal Save Button
$('#CourseAddConfirmBtn').click(function() {
    var CourseName = $('#CourseNameId').val();
    var CourseDes = $('#CourseDesId').val();
    var CourseFee = $('#CourseFeeId').val();
    var CourseEnroll = $('#CourseEnrollId').val();
    var CourseClass = $('#CourseClassId').val();
    var CourseLink = $('#CourseLinkId').val();
    var CourseImg = $('#CourseImgId').val();
    
    CourseAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg);
    })

//Course Add Method
function CourseAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg) {

    if(CourseName.length==0){
         toastr.error('Course Name Required');
     }
     else if(CourseDes.length==0){
         toastr.error('Course Description Required');
     }
     else if(CourseFee.length==0){
         toastr.error('Course Fee Required');
     }
     else if(CourseEnroll.length==0){
        toastr.error('Course Enroll Required');
    }
    else if(CourseClass.length==0){
        toastr.error('Course Class Required');
    }
    else if(CourseLink.length==0){
        toastr.error('Course Link Required');
    }
    else if(CourseImg.length==0){
        toastr.error('Course Image Required');
    }
     else{
         $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //set loadin animation
         axios.post('/CoursesAdd', {
            course_name: CourseName,
            course_des: CourseDes,
            course_fee: CourseFee,
            course_totalenroll: CourseEnroll,
            course_totalclass: CourseClass,
            course_link: CourseLink,
            course_img: CourseImg
         })
         .then(function(response) {
             $('#CourseAddConfirmBtn').html("Save");
             if(response.status==200){
                 if (response.data == 1) {
                     $('#addCourseModal').modal('hide');
                     toastr.success('Data Added Successfully');
                     getCoursesData();
                 } else {
                     $('#addCourseModal').modal('hide');
                     toastr.error('Data Addition Failed');
                     getCoursesData();
                 }
             }else{
                 $('#addCourseModal').modal('hide');
                 toastr.error('Something Went Wrong !');
             }
             
         }).catch(function(error) {
             $('#addCourseModal').modal('hide');
             toastr.error('Something Went Wrong !');
         });
     }
    
    }
    

    //Service Delete Modal Yes Button
$('#CourseDeleteConfirmBtn').click(function() {
    var id = $('#CourseDeleteId').html();
    CourseDelete(id);
    })
    
    //Service Delete
    function CourseDelete(deleteID) {
    
    $('#CourseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //set loadin animation
    
    axios.post('/CoursesDelete', {
            id: deleteID
        })
        .then(function(response) {
            $('#CourseDeleteConfirmBtn').html("Yes");
    
           if(response.status==200){
                if (response.data == 1) {
                    $('#deleteCourseModal').modal('hide');
                    toastr.success('Delete Successfully');
                    getCoursesData();
                } else {
                    $('#deleteCourseModal').modal('hide');
                    toastr.error('Delete Failed');
                    getCoursesData();
                }
           }else{
            $('#deleteCourseModal').modal('hide');
            toastr.error('Something Went Wrong !');
           }
    
        }).catch(function(error) {
            $('#deleteCourseModal').modal('hide');
            toastr.error('Something Went Wrong !');
        });
    }



    //course Update details
    function CourseUpdateDetails(detailsID){
        axios.post('/CoursesDetails', {
            id: detailsID
        })
        .then(function(response) {
    
            if (response.status == 200) {
                $('#courseEditForm').removeClass('d-none');
                $('#courseEditLoader').addClass('d-none');
                $('#courseEditWrong').addClass('d-none');
    
                var jsonData = response.data;
                $('#CourseNameUpdateId').val(jsonData[0].course_name);
                $('#CourseDesUpdateId').val(jsonData[0].course_des);
                $('#CourseFeeUpdateId').val(jsonData[0].course_fee);
                $('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
                $('#CourseClassUpdateId').val(jsonData[0].course_totalclass);
                $('#CourseLinkUpdateId').val(jsonData[0].course_link);
                $('#CourseImgUpdateId').val(jsonData[0].course_img);
            }else{
                $('#courseEditLoader').addClass('d-none');
                $('#courseEditWrong').removeClass('d-none');
            }
    
        }).catch(function(error) {
            $('#courseEditLoader').addClass('d-none');
            $('#courseEditWrong').removeClass('d-none');
        });
    }



//Course Update Modal Save Button
$('#CourseUpdateConfirmBtn').click(function() {

    var courseID = $('#courseEditId').html();
    var courseName = $('#CourseNameUpdateId').val();
    var courseDes = $('#CourseDesUpdateId').val();
    var courseFee = $('#CourseFeeUpdateId').val();
    var courseEnroll = $('#CourseEnrollUpdateId').val();
    var courseClass = $('#CourseClassUpdateId').val();
    var courseLink = $('#CourseLinkUpdateId').val();
    var courseImg = $('#CourseImgUpdateId').val();

    CourseUpdate(courseID, courseName, courseDes, courseFee,courseEnroll,courseClass,courseLink,courseImg);
})

//Each Course Update Data
function CourseUpdate(CourseID,CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg) {

    if (CourseName.length == 0) {
        toastr.error('Course Name Required');
    } 
    else if (CourseDes.length == 0) {
        toastr.error('Course Description Required');
    } 
    else if (CourseFee.length == 0) {
        toastr.error('Course Fee Required');
    } 
    else if (CourseEnroll.length == 0) {
        toastr.error('Course Enroll Required');
    } 
    else if (CourseClass.length == 0) {
        toastr.error('Course Class Required');
    } 
    else if (CourseLink.length == 0) {
        toastr.error('Course Link Required');
    } 
    else if (CourseImg.length == 0) {
        toastr.error('Course Image Required');
    } 
    else {
        $('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //set loadin animation
        axios.post('/CoursesUpdate', {
                id: CourseID,
                course_name: CourseName,
                course_des: CourseDes,
                course_fee: CourseFee,
                course_totalenroll: CourseEnroll,
                course_totalclass: CourseClass,
                course_link: CourseLink,
                course_img: CourseImg
            })
            .then(function(response) {
                $('#CourseUpdateConfirmBtn').html("Save");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#updateCourseModal').modal('hide');
                        toastr.success('Data Update Successfully');
                        getCoursesData();
                    } else {
                        $('#updateCourseModal').modal('hide');
                        toastr.error('Data Update Failed');
                        getCoursesData();
                    }
                } else {
                    $('#updateCourseModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }

            }).catch(function(error) {
                $('#updateCourseModal').modal('hide');
                toastr.error('Something Went Wrong !');
            });
    }

}
    