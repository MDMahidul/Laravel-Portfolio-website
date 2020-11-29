@extends('Layout.app')
@section('title','Contact')
@section('content')

    <div class="container-fluid jumbotron mt-5 ">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6  text-center">
                <h1 class="page-top-title mt-3">- যোগাযোগ করুন -</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7299.207333915568!2d90.43114092493353!3d23.832688588195463!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c63e0d61bd77%3A0xc297647f452f278c!2sNamapara%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1606668316630!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <div class="col-md-6">
                <h3 class="service-card-title">ঠিকানা</h3>
                <hr>
                <p class="footer-text"><i class="fas fa-map-marker-alt"></i> নামাপাড়া,খিলখেত, ঢাকা  <i class="fas fa-phone"></i> ০১৭১০৬১১৯৮০  <i class="fas fa-envelope"></i> mmbmahidul007@gmail.com</p>
                    <div class="form-group ">
                        <input type="text" id="contactNameId" class="form-control w-100" placeholder="আপনার নাম">
                    </div>
                    <div class="form-group">
                        <input type="text"  id="contactMobileId" class="form-control  w-100" placeholder="মোবাইল নং ">
                    </div>
                    <div class="form-group">
                        <input type="text"  id="contactEmailId" class="form-control  w-100" placeholder="ইমেইল ">
                    </div>
                    <div class="form-group">
                        <input type="text"  id="contactMsgId" class="form-control  w-100" placeholder="মেসেজ ">
                    </div>
                    <button  id="contactSendBtnId" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
            </div>
        </div>
    </div>

@endsection
