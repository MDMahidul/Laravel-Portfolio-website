@extends('Layout.app')
@section('title','Photo Gallery')

@section('content')

    <div class="container-fluid m-0 ">
        <div class="row">
            <div class="col-md-12">
                <button data-toggle="modal" data-target="#PhotoModal" id="addNewPhotoBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>
            </div>
        </div>
    </div>

    <div class="container-fluid ">
        <div class="row photoRow">

        </div>
        <button class="btn btn-primary" id="LoadMoreBtn">Load More</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input class="form-control" id="imgInput" type="file">
                    <img class=" mt-3" id="imgPreview" src=" ">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <button id="SavePhoto" type="button" class="btn btn-sm btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!--Delete Modal -->
    <div class="modal fade" id="deletePhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-3 text-center">
                    <h5 class="mt-4">Do You Want To Delete</h5>
                    <h6 id="PhotoDeleteId" class="mt-4 d-none"></h6>
                    <h6 id="PhotoDeleteLocation" class="mt-4 d-none"></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                    <button  id="PhotoDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!--Delete Modal end -->
@endsection

@section('script')
    <script type="text/javascript">
        $('#imgInput').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#imgPreview').addClass('imgPreview');
                $('#imgPreview').attr('src', ImgSource);
            }
        });

        $('#SavePhoto').on('click', function() {

            $('#SavePhoto').html("<div class=\'spinner-border spinner-border-sm\' role=\'status\'></div>");

            var PhotoFile = $('#imgInput').prop('files')[0];
            var formData = new FormData();
            formData.append('photo', PhotoFile);

            axios.post("/photoUpload", formData).then(function(response) {
                if (response.status == 200 && response.data == 1) {
                    $('#SavePhoto').html("Save");
                    toastr.success('Photo Uploaded Successfully');
                    $('#PhotoModal').modal('hide');
                    window.location.href = "/photo";
                } else {
                    $('#PhotoModal').modal('hide');
                    toastr.error('Photo Upload Failed !');
                    window.location.href = "/photo";
                }

            }).catch(function(error) {
                $('#PhotoModal').modal('hide');
                toastr.error('Photo Upload Failed !');
                $('#SavePhoto').html("Save");
                window.location.href = "/photo";
            })

        })

        LoadPhoto();
        //To load photo from the db
        function LoadPhoto() {

            axios.get("/PhotoJSON").then(function(response) {

                $.each(response.data, function(i, item) {
                    $("<div class='col-md-3 p-1'>").html(
                        "<img data-id=" + item['id'] + " class='imgOnRow' src=" + item['location'] + ">" +
                        "<button data-id=" + item['id'] + "data-photo=" + item['location'] + " class='btn btn-sm deletePhoto'>Delete</button>"
                    ).appendTo('.photoRow');
                })

                //delete button
                $('.deletePhoto').on('click', function(event) {
                    let id = $(this).data('id');
                    let photo = $(this).data('photo');

                    $('#PhotoDeleteId').html(id);
                    $('#PhotoDeleteLocation').html(photo);

                    $('#deletePhotoModal').modal('show');
                    //PhotoDelete(photo,id);
                    //event.preventDefault();
                });

            }).catch(function(error) {

            })
        }


        //to load more images
        var ImgID = 0;

        function LoadByID(FirstImgID, loadMoreBtn) {
            ImgID = ImgID + 4;
            let PhotoID = ImgID + FirstImgID;
            let url = '/PhotoJSONByID/' + PhotoID;
            loadMoreBtn.html("<div class=\'spinner-border spinner-border-sm\' role=\'status\'></div>");
            axios.get(url).then(function(response) {
                loadMoreBtn.html("Load More");
                $.each(response.data, function(i, item) {
                    $("<div class='col-md-3 p-1'>").html(
                        "<img data-id=" + item['id'] + " class='imgOnRow' src=" + item['location'] + ">" +
                        "<button data-id=" + item['id'] + " data-photo=" + item['location'] + " class='btn btn-sm deletePhoto'>Delete</button>"
                    ).appendTo('.photoRow');

                    //delete button
                    $('.deletePhoto').on('click', function(event) {
                        let id = $(this).data('id');
                        let photo = $(this).data('photo');

                        $('#PhotoDeleteId').html(id);
                        $('#PhotoDeleteLocation').html(photo);

                        $('#deletePhotoModal').modal('show');
                        //PhotoDelete(photo,id);
                        //event.preventDefault();
                    });
                });
            }).catch(function(error) {
                loadMoreBtn.html("Load More");
            })
        }

        //to catch first id of the image in the Loadmore button
        $('#LoadMoreBtn').on('click', function() {
            loadMoreBtn = $(this);
            let FirstImgID = $(this).closest('div').find('img').data('id');

            LoadByID(FirstImgID, loadMoreBtn);
        })

        //delete confirmation btn
        $('#PhotoDeleteConfirmBtn').click(function(event) {
            let id = $('#PhotoDeleteId').html();
            let photo = $('#PhotoDeleteLocation').html();
            PhotoDelete(photo, id);
            event.preventDefault();
        })

        //to delete photo
        function PhotoDelete(OldPhotoURL, id) {
            let URL = "/PhotoDelete";
            let MyFormData = new FormData();
            MyFormData.append('OldPhotoURL', OldPhotoURL);
            MyFormData.append('id', id);
            axios.post(URL, MyFormData).then(function(response) {
                if (response.status == 200 && response.data == 1) {
                    toastr.success("Photo Deleted Successfully.");
                    window.location.href = "/photo";
                } else {
                    toastr.error("Photo Delete Failed!");
                }
            }).catch(function(error) {
                toastr.error("Photo Delete Failed!");
            })
        }
    </script>
@endsection
