@extends('Layout.app')
@section('title','Review')
@section('content')

 
<div id="MainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-3">

<button id="addNewBtnId" class="btn my-3 btn-danger">নতুন সার্ভিস</button>

<table id="reviewDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">ছবি</th>
	  <th class="th-sm">নাম</th>
	  <th class="th-sm">ডেসক্রিপশন</th>
	  <th class="th-sm">এডিট</th>
	  <th class="th-sm">ডিলেট</th>
    </tr>
  </thead>
  <tbody id="review_table">
  
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
        <h5 id="reviewDeleteId" class="text-center p-3 mt-4  d-none"></h5>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">নাহ</button>
        <button id="reviewDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger"> হ্যাঁ </button>
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

		<h5 id="reviewEditId" class="mt-4  d-none"></h5>
  

<div id="reviewEditForm" class="w-100 d-none">
    <input type="text" id="reviewNameID" class="form-control mb-4" placeholder="সার্ভিস নেম">
    <input type="text" id="reviewDesID" class="form-control mb-4" placeholder="সার্ভিস ডেসক্রিপশন">
    <input type="text" id="reviewImgID" class="form-control mb-4" placeholder="Image Link">
</div>
									<!-- Loder Div -->
			<img id="reviewEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
			<div  id="reviewEditWrong" class="d-none">
			<h5>কিছু এটা সমস্যা রয়েছে !</h5>
			<p>অনুগ্রহপূর্বক আপনার ইন্টারনেট কানেকশান চেক করুন। এবং আবার রিলোড দিন !</p>
		</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">ক্যানসেল</button>
        <button id="reviewEditConfirmBtn" type="button" class="btn btn-sm btn-danger d-none"> সেভ </button>
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


  

<div id="reviewAddForm" class="w-100">
	<h6 class="mb-4">নতুন সার্ভিস যুক্ত করুন</h6>
    <input type="text" id="reviewNameAddID" class="form-control mb-4" placeholder="সার্ভিস নেম">
    <input type="text" id="reviewDesAddID" class="form-control mb-4" placeholder="সার্ভিস ডেসক্রিপশন">
    <input type="text" id="reviewImgAddID" class="form-control mb-4" placeholder="Image Link">
</div>
	


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">ক্যানসেল</button>
        <button id="reviewAddConfirmBtn" type="button" class="btn btn-sm btn-danger"> যুক্ত করুন </button>
      </div>
    </div>
  </div>
</div>

@section('script')

	<script type="text/javascript">
		getReviewData();
// custom js


// সার্ভিসেস টেবিল
function getReviewData() {




    axios.get('/getReviewData')

        .then(function(response) {

            if (response.status == 200) {

                $('#MainDiv').removeClass('d-none');
                $('#LoaderDiv').addClass('d-none');

                
                $('#reviewDataTable').DataTable().destroy();
                $('#review_table').empty();

                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td><img class='table-img' src=" + jsonData[i].img + "> </td>" +
                        "<td>" + jsonData[i].name + "</td>" +
                        "<td>" + jsonData[i].des + "</td>" +
                        "<td><a class='reviewEditBtn'   data-id=" + jsonData[i].id + "> <i class='fas fa-edit'> </td>" +
                        "<td><a class='reviewDeleteBtn' data-id=" + jsonData[i].id + "> <i class='fas fa-trash-alt'> </td>"
                    ).appendTo('#review_table');


                });




                // সার্ভিস টেবিল ডিলিট আইকোন
                $('.reviewDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#reviewDeleteId').html(id);
                    $('#deleteModal').modal('show');
                })




                // Review এডিট আইকোন ক্লিক
                $('.reviewEditBtn').click(function() {
                    var id = $(this).data('id');
                    $('#reviewEditId').html(id);
                    ReviewUpdateDetails(id);
                    $('#editModal').modal('show');
                })

// Pagination Jquery
$('#reviewDataTable').DataTable({"order":false});
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
$('#reviewDeleteConfirmBtn').click(function() {
    var id = $('#reviewDeleteId').html();
    ReviewDelete(id);
})


// সার্ভিস ডিলিট
function ReviewDelete(deleteID) {
    $('#reviewDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>")

    axios.post('/ReviewDelete', {
            id: deleteID
        })
        .then(function(response) {
            $('#reviewDeleteConfirmBtn').html("হ্যাঁ")
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteModal').modal('hide');
                    toastr.success('এটি ডিলিট হয়েছে !');
                    getReviewData();
                } else {
                    $('#deleteModal').modal('hide');
                    toastr.error('দুঃখিত ! এটি ডিলিট হয় নি।');
                    $('#reviewDeleteConfirmBtn').html("হ্যাঁ")
                    getReviewData();
                }

            } else {
                $('#deleteModal').modal('hide');
                toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                $('#reviewDeleteConfirmBtn').html("হ্যাঁ")
            }
        })
        .catch(function(error) {
            $('#deleteModal').modal('hide');
            toastr.warning('কিছু একটা সমস্যা রয়েছে !');
            $('#reviewDeleteConfirmBtn').html("হ্যাঁ")
        });
}



