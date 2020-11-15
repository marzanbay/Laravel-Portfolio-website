@extends('Layout.app')
@section('title','Service')
@section('content')

 
<div id="MainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-3">

<button id="addNewBtnId" class="btn my-3 btn-danger">নতুন সার্ভিস</button>

<table id="serviceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">ছবি</th>
	  <th class="th-sm">নাম</th>
	  <th class="th-sm">ডেসক্রিপশন</th>
	  <th class="th-sm">এডিট</th>
	  <th class="th-sm">ডিলেট</th>
    </tr>
  </thead>
  <tbody id="service_table">
  
  </tbody>
</table>
</div>
</div>
</div>



<div id="LoaderDiv" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">
		<img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
</div>
</div>
</div>




<div id="WrongDiv" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">
		<h3>কিছু এটা সমস্যা রয়েছে !</h3>
		<p>অনুগ্রহপূর্বক আপনার ইন্টারনেট কানেকশান চেক করুন। এবং আবার রিলোড দিন !</p>
</div>
</div>





@endsection

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="text-center p-3 mt-4">আপনি এটি ডিলিট করতে চান?</h5>
        <h5 id="serviceDeleteId" class="text-center p-3 mt-4  d-none"></h5>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">নাহ</button>
        <button id="serviceDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger"> হ্যাঁ </button>
      </div>
    </div>
  </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">সার্ভিস আপডেট</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-5 text-center">

		<h5 id="serviceEditId" class="mt-4  d-none"></h5>
  

<div id="serviceEditForm" class="w-100 d-none">
    <input type="text" id="serviceNameID" class="form-control mb-4" placeholder="সার্ভিস নেম">
    <input type="text" id="serviceDesID" class="form-control mb-4" placeholder="সার্ভিস ডেসক্রিপশন">
    <input type="text" id="serviceImgID" class="form-control mb-4" placeholder="Image Link">
</div>
									<!-- Loder Div -->
			<img id="serviceEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
			<div  id="serviceEditWrong" class="d-none">
			<h5>কিছু এটা সমস্যা রয়েছে !</h5>
			<p>অনুগ্রহপূর্বক আপনার ইন্টারনেট কানেকশান চেক করুন। এবং আবার রিলোড দিন !</p>
		</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">ক্যানসেল</button>
        <button id="serviceEditConfirmBtn" type="button" class="btn btn-sm btn-danger d-none"> সেভ </button>
      </div>
    </div>
  </div>
</div>


<!-- Add New -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-5 text-center">


  

<div id="serviceAddForm" class="w-100">
	<h6 class="mb-4">নতুন সার্ভিস যুক্ত করুন</h6>
    <input type="text" id="serviceNameAddID" class="form-control mb-4" placeholder="সার্ভিস নেম">
    <input type="text" id="serviceDesAddID" class="form-control mb-4" placeholder="সার্ভিস ডেসক্রিপশন">
    <input type="text" id="serviceImgAddID" class="form-control mb-4" placeholder="Image Link">
</div>
	


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">ক্যানসেল</button>
        <button id="serviceAddConfirmBtn" type="button" class="btn btn-sm btn-danger"> যুক্ত করুন </button>
      </div>
    </div>
  </div>
</div>

@section('script')

	<script type="text/javascript">
		getServicesData();
// custom js


// সার্ভিসেস টেবিল
function getServicesData() {




    axios.get('/getServicesData')

        .then(function(response) {

            if (response.status == 200) {

                $('#MainDiv').removeClass('d-none');
                $('#LoaderDiv').addClass('d-none');

                
                $('#serviceDataTable').DataTable().destroy();
                $('#service_table').empty();

                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td><img class='table-img' src=" + jsonData[i].service_img + "> </td>" +
                        "<td>" + jsonData[i].service_name + "</td>" +
                        "<td>" + jsonData[i].service_des + "</td>" +
                        "<td><a class='serviceEditBtn'   data-id=" + jsonData[i].id + "> <i class='fas fa-edit'> </td>" +
                        "<td><a class='serviceDeleteBtn' data-id=" + jsonData[i].id + "> <i class='fas fa-trash-alt'> </td>"
                    ).appendTo('#service_table');


                });




                // সার্ভিস টেবিল ডিলিট আইকোন
                $('.serviceDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#serviceDeleteId').html(id);
                    $('#deleteModal').modal('show');
                })




                // Services এডিট আইকোন ক্লিক
                $('.serviceEditBtn').click(function() {
                    var id = $(this).data('id');
                    $('#serviceEditId').html(id);
                    ServiceUpdateDetails(id);
                    $('#editModal').modal('show');
                })

// Pagination Jquery
$('#serviceDataTable').DataTable({"order":false});
$('.dataTables_length').addClass('bs-select');

// Pagination Jquery End

            } else {

                $('#LoaderDiv').addClass('d-none');
                $('#WrongDiv').removeClass('d-none');

            }



        }).catch(function(error) {

            $('#LoaderDiv').addClass('d-none');
            $('#WrongDiv').removeClass('d-none');

        });

}


// সার্ভিস মডাল ডিলিট বাটন
$('#serviceDeleteConfirmBtn').click(function() {
    var id = $('#serviceDeleteId').html();
    ServiceDelete(id);
})


