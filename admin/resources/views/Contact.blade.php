@extends('Layout.app')
@section('title','Contact')
@section('content')


<div id="MainDivContact" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

    <button id="addNewContactBtnId" class="btn my-3 btn-danger">নতুন কন্টাক্ট</button>

<table id="contactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">নাম </th>
      <th class="th-sm">মোবাইল</th>
      <th class="th-sm">মেইল</th>
      <th class="th-sm">ম্যাসেজ</th>
      <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="contact_table">

  </tbody>
</table>
</div>
</div>
</div>


<div id="LoaderDivContact" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">
        <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
</div>
</div>
</div>




<div id="WrongDivContact" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">
        <h3>কিছু এটা সমস্যা রয়েছে !</h3>
        <p>অনুগ্রহপূর্বক আপনার ইন্টারনেট কানেকশান চেক করুন। এবং আবার রিলোড দিন !</p>
</div>
</div>
</div>


<div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">নতুন কন্টাক্ট যুক্ত করুন</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
        <div class="row">
            <div class="col-md-6">
                <input id="ContactNameId" type="text" id="" class="form-control mb-3" placeholder="নাম">
                <input id="ContactDesId" type="text" id="" class="form-control mb-3" placeholder="মোবাইল নম্বর">
            </div>
            <div class="col-md-6">     
                <input id="ContactLinkId" type="email" id="" class="form-control mb-3" placeholder="ইমেইল">
                <input id="ContactImgId" type="text" id="" class="form-control mb-3" placeholder="ম্যাসেজ">
            </div>
        </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="ContactAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<!--  -->
@endsection
<!-- Delete Modal -->
<div class="modal fade" id="deleteContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="text-center p-3 mt-4">আপনি এটি ডিলিট করতে চান?</h5>
        <h5 id="ContactDeleteId" class="text-center p-3 mt-4 d-none"></h5>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">নাহ</button>
        <button id="contactDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger"> হ্যাঁ </button>
      </div>
    </div>
  </div>
</div>


@section('script')
    <script type="text/javascript">  
getContactData();

// সার্ভিসেস টেবিল
function getContactData() {
    axios.get('/getContactData')
        .then(function(response) {
            if (response.status == 200) {
                $('#MainDivContact').removeClass('d-none');
                $('#LoaderDivContact').addClass('d-none');

                $('#contactDataTable').DataTable().destroy();
                $('#contact_table').empty();

                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td>" + jsonData[i].contact_name + "</td>" +
                        "<td>" + jsonData[i].contact_mobile + "</td>" +
                        "<td>" + jsonData[i].contact_email + "</td>" +
                        "<td>" + jsonData[i].contact_msg + "</td>" +


                        "<td> <a class='contactDeleteBtn' data-id=" + jsonData[i].id + "> <i class='fas fa-trash-alt'> </i></a>  </td>"
                    ).appendTo('#contact_table');
                });

                $('.contactDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#ContactDeleteId').html(id);
                    $('#deleteContactModal').modal('show');

                })
                $('.contactEditBtn').click(function() {
                    var id = $(this).data('id');
                    ContactUpdateDetails(id);
                    $('#contactEditId').html(id);
                    $('#updateContactModal').modal('show');

                })



                // Pagination Jquery
                $('#contactDataTable').DataTable({
                    "order": false
                });
                $('.dataTables_length').addClass('bs-select');

                // Pagination Jquery End
            } else {

                $('#LoaderDivContact').addClass('d-none');
                $('#WrongDivContact').removeClass('d-none');

            }

        })
        .catch(function(error) {
            $('#LoaderDivContact').addClass('d-none');
            $('#WrongDivContact').removeClass('d-none');

        });
}

$('#addNewContactBtnId').click(function() {
    $('#addContactModal').modal('show');
});




