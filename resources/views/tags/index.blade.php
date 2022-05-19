<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application with image Laravel 8 and ajax </title>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body>
{{-- add new employee modal start --}}
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Tag</h5>
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
              <label for="descripcion">descripcion</label>
              <input type="text" name="descripcion" class="form-control" placeholder="Descripcion" required>
            </div>
          </div>
          <div class="my-2">
            <label for="operacion">operacion</label>
            <input type="text" name="operacion" class="form-control" placeholder="Operacion" required>
          </div>
          <div class="my-2">
            <label for="ubicacion">ubicacion</label>
            <input type="text" name="ubicacion" class="form-control" placeholder="ubicacion" required>
          </div>
          <div class="my-2">
            <label for="ct">CT</label>
            <input type="text" name="ct" class="form-control" placeholder="CT" required>
          </div>
          <div class="my-2">
            <label for="planta">Planta</label>
            <input type="text" name="planta" class="form-control" placeholder="Planta" required>
          </div>
          <div class="my-2">
            <label for="area">Area</label>
            <input type="text" name="area" class="form-control" placeholder="Area" required>
          </div>

         <div class="my-2">
            <label for="foto">Select Foto</label>
            <input type="file" name="foto" class="form-control" required>
          </div>

          <div class="grid grid-cols-1 mt-5 mx-7">
            <img id="imagenSeleccionada" style="max-height: 300px;">
        </div>

        <div class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Subir Imagen</label>
            <div class='flex items-center justify-center w-full'>
                <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                    <div class='flex flex-col items-center justify-center pt-7'>

                    <p class='text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Seleccione la imagen</p>
                    </div>
                    <!-- class hidden es para que no aparesca la leyenda de seleccione el archivo -->
               <input name="foto" id="foto" type='file'   />
                </label>
            </div>
        </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_employee_btn" class="btn btn-primary">Add Tag</button>
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
        <input type="hidden" name="emp_foto" id="emp_foto">
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
          <div class="my-2">
            <label for="operacion">Operacion</label>
            <input type="text" name="operacion" id="operacion" class="form-control" placeholder="Operacion" required>
          </div>
          <div class="my-2">
            <label for="ubicacion">Ubicacion</label>
            <input type="text" name="ubicacion" id="ubicacion" class="form-control" placeholder="Ubicacion" required>
          </div>
          <div class="my-2">
            <label for="ct">CT</label>
            <input type="text" name="ct" id="ct" class="form-control" placeholder="CT" required>
          </div>
          <div class="my-2">
            <label for="planta">Planta</label>
            <input type="text" name="planta" id="planta" class="form-control" placeholder="Planta" required>
          </div>
          <div class="my-2">
            <label for="area">Area</label>
            <input type="text" name="area" id="area" class="form-control" placeholder="Area" required>
          </div>
         <div class="my-2">
            <label for="foto">Select foto</label>
            <input type="file" name="foto" class="form-control">
          </div>
          <div class="mt-2" id="foto">

          </div>
          <div class="grid grid-cols-1 mt-5 mx-7">

              <img src="{{asset('storage/images/planta/') }}"."foto"  width="30%" id="imagenSeleccionada">
          </div>

          <div class="grid grid-cols-1 mt-5 mx-7">
          <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Subir Imagen</label>
              <div class='flex items-center justify-center w-full'>
                  <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                      <div class='flex flex-col items-center justify-center pt-7'>
                   <!--   <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>-->
                      <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Seleccione la imagen</p>
                      </div>
                  <input name="foto" id="foto" type='file' class="hidden" />

                  </label>
              </div>
          </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_employee_btn" class="btn btn-success">Update Tag</button>
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
            <h3 class="text-light">Manage Tags</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i
                class="bi-plus-circle me-2"></i>Add New Tag</button>
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

<!--Se agrgo del codigo de otro programa-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap5.min.js"></script>

    <script>
     //codigo para que se vea la imagen previa
    $(document).ready(function (e) {
        $('#foto').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionada').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);  /* para ver la vista previa */
        });
    });




       //getch all employees ajax request
       fetchAllEmployees();

function fetchAllEmployees() {
      $.ajax({
    url: '{{ route('fetchAll.tags') }}',
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
              url: '{{ route('delete.tags') }}',
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
          url: '{{ route('update.tags') }}',
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
          url: '{{ route('edit.tags') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#tag").val(response.tag);
            $("#descripcion").val(response.descripcion);
            $("#operacion").val(response.operacion);
            $("#ubicacion").val(response.ubicacion);
            $("#ct").val(response.ct);
            $("#planta").val(response.planta);
            $("#area").val(response.area);
            $("#foto").html(
              `<img src="storage/images/planta/${response.foto}" width="80%" class="img-fluid img-thumbnail">`);

            $("#emp_id").val(response.id);
            $("#emp_foto").val(response.foto);
          }
        });
      });





    // add new employee ajax request
      $("#add_employee_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_employee_btn").text('Adding...');
        $.ajax({
          url: '{{ route('store.tags') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          success: function(res) {
            if (res.status == 200) {
              Swal.fire(
                'Added!',
                'Employee Added Successfully!',
                'success'
              )
              fetchAllEmployees();
            }
            $("#add_employee_btn").text('Add Tag');
            $("#add_employee_form")[0].reset();
            $("#addEmployeeModal").modal('hide');
          }
        });
    });
    </script>
</body>
</html>
