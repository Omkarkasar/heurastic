<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 40px;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .btn-primary,
        .btn-danger {
            min-width: 80px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center mb-4">Student Management System</h2>

        <!-- Buttons -->
        <div class="d-flex justify-content-between mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add task
            </button>
            <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
        </div>

        <!-- task Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Enter task Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="SubmitForm" action="{{ route('taskstore') }}" method="POST">
                            @csrf
                            <input type="hidden" id="id" name="id">
                            <div class="mb-3">
                                <label class="form-label">task Name</label>
                                <input type="text" class="form-control" id="taskname" name="taskname" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Student ID:</label>
                                <select class="form-control" id="studentid" name="studentid">
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Teacher ID:</label>
                                <select class="form-control" id="teacherid" name="teacherid">
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->teacherid }}">{{ $teacher->teachername }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Title :</label>
                                <input type="text" class="form-control" id="tasktitle" name="tasktitle" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">task Description</label>
                                <input type="text" class="form-control" id="taskdescription" name="taskdescription"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Due Date :</label>
                                <input type="date" class="form-control" id="taskduedate" name="taskduedate" required>
                            </div>
                            <div class="mb-3">
                                <select class="form-control" id="taskstatus" name="taskstatus">
                                    <option value="Pending">Pending</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- task Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white" id="datatable">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Teacher ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Timestamp</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be appended by jQuery -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            // Submit Form (Add or Update course)
            $('#SubmitForm').on('submit', function (e) {
                e.preventDefault();
                var id = $('#id').val();
                var formData = new FormData(this);
                var url = id ? `taskupdate/${id}` : "{{ route('taskstore') }}";

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
                        fetchcourses();
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });



        });
    </script>

</body>

</html>