


@extends('Layout.app')
@section('title','যোগাযোগ')
@section('content')


    <div class="container-fluid jumbotron mt-5 ">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6  text-center">
                <h1 class="page-top-title mt-1">-যোগাযোগ -</h1>
            </div>
        </div>
    </div>




    <div class="container-fluid bg-white jumbotron mt-1 ">
        <div class="row">
            <div class="col-md-6 container-fluid">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.328233113314!2d90.36650911506732!3d23.80692448456152!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c0d6f6b8c2ff%3A0x3b138861ee9c8c30!2sMirpur%2010%20Roundabout%2C%20Dhaka%201216!5e0!3m2!1sen!2sbd!4v1605065284892!5m2!1sen!2sbd" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>

            <div class="col-md-6">
                <div class="text-center">
                    <h5 class="service-card-title text-center">যোগাযোগ করুন </h5>

                    <hr>
                    <p class="footer-text "><i class="fas fa-map-marker-alt"></i>  মিরপুর ১০ ঢাকা । <i class="fas  ml-4 fa-phone"></i>      ০১৭৩০২৩৩৫৯২ <i class="fas  ml-4 fa-envelope"></i>      Marzanbay@gmail.com</p>
                <hr>
                </div>
                <div class="form-group ">
                    <input id="contactNameId" type="text" class="form-control w-100" placeholder="আপনার নাম">
                </div>
                <div class="form-group">
                    <input id="contactMobileId" type="text" class="form-control  w-100" placeholder="মোবাইল নং ">
                </div>
                <div class="form-group">
                    <input id="contactEmailId" type="text" class="form-control  w-100" placeholder="ইমেইল ">
                </div>
                <div class="form-group">
                    <input id="contactMsgId" type="text" class="form-control  w-100" placeholder="মেসেজ ">
                </div>
                <button id="contactSendBtnId"  class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
            </div>

        </div>
    </div>













@endsection