// সার্ভিস Update Detils
function ReviewUpdateDetails(detailsID) {
    axios.post('/ReviewDetails', {
            id: detailsID
        })
        .then(function(response) {

            if (response.status == 200) {
                $('#reviewEditForm').removeClass('d-none');
                $('#reviewEditConfirmBtn').removeClass('d-none');
                $('#reviewEditLoader').addClass('d-none');




                var jsonData = response.data;
                $('#reviewNameID').val(jsonData[0].name);
                $('#reviewDesID').val(jsonData[0].des);
                $('#reviewImgID').val(jsonData[0].img);
            } else {
                $('#reviewEditLoader').addClass('d-none');
                $('#reviewEditWrong').removeClass('d-none');
            }


        })
        .catch(function(error) {
            $('#reviewEditLoader').addClass('d-none');
            $('#reviewEditWrong').removeClass('d-none');
        });

}

// Review Modal Edit Save
$('#reviewEditConfirmBtn').click(function() {
    var id = $('#reviewEditId').html();
    var name = $('#reviewNameID').val();
    var des = $('#reviewDesID').val();
    var img = $('#reviewImgID').val();
    ReviewUpdate(id, name, des, img);
})




// Review Update 
function ReviewUpdate(reviewID, reviewName, reviewDes, reviewImg) {



    if (reviewName.length == 0) {
        toastr.error('সার্ভিস নাম অবশ্যই দিতে হবে।');
    } else if (reviewDes.length == 0) {
        toastr.error('সার্ভিস বিস্তারিত অবশ্যই দিতে হবে।');
    } else if (reviewImg.length == 0) {
        toastr.error('সার্ভিসের ছবি অবশ্যই দিতে হবে।');
    } else {
        $('#reviewEditConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>")
        axios.post('/ReviewUpdate', {
                id: reviewID,
                name: reviewName,
                des: reviewDes,
                img: reviewImg

            })
            .then(function(response) {
                $('#reviewEditConfirmBtn').html("সেভ")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#editModal').modal('hide');
                        toastr.success('এটি আপডেট হয়েছে !');
                        getReviewData();
                    } else {
                        $('#editModal').modal('hide');
                        toastr.error('দুঃখিত ! এটি আপডেট হয় নি !');
                        $('#reviewEditConfirmBtn').html("সেভ")
                        getReviewData();
                    }

                } else {
                    $('#editModal').modal('hide');
                    toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                    $('#reviewEditConfirmBtn').html("সেভ")
                }




            })
            .catch(function(error) {
                $('#editModal').modal('hide');
                toastr.warning('কিছু একটা সমস্যা রয়েছে 1!');
                $('#reviewEditConfirmBtn').html("সেভ")
            });

    }


}


// Review Add New Btn Click
$('#addNewBtnId').click(function() {

    $('#addModal').modal('show');
});



// Review Modal Save
$('#reviewAddConfirmBtn').click(function() {
    var name = $('#reviewNameAddID').val();
    var des = $('#reviewDesAddID').val();
    var img = $('#reviewImgAddID').val();
    ReviewAdd(name, des, img);
})


// Review Add Method
function ReviewAdd(reviewName, reviewDes, reviewImg) {



    if (reviewName.length == 0) {
        toastr.error('সার্ভিস নাম অবশ্যই দিতে হবে।');
    } else if (reviewDes.length == 0) {
        toastr.error('সার্ভিস বিস্তারিত অবশ্যই দিতে হবে।');
    } else if (reviewImg.length == 0) {
        toastr.error('সার্ভিসের ছবি অবশ্যই দিতে হবে।');
    } else {
        $('#reviewAddConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>")
        axios.post('/ReviewAdd', {
                name: reviewName,
                des: reviewDes,
                img:reviewImg

            })
            .then(function(response) {
                $('#reviewAddConfirmBtn').html("সেভ")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addModal').modal('hide');
                        toastr.success('এটি আপডেট হয়েছে !');
                        getReviewData();
                    } else {
                        $('#addModal').modal('hide');
                        toastr.error('দুঃখিত ! এটি আপডেট হয় নি !');
                        $('#reviewAddConfirmBtn').html("সেভ")
                        getReviewData();
                    }

                } else {
                    $('#addModal').modal('hide');
                    toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                    $('#reviewAddConfirmBtn').html("সেভ")
                }




            })
            .catch(function(error) {
                $('#addModal').modal('hide');
                toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                $('#reviewAddConfirmBtn').html("সেভ")
            });

    }


}



// custom js






	</script>

@endsection
