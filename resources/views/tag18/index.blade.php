<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application with image Laravel 8 and ajax </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body>
    {{-- {-- add new employee modal start --} --}}
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
      data-bs-backdrop="static" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>


            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
            @csrf
            <div class="modal-body p-4 bg-light">
              <div class="row">
                <div class="col-lg">
                  <label for="tag">Tag</label>
                  <input type="text" name="tag" class="form-control" placeholder="Tag" required>
                </div>
                <div class="col-lg">
                  <label for="descripcion">Descripcion</label>
                  <input type="text" name="descripcion" class="form-control" placeholder="descripcion" required>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" id="add_employee_btn" class="btn btn-primary">Add Employee</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- add new employee modal end --}}

    {{-- edit employee modal start --}}
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
      data-bs-backdrop="static" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="emp_id" id="emp_id">
            {{-- <input type="hidden" name="emp_avatar" id="emp_avatar"> --}}
            <div class="modal-body p-4 bg-light">
              <div class="row">
                <div class="col-lg">
                  <label for="tag">Tag</label>
                  <input type="text" name="tag" id="tag" class="form-control" placeholder="Tag" required>
                </div>
                <div class="col-lg">
                  <label for="descripcion">Descripcion</label>
                  <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion" required>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" id="edit_employee_btn" class="btn btn-success">Update Employee</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- edit employee modal end --}}

    <body class="bg-light">
      <div class="container">
        <div class="row my-5">
          <div class="col-lg-12">
            <div class="card shadow">
              <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                <h3 class="text-light">Manage Employees</h3>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i
                    class="bi-plus-circle me-2"></i>Add New Employee</button>
              </div>
              <div class="card-body" id="show_all_employees">
                <h1 class="text-center text-secondary my-5">Loading...</h1>
              </div>
            </div>
          </div>
        </div>
      </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap5.min.js"></script>

    <script>

   /*  function readImage (input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#imagenSeleccionada').attr('src', e.target.result); // Renderizamos la imagen
          }
          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#avatar").change(function () {
        // Código a ejecutar cuando se detecta un cambio de archiv
        readImage(this);
      });
 */

 // add new employee ajax request
  $("#add_employee_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_employee_btn").text('Adding...');
        $.ajax({
          url: '{{ route('store.tag18') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Added!',
                'Employee Added Successfully!',
                'success'
              )
              fetchAllEmployees();
            }
            $("#add_employee_btn").text('Add Employee');
            $("#add_employee_form")[0].reset();
            $("#addEmployeeModal").modal('hide');
          }
        });
      });



        //getch all employees ajax request
        fetchAllEmployees();

      function fetchAllEmployees() {
            $.ajax({
          url: '{{ route('fetchAll.tag18') }}',
          method: 'get',
          success: function(response) {
            $("#show_all_employees").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
    });
    }


// delete employee ajax request
$(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('delete.tag18') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                fetchAllEmployees();
              }
            });
          }
        })
      });



 // update employee ajax request
 $("#edit_employee_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_employee_btn").text('Updating...');
        $.ajax({
          url: '{{ route('update.tag18') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Updated!',
                'Employee Updated Successfully!',
                'success'
              )
              fetchAllEmployees();
            }
            $("#edit_employee_btn").text('Update Employee');
            $("#edit_employee_form")[0].reset();
            $("#editEmployeeModal").modal('hide');
          }
        });
      });




 // edit employee ajax request
  $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('edit.tag18') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#tag").val(response.tag);
            $("#descripcion").val(response.descripcion);
            $("#emp_id").val(response.id);
          }
        });
      });
    </script>

</body>
</html>
