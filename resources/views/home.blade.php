<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Task Filter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Task List</h2>
        <!-- Add Task Button -->
        <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addTaskModal">Add
            Task</button>

        <div class='d-flex'>
            <!-- Category Dropdown -->
            <div class="mb-3 d-flex align-items-baseline">
                <div class='me-2'>
                    <label for="categoryFilter" class="form-label">Category: </label>
                </div>
                <div>
                    <select class="form-select" id="categoryFilter">
                        <option value="all">All</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Status Dropdown -->
            <div class="mb-3 ms-3 d-flex align-items-baseline">
                <div class='me-2'>
                    <label for="statusFilter" class="form-label">Status: </label>
                </div>
                <div>
                    <select class="form-select" id="statusFilter">
                        <option value="all">All</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="in-progress">In Progress</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Task List -->
        <div class="">
            <!-- Bootstrap Table -->
            <table class="table table-striped table-hover task_table_body">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Task Name</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Task Modal -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id='task_form'>
                        @csrf
                        <div class="mb-3">
                            <label for="taskName" class="form-label">Task Name</label>
                            <input type="text" class="form-control" placeholder='Name' id="taskName"
                                name="task_name">
                        </div>
                        <div class="mb-3">
                            <label for="taskDescription" class="form-label">Task Description</label>
                            <textarea class="form-control" placeholder='Description' id="taskDescription" name="task_description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="taskCategory" class="form-label">Category</label>
                            <select class="form-select" id="taskCategory" name="task_category">
                                <option value="select" selected disabled>Select</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="taskStatus" class="form-label">Status</label>
                            <select class="form-select" id="taskStatus" name="task_status">
                                <option value="select" selected disabled>Select</option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                                <option value="in-progress">In Progress</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Task Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id='task_form'>
                        @csrf
                        <div class="mb-3">
                            <label for="taskName" class="form-label">Task Name</label>
                            <input type="text" class="form-control" placeholder='Name' id="taskName"
                                name="task_name">
                        </div>
                        <div class="mb-3">
                            <label for="taskDescription" class="form-label">Task Description</label>
                            <textarea class="form-control" placeholder='Description' id="taskDescription" name="task_description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="taskCategory" class="form-label">Category</label>
                            <select class="form-select" id="taskCategory" name="task_category">
                                <option value="select" selected disabled>Select</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="taskStatus" class="form-label">Status</label>
                            <select class="form-select" id="taskStatus" name="task_status">
                                <option value="select" selected disabled>Select</option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                                <option value="in-progress">In Progress</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>


    <script>
        $(document).ready(function() {
            $('#task_form').validate({
                rules: {
                    task_name: {
                        required: true
                    },
                    task_description: {
                        required: true,
                        minlength: 5
                    },
                    task_category: {
                        required: true
                    },
                    task_status: {
                        required: true
                    },
                },
                messages: {
                    task_name: {
                        required: "Please enter task name"
                    },
                    task_description: {
                        required: "Please enter task description",
                        minlength: "Task description must be at least 5 characters long"
                    },
                    task_category: {
                        required: "Please select task category"
                    },
                    task_status: {
                        required: "Please select task status"
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('add_task') }}",
                        data: $('#task_form').serialize(),
                        success: function(response) {
                            console.log(response);
                            if (response.status == true) {
                                swal.fire({
                                    title: response.message,
                                    text: "successfully",
                                    icon: "success",
                                });
                                $('#addTaskModal').modal('hide');
                                $('.task_table_body').DataTable().ajax.reload();
                            } else if (response.status == false) {
                                swal.fire({
                                    title: response.message,
                                    text: "Error while adding task",
                                    icon: "error",
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.task_table_body').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: "get",
                    url: "{{ route('home') }}",
                    data: function(d) {
                        d.category_id = $('#categoryFilter').val();
                        d.status = $('#statusFilter').val();
                    }
                },
                columns: [{
                        data: "id",
                        name: "id",
                    },
                    {
                        data: "title",
                        name: "title",
                    },
                    {
                        data: "category_name",
                        name: "category_name",
                    },
                    {
                        data: "description",
                        name: "description",
                    },
                    {
                        data: "Status",
                        name: "Status",
                    },
                    {
                        data: "Actions",
                        name: "Actions",
                    }
                ]
            });

            $(document).on('click', '.delete-button', function() {
                var id = $(this).data('id');
                if (id) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this imaginary file!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('delete') }}",
                                data: {
                                    id: id
                                },
                                success: function(response) {
                                    if (response.status == true) {
                                        Swal.fire({
                                            title: 'Success',
                                            text: response.message,
                                            icon: 'success',
                                        });
                                    } else if (response.status == false) {
                                        Swal.fire({
                                            title: 'Error',
                                            text: response.message,
                                            icon: 'error',
                                        });
                                    }
                                    $('.task_table_body').DataTable().ajax.reload();
                                },
                                error: function(xhr, status, error) {
                                    console.log(error);
                                }
                            });
                        }
                    });
                }
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('change', '#categoryFilter', function() {
                $('.task_table_body').DataTable().ajax.reload();
            });

            $(document).on('change', '#statusFilter', function() {
                $('.task_table_body').DataTable().ajax.reload();
            });
        });
    </script>

</body>

</html>
