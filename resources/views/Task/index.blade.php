<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Task List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-primary"> Task List</h2>
                <a href="{{ route('tasks.create') }}" class="btn btn-success">+ Add Task</a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Assigned To</th>
                                <th scope="col">Assigned By</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                                <tr>
                                    <td class="text-muted">{{ $loop->iteration }}</td>
                                    <td class="fw-semibold text-info">{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ optional($task->assignedTo)->name ?? '—' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ optional($task->assignedBy)->name ?? '—' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning me-1"> Edit</a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger"> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No tasks available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</div>
</body>
</html>
