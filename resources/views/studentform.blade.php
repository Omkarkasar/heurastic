<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <!-- crsf token meta tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- bootstrap css and js cdnnnnnnn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <title>Student Management System</title>
</head>

<body>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
        data-bs-whatever="@mdo">Add Student</button>
        <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Enter Student Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="SubmitForm" action="{{route('studentstore')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <!-- hiddem id i haave passed -->
                            <input type="hidden" id="id" name="id">
                            <label for="name" class="col-form-label">Student Name :</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="col-form-label">Date of Birth :</label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="col-form-label">Phone :</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="col-form-label">Address :</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Date Of Birth</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Jquery Will add heree tbody -->
        </tbody>
    </table>



    <script>
        $(document).ready(function () {
            // fetchrecord();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#SubmitForm').on('submit', function (e) {
                e.preventDefault();
                var id = $('#id').val();
                var formData = new FormData(this);
                var url = id ? `studentupdate/${id}` : "{{ route('studentstore') }}";

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#SubmitForm')[0].reset();
                        $('#exampleModal').modal('hide');
                        alert(response.success);
                        fetchrecord();
                    },
                    error: function (e) {
                        console.log(e);
                    }
                })

            })
            function fetchrecord() {
                $.ajax({
                    url: `studentget`,
                    type: "GET",
                    success: function (response) {
                        var tr = '';
                        for (var i = 0; i < response.length; i++) {
                            var id = response[i].id;
                            var name = response[i].name;
                            var email = response[i].email;
                            var dob = response[i].dob;
                            var phone = response[i].phone;
                            var address = response[i].address;

                            tr += '<tr>';
                            tr += '<td>' + id + '</td>';
                            tr += '<td>' + name + '</td>';
                            tr += '<td>' + email + '</td>';
                            tr += '<td>' + dob + '</td>';
                            tr += '<td>' + phone + '</td>';
                            tr += '<td>' + address + '</td>';
                            tr += `<td><button type="button" class="btn btn-success editBtn" data-id="${id}">Edit</button></td>   <td><button type="button" class="btn btn-danger deleteBtn" data-id="${id}">Delete</button></td>`;
                            tr += '</tr>';
                        }
                        $('#datatable tbody').html(tr);
                    }

                })
            }
            fetchrecord();
            // update ajax
            $(document).on('click', '.editBtn', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: `studentedit/${id}`,
                    type: "GET",
                    success: function (response) {
                        $('#id').val(response.id);
                        $('#name').val(response.name);
                        $('#email').val(response.email);
                        $('#dob').val(response.dob);
                        $('#phone').val(response.phone);
                        $('#address').val(response.address);
                        $('#exampleModal').modal('show');
                        fetchrecord();
                    },
                    error: function (e) {
                        console.log(e);
                    }
                })
            })

            $(document).on('click', '.deleteBtn', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: `studentdelete/${id}`,
                    type: "delete",
                    data: {
                        "_token": "{{csrf_token()}}"
                    },
                    success: function (response) {
                        alert(response.success);
                        fetchrecord();
                    }
                })
            });
        });
    </script>
</body>

</html>