$('#ContactAddConfirmBtn').click(function() {
    var ContactName = $('#ContactNameId').val();
    var ContactDes = $('#ContactDesId').val();
    var ContactLink = $('#ContactLinkId').val();
    var ContactImg = $('#ContactImgId').val();

    ContactAdd(ContactName, ContactDes, ContactLink, ContactImg);
})
// Service Add Method
function ContactAdd(ContactName, ContactDes, ContactLink, ContactImg) {



    if (ContactName.length == 0) {
        toastr.error('নাম অবশ্যই দিতে হবে।');

    } else if (ContactDes.length == 0) {
        toastr.error('মোবাইল নম্বর দিতে হবে।');
    } else if (ContactLink.length == 0) {
        toastr.error('মেইল অবশ্যই দিতে হবে।');
    } else if (ContactImg.length == 0) {
        toastr.error('ম্যাসেজ অবশ্যই দিতে হবে।');
    } else {
        $('#ContactAddConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>")
        axios.post('/ContactAdd', {
                contact_name: ContactName,
                contact_mobile: ContactDes,
                contact_email: ContactLink,
                contact_msg: ContactImg,

            })
            .then(function(response) {
                $('#ContactAddConfirmBtn').html("সেভ");
                if (response.status == 200) {

                    if (response.data == 1) {
                        $('#addContactModal').modal('hide');
                        toastr.success('এটি যুক্ত হয়েছে !');
                        getContactData();
                    } else {
                        $('#addContactModal').modal('hide');
                        toastr.error('দুঃখিত ! এটি যুক্ত  হয় নি !');
                        $('#ContactAddConfirmBtn').html("সেভ")
                        getContactData();
                    }

                } else {
                    $('#addContactModal').modal('hide');
                    toastr.warning('কিছু একটা সমস্যা রয়েছে 1 !');
                    $('#ContactAddConfirmBtn').html("সেভ")
                }
            })
            .catch(function(error) {
                $('#addContactModal').modal('hide');
                toastr.warning('কিছু একটা সমস্যা রয়েছে 2 !');
                $('#ContactAddConfirmBtn').html("সেভ")
            });

    }


}

// Contact Delete Confirm
$('#contactDeleteConfirmBtn').click(function() {
    var id = $('#ContactDeleteId').html();
    ContactDelete(id);
})




// Contact Delete
function ContactDelete(deleteID) {
    $('#contactDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>")

    axios.post('/ContactDelete', {
            id: deleteID
        })
        .then(function(response) {
            $('#contactDeleteConfirmBtn').html("হ্যাঁ")
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteContactModal').modal('hide');
                    toastr.success('এটি ডিলিট হয়েছে !');
                    getContactData();
                } else {
                    $('#deleteContactModal').modal('hide');
                    toastr.error('দুঃখিত ! এটি ডিলিট হয় নি।');
                    $('#contactDeleteConfirmBtn').html("হ্যাঁ")
                    getContactData();
                }

            } else {
                $('#deleteContactModal').modal('hide');
                toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                $('#contactDeleteConfirmBtn').html("হ্যাঁ")
            }
        })
        .catch(function(error) {
            $('#deleteContactModal').modal('hide');
            toastr.warning('কিছু একটা সমস্যা রয়েছে !');
            $('#contactDeleteConfirmBtn').html("হ্যাঁ")
        });
}



// Contact Update


function ContactUpdateDetails(detailsID) {




    axios.post('/ContactDetails', {
            id: detailsID
        })
        .then(function(response) {

            if (response.status == 200) {

                $('#contactEditFrom').removeClass('d-none');
                $('#contactEditLoader').addClass('d-none');


                var jsonData = response.data;
                $('#ContactNameUpdateId').val(jsonData[0].contact_name);
                $('#ContactDesUpdateId').val(jsonData[0].contact_mobile);
                $('#ContactLinkUpdateId').val(jsonData[0].contact_email);
                $('#ContactImgUpdateId').val(jsonData[0].contact_msg);
            } else {
                $('#contactEditLoader').addClass('d-none');
                $('#contactEditWrong').removeClass('d-none');
            }


        })
        .catch(function(error) {
            $('#contactEditLoader').addClass('d-none');
            $('#contactEditWrong').removeClass('d-none');
        });

}

$('#ContactUpdateConfirmBtn').click(function() {
    var ContactID = $('#contactEditId').html();
    var ContactName = $('#ContactNameUpdateId').val();
    var ContactDes = $('#ContactDesUpdateId').val();
    var ContactLink = $('#ContactLinkUpdateId').val();
    var ContactImg = $('#ContactImgUpdateId').val();
    ContactUpdate(ContactID, ContactName, ContactDes, ContactLink, ContactImg);
})


// Service Update 
function ContactUpdate(ContactID, ContactName, ContactDes, ContactLink, ContactImg) {


    if (ContactName.length == 0) {
        toastr.error('কোর্স নাম অবশ্যই দিতে হবে।');

    } else if (ContactDes.length == 0) {
        toastr.error('কোর্স বিস্তারিত অবশ্যই দিতে হবে।');

    } else if (ContactLink.length == 0) {
        toastr.error('কোর্স লিংক অবশ্যই দিতে হবে।');
    } else if (ContactImg.length == 0) {
        toastr.error('কোর্স ছবি অবশ্যই দিতে হবে।');
    } else {
        $('#ContactUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>")
        axios.post('/ContactUpdate', {
                id: ContactID,
                contact_name: ContactName,
                contact_mobile: ContactDes,
                contact_email: ContactLink,
                contact_msg: ContactImg,
            })
            .then(function(response) {
                $('#ContactUpdateConfirmBtn').html("সেভ")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#updateContactModal').modal('hide');
                        toastr.success('এটি আপডেট হয়েছে !');
                        getContactData();
                    } else {
                        $('#updateContactModal').modal('hide');
                        toastr.error('দুঃখিত ! এটি আপডেট হয় নি !');
                        $('#ContactUpdateConfirmBtn').html("সেভ")
                        getCoursesData();
                    }

                } else {
                    $('#updateContactModal').modal('hide');
                    toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                    $('#ContactUpdateConfirmBtn').html("সেভ")
                }




            })
            .catch(function(error) {
                $('#updateContactModal').modal('hide');
                toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                $('#ContactUpdateConfirmBtn').html("সেভ")
            });

    }


}


</script>
@endsection