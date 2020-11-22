
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
            
                        "<td><a class='courseViewDetailsBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-eye'></i></a></td>" +

                        "<td><a class='courseEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        
                        "<td><a class='courseDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
    
                    ).appendTo('#course_table')
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
    
