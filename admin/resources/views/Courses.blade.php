@extends('Layout.app')
@section('title','Course')
@section('content')


<div id="MainDivCourse" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

	<button id="addNewCourseBtnId" class="btn my-3 btn-danger">নতুন কোর্স</button>

<table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Course Fee</th>
	  <th class="th-sm">Class</th>
	  <th class="th-sm">Enroll</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="course_table">

  </tbody>
</table>
</div>
</div>
</div>


<div id="LoaderDivCourse" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">
		<img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
</div>
</div>
</div>




<div id="WrongDivCourse" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">
		<h3>কিছু এটা সমস্যা রয়েছে !</h3>
		<p>অনুগ্রহপূর্বক আপনার ইন্টারনেট কানেকশান চেক করুন। এবং আবার রিলোড দিন !</p>
</div>
</div>
</div>


<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">কোর্স আপডেট</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">


		<p id="courseEditId" class="mt-4  d-none"></p>


       <div id="courseEditFrom" class="container d-none">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
       						<!-- Loder Div -->
			<img id="courseEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
			<div  id="courseEditWrong" class="d-none">
			<h5>কিছু এটা সমস্যা রয়েছে !</h5>
			<p>অনুগ্রহপূর্বক আপনার ইন্টারনেট কানেকশান চেক করুন। এবং আবার রিলোড দিন !</p>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Cancel</button>
        <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
@endsection
<!-- Delete Modal -->
<div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="text-center p-3 mt-4">আপনি এটি ডিলিট করতে চান?</h5>
        <h5 id="CourseDeleteId" class="text-center p-3 mt-4 d-none"></h5>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">নাহ</button>
        <button id="courseDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger"> হ্যাঁ </button>
      </div>
    </div>
  </div>
</div>


@section('script')
	<script type="text/javascript">  
getCoursesData();

// সার্ভিসেস টেবিল
function getCoursesData() {
    axios.get('/getCoursesData')
        .then(function(response) {
            if (response.status == 200) {
                $('#MainDivCourse').removeClass('d-none');
                $('#LoaderDivCourse').addClass('d-none');

                $('#courseDataTable').DataTable().destroy();
                $('#course_table').empty();

                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td>" + jsonData[i].course_name + "</td>" +
                        "<td>" + jsonData[i].course_fee + "</td>" +
                        "<td>" + jsonData[i].course_totalclass + "</td>" +
                        "<td>" + jsonData[i].course_totalenroll + "</td>" +

                        "<td> <a class='courseEditBtn'   data-id=" + jsonData[i].id + "> <i class='fas fa-edit'>   </td>" +

                        "<td> <a class='courseDeleteBtn' data-id=" + jsonData[i].id + "> <i class='fas fa-trash-alt'> </i></a>  </td>"
                    ).appendTo('#course_table');
                });

                $('.courseDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#CourseDeleteId').html(id);
                    $('#deleteCourseModal').modal('show');

                })
                $('.courseEditBtn').click(function() {
                    var id = $(this).data('id');
                    CourseUpdateDetails(id);
                    $('#courseEditId').html(id);
                    $('#updateCourseModal').modal('show');

                })



                // Pagination Jquery
                $('#courseDataTable').DataTable({
                    "order": false
                });
                $('.dataTables_length').addClass('bs-select');

                // Pagination Jquery End
            } else {

                $('#LoaderDivCoures').addClass('d-none');
                $('#WrongDivCoures').removeClass('d-none');

            }

        })
        .catch(function(error) {
            $('#LoaderDivCoures').addClass('d-none');
            $('#WrongDivCoures').removeClass('d-none');

        });
}

$('#addNewCourseBtnId').click(function() {
    $('#addCourseModal').modal('show');
});




$('#CourseAddConfirmBtn').click(function() {
    var CourseName = $('#CourseNameId').val();
    var CourseDes = $('#CourseDesId').val();
    var CourseFee = $('#CourseFeeId').val();
    var CourseEnroll = $('#CourseEnrollId').val();
    var CourseClass = $('#CourseClassId').val();
    var CourseLink = $('#CourseLinkId').val();
    var CourseImg = $('#CourseImgId').val();

    CourseAdd(CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg);
})
// Service Add Method
function CourseAdd(CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg) {



    if (CourseName.length == 0) {
        toastr.error('কোর্স নাম অবশ্যই দিতে হবে।');

    } else if (CourseDes.length == 0) {
        toastr.error('কোর্স বিস্তারিত অবশ্যই দিতে হবে।');

    } else if (CourseFee.length == 0) {
        toastr.error('কোর্স ফি অবশ্যই দিতে হবে।');
    } else if (CourseEnroll.length == 0) {
        toastr.error('কোর্স ইনরোল অবশ্যই দিতে হবে।');
    } else if (CourseClass.length == 0) {
        toastr.error('কোর্স ক্লাস অবশ্যই দিতে হবে।');
    } else if (CourseLink.length == 0) {
        toastr.error('কোর্স লিংক অবশ্যই দিতে হবে।');
    } else if (CourseImg.length == 0) {
        toastr.error('কোর্স ছবি অবশ্যই দিতে হবে।');
    } else {
        $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>")
        axios.post('/CoursesAdd', {
                course_name: CourseName,
                course_des: CourseDes,
                course_fee: CourseFee,
                course_totalenroll: CourseEnroll,
                course_totalclass: CourseClass,
                course_link: CourseLink,
                course_img: CourseImg,

            })
            .then(function(response) {
                $('#CourseAddConfirmBtn').html("সেভ");
                if (response.status == 200) {

                    if (response.data == 1) {
                        $('#addCourseModal').modal('hide');
                        toastr.success('এটি যুক্ত হয়েছে !');
                        getCoursesData();
                    } else {
                        $('#addCourseModal').modal('hide');
                        toastr.error('দুঃখিত ! এটি যুক্ত  হয় নি !');
                        $('#CourseAddConfirmBtn').html("সেভ")
                        getCoursesData();
                    }

                } else {
                    $('#addCourseModal').modal('hide');
                    toastr.warning('কিছু একটা সমস্যা রয়েছে 1 !');
                    $('#CourseAddConfirmBtn').html("সেভ")
                }
            })
            .catch(function(error) {
                $('#addCourseModal').modal('hide');
                toastr.warning('কিছু একটা সমস্যা রয়েছে 2 !');
                $('#CourseAddConfirmBtn').html("সেভ")
            });

    }


}

