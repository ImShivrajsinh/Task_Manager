@extends('layouts')

@section('title', 'dashboard')

@section('content')

    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-end">
                
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addNewTaskModal">Add Task</button>
             </div>
    </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Task Name</th>
                                <th>Task Description</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $id => $task)
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td>{{ $task->taskname }}</td>
                                    <td>{{ $task->taskdescription }}</td>
                                    <td>{{ $task->duedate }}</td>
                                    <td>{{ $task->status }}</td> {{-- Replace with actual status --}}
                                    <td>
                                        <button type="button" class="btn btn-primary  btn-sm edit-task-btn" value ="{{ $task->id }}">Edit</button>
                                        <a href="{{route('deleteTask', $task->id)}}" class="btn  btn-sm btn-danger">Delete</a>
                                        <a href="{{route('markcompleted', $task->id)}}" class="btn btn-sm btn-success">MarkCompleted</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection