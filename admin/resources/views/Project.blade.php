@extends('Layout.app')
@section('title','Project')
@section('content')


<div id="MainDivProject" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

    <button id="addNewProjectBtnId" class="btn my-3 btn-danger">নতুন প্রজেক্ট</button>

<table id="projectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">নাম </th>
      <th class="th-sm">তথ্য</th>
      <th class="th-sm">Edit</th>
      <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="project_table">

  </tbody>
</table>
</div>
</div>
</div>


<div id="LoaderDivProject" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">
        <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
</div>
</div>
</div>




<div id="WrongDivProject" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">
        <h3>কিছু এটা সমস্যা রয়েছে !</h3>
        <p>অনুগ্রহপূর্বক আপনার ইন্টারনেট কানেকশান চেক করুন। এবং আবার রিলোড দিন !</p>
</div>
</div>
</div>


<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
        <div class="row">
            <div class="col-md-6">
                <input id="ProjectNameId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
                <input id="ProjectDesId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
            </div>
            <div class="col-md-6">
                <input id="ProjectLinkId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
                <input id="ProjectImgId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
            </div>
        </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="ProjectAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="updateProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">প্রজেক্ট আপডেট</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">


        <p id="projectEditId" class="mt-4  d-none"></p>


       <div id="projectEditFrom" class="container d-none">
        <div class="row">
            <div class="col-md-6">
                <input id="ProjectNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
                <input id="ProjectDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
            </div>
            <div class="col-md-6">
                <input id="ProjectLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
                <input id="ProjectImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
            </div>
        </div>
       </div>
                            <!-- Loder Div -->
            <img id="projectEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
            <div  id="projectEditWrong" class="d-none">
            <h5>কিছু এটা সমস্যা রয়েছে !</h5>
            <p>অনুগ্রহপূর্বক আপনার ইন্টারনেট কানেকশান চেক করুন। এবং আবার রিলোড দিন !</p>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Cancel</button>
        <button  id="ProjectUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
@endsection
<!-- Delete Modal -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="text-center p-3 mt-4">আপনি এটি ডিলিট করতে চান?</h5>
        <h5 id="ProjectDeleteId" class="text-center p-3 mt-4 d-none"></h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">নাহ</button>
        <button id="projectDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger"> হ্যাঁ </button>
      </div>
    </div>
  </div>
</div>


@section('script')
    <script type="text/javascript">
getProjectData();

// সার্ভিসেস টেবিল
function getProjectData() {
    axios.get('/getProjectData')
        .then(function(response) {
            if (response.status == 200) {
                $('#MainDivProject').removeClass('d-none');
                $('#LoaderDivProject').addClass('d-none');

                $('#projectDataTable').DataTable().destroy();
                $('#project_table').empty();

                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td>" + jsonData[i].project_name + "</td>" +
                        "<td>" + jsonData[i].project_des + "</td>" +


                        "<td> <a class='projectEditBtn'   data-id=" + jsonData[i].id + "> <i class='fas fa-edit'>   </td>" +

                        "<td> <a class='projectDeleteBtn' data-id=" + jsonData[i].id + "> <i class='fas fa-trash-alt'> </i></a>  </td>"
                    ).appendTo('#project_table');
                });

                $('.projectDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#ProjectDeleteId').html(id);
                    $('#deleteProjectModal').modal('show');

                })
                $('.projectEditBtn').click(function() {
                    var id = $(this).data('id');
                    ProjectUpdateDetails(id);
                    $('#projectEditId').html(id);
                    $('#updateProjectModal').modal('show');

                })



                // Pagination Jquery
                $('#projectDataTable').DataTable({
                    "order": false
                });
                $('.dataTables_length').addClass('bs-select');

                // Pagination Jquery End
            } else {

                $('#LoaderDivProject').addClass('d-none');
                $('#WrongDivProject').removeClass('d-none');

            }

        })
        .catch(function(error) {
            $('#LoaderDivProject').addClass('d-none');
            $('#WrongDivProject').removeClass('d-none');

        });
}

$('#addNewProjectBtnId').click(function() {
    $('#addProjectModal').modal('show');
});




$('#ProjectAddConfirmBtn').click(function() {
    var ProjectName = $('#ProjectNameId').val();
    var ProjectDes = $('#ProjectDesId').val();
    var ProjectLink = $('#ProjectLinkId').val();
    var ProjectImg = $('#ProjectImgId').val();

    ProjectAdd(ProjectName, ProjectDes, ProjectLink, ProjectImg);
})
// Service Add Method
function ProjectAdd(ProjectName, ProjectDes, ProjectLink, ProjectImg) {



    if (ProjectName.length == 0) {
        toastr.error('কোর্স নাম অবশ্যই দিতে হবে।');

    } else if (ProjectDes.length == 0) {
        toastr.error('কোর্স বিস্তারিত অবশ্যই দিতে হবে।');
    } else if (ProjectLink.length == 0) {
        toastr.error('কোর্স লিংক অবশ্যই দিতে হবে।');
    } else if (ProjectImg.length == 0) {
        toastr.error('কোর্স ছবি অবশ্যই দিতে হবে।');
    } else {
        $('#ProjectAddConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>")
        axios.post('/ProjectAdd', {
                project_name: ProjectName,
                project_des: ProjectDes,
                project_link: ProjectLink,
                project_img: ProjectImg,

            })
            .then(function(response) {
                $('#ProjectAddConfirmBtn').html("সেভ");
                if (response.status == 200) {

                    if (response.data == 1) {
                        $('#addProjectModal').modal('hide');
                        toastr.success('এটি যুক্ত হয়েছে !');
                        getProjectData();
                    } else {
                        $('#addProjectModal').modal('hide');
                        toastr.error('দুঃখিত ! এটি যুক্ত  হয় নি !');
                        $('#ProjectAddConfirmBtn').html("সেভ")
                        getProjectData();
                    }

                } else {
                    $('#addProjectModal').modal('hide');
                    toastr.warning('কিছু একটা সমস্যা রয়েছে 1 !');
                    $('#ProjectAddConfirmBtn').html("সেভ")
                }
            })
            .catch(function(error) {
                $('#addProjectModal').modal('hide');
                toastr.warning('কিছু একটা সমস্যা রয়েছে 2 !');
                $('#ProjectAddConfirmBtn').html("সেভ")
            });

    }


}

// Project Delete Confirm
$('#projectDeleteConfirmBtn').click(function() {
    var id = $('#ProjectDeleteId').html();
    ProjectDelete(id);
})




// Project Delete
function ProjectDelete(deleteID) {
    $('#projectDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>")

    axios.post('/ProjectDelete', {
            id: deleteID
        })
        .then(function(response) {
            $('#projectDeleteConfirmBtn').html("হ্যাঁ")
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteProjectModal').modal('hide');
                    toastr.success('এটি ডিলিট হয়েছে !');
                    getProjectData();
                } else {
                    $('#deleteProjectModal').modal('hide');
                    toastr.error('দুঃখিত ! এটি ডিলিট হয় নি।');
                    $('#projectDeleteConfirmBtn').html("হ্যাঁ")
                    getProjectData();
                }

            } else {
                $('#deleteProjectModal').modal('hide');
                toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                $('#projectDeleteConfirmBtn').html("হ্যাঁ")
            }
        })
        .catch(function(error) {
            $('#deleteProjectModal').modal('hide');
            toastr.warning('কিছু একটা সমস্যা রয়েছে !');
            $('#projectDeleteConfirmBtn').html("হ্যাঁ")
        });
}



// Project Update


function ProjectUpdateDetails(detailsID) {




    axios.post('/ProjectDetails', {
            id: detailsID
        })
        .then(function(response) {

            if (response.status == 200) {

                $('#projectEditFrom').removeClass('d-none');
                $('#projectEditLoader').addClass('d-none');


                var jsonData = response.data;
                $('#ProjectNameUpdateId').val(jsonData[0].project_name);
                $('#ProjectDesUpdateId').val(jsonData[0].project_des);
                $('#ProjectFeeUpdateId').val(jsonData[0].project_fee);
                $('#ProjectEnrollUpdateId').val(jsonData[0].project_totalenroll);
                $('#ProjectClassUpdateId').val(jsonData[0].project_totalclass);
                $('#ProjectLinkUpdateId').val(jsonData[0].project_link);
                $('#ProjectImgUpdateId').val(jsonData[0].project_img);
            } else {
                $('#projectEditLoader').addClass('d-none');
                $('#projectEditWrong').removeClass('d-none');
            }


        })
        .catch(function(error) {
            $('#projectEditLoader').addClass('d-none');
            $('#projectEditWrong').removeClass('d-none');
        });

}

$('#ProjectUpdateConfirmBtn').click(function() {
    var ProjectID = $('#projectEditId').html();
    var ProjectName = $('#ProjectNameUpdateId').val();
    var ProjectDes = $('#ProjectDesUpdateId').val();
    var ProjectLink = $('#ProjectLinkUpdateId').val();
    var ProjectImg = $('#ProjectImgUpdateId').val();
    ProjectUpdate(ProjectID, ProjectName, ProjectDes, ProjectLink, ProjectImg);
})


// Service Update
function ProjectUpdate(ProjectID, ProjectName, ProjectDes, ProjectLink, ProjectImg) {


    if (ProjectName.length == 0) {
        toastr.error('কোর্স নাম অবশ্যই দিতে হবে।');

    } else if (ProjectDes.length == 0) {
        toastr.error('কোর্স বিস্তারিত অবশ্যই দিতে হবে।');

    } else if (ProjectLink.length == 0) {
        toastr.error('কোর্স লিংক অবশ্যই দিতে হবে।');
    } else if (ProjectImg.length == 0) {
        toastr.error('কোর্স ছবি অবশ্যই দিতে হবে।');
    } else {
        $('#ProjectUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>")
        axios.post('/ProjectUpdate', {
                id: ProjectID,
                project_name: ProjectName,
                project_des: ProjectDes,
                project_link: ProjectLink,
                project_img: ProjectImg,
            })
            .then(function(response) {
                $('#ProjectUpdateConfirmBtn').html("সেভ")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#updateProjectModal').modal('hide');
                        toastr.success('এটি আপডেট হয়েছে !');
                        getProjectData();
                    } else {
                        $('#updateProjectModal').modal('hide');
                        toastr.error('দুঃখিত ! এটি আপডেট হয় নি !');
                        $('#ProjectUpdateConfirmBtn').html("সেভ")
                        getCoursesData();
                    }

                } else {
                    $('#updateProjectModal').modal('hide');
                    toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                    $('#ProjectUpdateConfirmBtn').html("সেভ")
                }




            })
            .catch(function(error) {
                $('#updateProjectModal').modal('hide');
                toastr.warning('কিছু একটা সমস্যা রয়েছে !');
                $('#ProjectUpdateConfirmBtn').html("সেভ")
            });

    }


}


</script>
@endsection