// Course Delete Confirm
$('#courseDeleteConfirmBtn').click(function() {
    var id = $('#CourseDeleteId').html();
    CourseDelete(id);
})




// Course Delete
function CourseDelete(deleteID) {
    $('#courseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>")

    axios.post('/CoursesDelete', {
            id: deleteID
        })
        .then(function(response) {
            $('#courseDeleteConfirmBtn').html("হ্যাঁ")
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteCourseModal').modal('hide');
                    toastr.success('এটি ডিলিট হয়েছে !');
                    getCoursesData();
                } else {
                    $('#deleteCourseModal').modal('hide');
                    toastr.error('দুঃখিত ! এটি ডিলিট হয় নি।');
                    $('#courseDeleteConfirmBtn').html("হ্যাঁ")
                    getCoursesData();
                }

            } else {
                $('#deleteCourseModal').modal('hide');
                toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                $('#courseDeleteConfirmBtn').html("হ্যাঁ")
            }
        })
        .catch(function(error) {
            $('#deleteCourseModal').modal('hide');
            toastr.warning('কিছু একটা সমস্যা রয়েছে !');
            $('#courseDeleteConfirmBtn').html("হ্যাঁ")
        });
}
// Course Update


function CourseUpdateDetails(detailsID) {




    axios.post('/CoursesDetails', {
            id: detailsID
        })
        .then(function(response) {

            if (response.status == 200) {

                $('#courseEditFrom').removeClass('d-none');
                $('#courseEditLoader').addClass('d-none');


                var jsonData = response.data;
                $('#CourseNameUpdateId').val(jsonData[0].course_name);
                $('#CourseDesUpdateId').val(jsonData[0].course_des);
                $('#CourseFeeUpdateId').val(jsonData[0].course_fee);
                $('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
                $('#CourseClassUpdateId').val(jsonData[0].course_totalclass);
                $('#CourseLinkUpdateId').val(jsonData[0].course_link);
                $('#CourseImgUpdateId').val(jsonData[0].course_img);
            } else {
                $('#courseEditLoader').addClass('d-none');
                $('#courseEditWrong').removeClass('d-none');
            }


        })
        .catch(function(error) {
            $('#courseEditLoader').addClass('d-none');
            $('#courseEditWrong').removeClass('d-none');
        });

}

$('#CourseUpdateConfirmBtn').click(function() {
    var CourseID = $('#courseEditId').html();
    var CourseName = $('#CourseNameUpdateId').val();
    var CourseDes = $('#CourseDesUpdateId').val();
    var CourseFee = $('#CourseFeeUpdateId').val();
    var CourseEnroll = $('#CourseEnrollUpdateId').val();
    var CourseClass = $('#CourseClassUpdateId').val();
    var CourseLink = $('#CourseLinkUpdateId').val();
    var CourseImg = $('#CourseImgUpdateId').val();
    CourseUpdate(CourseID, CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg);
})


// Service Update 
function CourseUpdate(CourseID, CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg) {


    if (CourseName.length == 0) {
        toastr.error('কোর্স নাম অবশ্যই দিতে হবে।');

    } else if (CourseDes.length == 0) {
        toastr.error('কোর্স বিস্তারিত অবশ্যই দিতে হবে।');

    } else if (CourseFee.length == 0) {
        toastr.error('কোর্স ফি অবশ্যই দিতে হবে।');
    } else if (CourseEnroll.length == 0) {
        toastr.error('কোর্স ইনরোল অবশ্যই দিতে হবে।');
    } else if (CourseClass.length == 0) {
        toastr.error('কোর্স ক্লাস অবশ্যই দিতে হবে।');
    } else if (CourseLink.length == 0) {
        toastr.error('কোর্স লিংক অবশ্যই দিতে হবে।');
    } else if (CourseImg.length == 0) {
        toastr.error('কোর্স ছবি অবশ্যই দিতে হবে।');
    } else {
        $('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>")
        axios.post('/CoursesUpdate', {
                id: CourseID,
                course_name: CourseName,
                course_des: CourseDes,
                course_fee: CourseFee,
                course_totalenroll: CourseEnroll,
                course_totalclass: CourseClass,
                course_link: CourseLink,
                course_img: CourseImg,
            })
            .then(function(response) {
                $('#CourseUpdateConfirmBtn').html("সেভ")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#updateCourseModal').modal('hide');
                        toastr.success('এটি আপডেট হয়েছে !');
                        getCoursesData();
                    } else {
                        $('#updateCourseModal').modal('hide');
                        toastr.error('দুঃখিত ! এটি আপডেট হয় নি !');
                        $('#CourseUpdateConfirmBtn').html("সেভ")
                        getCoursesData();
                    }

                } else {
                    $('#updateCourseModal').modal('hide');
                    toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                    $('#CourseUpdateConfirmBtn').html("সেভ")
                }




            })
            .catch(function(error) {
                $('#updateCourseModal').modal('hide');
                toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                $('#CourseUpdateConfirmBtn').html("সেভ")
            });

    }


}


</script>
@endsection