// সার্ভিস ডিলিট
function ServiceDelete(deleteID) {
    $('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>")

    axios.post('/ServiceDelete', {
            id: deleteID
        })
        .then(function(response) {
            $('#serviceDeleteConfirmBtn').html("হ্যাঁ")
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteModal').modal('hide');
                    toastr.success('এটি ডিলিট হয়েছে !');
                    getServicesData();
                } else {
                    $('#deleteModal').modal('hide');
                    toastr.error('দুঃখিত ! এটি ডিলিট হয় নি।');
                    $('#serviceDeleteConfirmBtn').html("হ্যাঁ")
                    getServicesData();
                }

            } else {
                $('#deleteModal').modal('hide');
                toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                $('#serviceDeleteConfirmBtn').html("হ্যাঁ")
            }
        })
        .catch(function(error) {
            $('#deleteModal').modal('hide');
            toastr.warning('কিছু একটা সমস্যা রয়েছে !');
            $('#serviceDeleteConfirmBtn').html("হ্যাঁ")
        });
}



// সার্ভিস Update Detils
function ServiceUpdateDetails(detailsID) {
    axios.post('/ServiceDetails', {
            id: detailsID
        })
        .then(function(response) {

            if (response.status == 200) {
                $('#serviceEditForm').removeClass('d-none');
                $('#serviceEditConfirmBtn').removeClass('d-none');
                $('#serviceEditLoader').addClass('d-none');




                var jsonData = response.data;
                $('#serviceNameID').val(jsonData[0].service_name);
                $('#serviceDesID').val(jsonData[0].service_des);
                $('#serviceImgID').val(jsonData[0].service_img);
            } else {
                $('#serviceEditLoader').addClass('d-none');
                $('#serviceEditWrong').removeClass('d-none');
            }


        })
        .catch(function(error) {
            $('#serviceEditLoader').addClass('d-none');
            $('#serviceEditWrong').removeClass('d-none');
        });

}

// Service Modal Edit Save
$('#serviceEditConfirmBtn').click(function() {
    var id = $('#serviceEditId').html();
    var name = $('#serviceNameID').val();
    var des = $('#serviceDesID').val();
    var img = $('#serviceImgID').val();
    ServiceUpdate(id, name, des, img);
})




// Service Update 
function ServiceUpdate(serviceID, serviceName, serviceDes, serviceImg) {



    if (serviceName.length == 0) {
        toastr.error('সার্ভিস নাম অবশ্যই দিতে হবে।');
    } else if (serviceDes.length == 0) {
        toastr.error('সার্ভিস বিস্তারিত অবশ্যই দিতে হবে।');
    } else if (serviceImg.length == 0) {
        toastr.error('সার্ভিসের ছবি অবশ্যই দিতে হবে।');
    } else {
        $('#serviceEditConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>")
        axios.post('/ServiceUpdate', {
                id: serviceID,
                name: serviceName,
                des: serviceDes,
                img: serviceImg

            })
            .then(function(response) {
                $('#serviceEditConfirmBtn').html("সেভ")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#editModal').modal('hide');
                        toastr.success('এটি আপডেট হয়েছে !');
                        getServicesData();
                    } else {
                        $('#editModal').modal('hide');
                        toastr.error('দুঃখিত ! এটি আপডেট হয় নি !');
                        $('#serviceEditConfirmBtn').html("সেভ")
                        getServicesData();
                    }

                } else {
                    $('#editModal').modal('hide');
                    toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                    $('#serviceEditConfirmBtn').html("সেভ")
                }




            })
            .catch(function(error) {
                $('#editModal').modal('hide');
                toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                $('#serviceEditConfirmBtn').html("সেভ")
            });

    }


}


// Service Add New Btn Click
$('#addNewBtnId').click(function() {

    $('#addModal').modal('show');
});



// Service Modal Save
$('#serviceAddConfirmBtn').click(function() {
    var name = $('#serviceNameAddID').val();
    var des = $('#serviceDesAddID').val();
    var img = $('#serviceImgAddID').val();
    ServiceAdd(name, des, img);
})


// Service Add Method
function ServiceAdd(serviceName, serviceDes, serviceImg) {



    if (serviceName.length == 0) {
        toastr.error('সার্ভিস নাম অবশ্যই দিতে হবে।');
    } else if (serviceDes.length == 0) {
        toastr.error('সার্ভিস বিস্তারিত অবশ্যই দিতে হবে।');
    } else if (serviceImg.length == 0) {
        toastr.error('সার্ভিসের ছবি অবশ্যই দিতে হবে।');
    } else {
        $('#serviceAddConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>")
        axios.post('/ServiceAdd', {
                name: serviceName,
                des: serviceDes,
                img: serviceImg

            })
            .then(function(response) {
                $('#serviceAddConfirmBtn').html("সেভ")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addModal').modal('hide');
                        toastr.success('এটি আপডেট হয়েছে !');
                        getServicesData();
                    } else {
                        $('#addModal').modal('hide');
                        toastr.error('দুঃখিত ! এটি আপডেট হয় নি !');
                        $('#serviceAddConfirmBtn').html("সেভ")
                        getServicesData();
                    }

                } else {
                    $('#addModal').modal('hide');
                    toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                    $('#serviceAddConfirmBtn').html("সেভ")
                }




            })
            .catch(function(error) {
                $('#addModal').modal('hide');
                toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                $('#serviceAddConfirmBtn').html("সেভ")
            });

    }


}



// custom js






	</script>

@endsection
