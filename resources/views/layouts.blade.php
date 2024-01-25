<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</head>
<body>

    <!-- Navbar and content -->
    <nav class="navbar navbar-expand-lg bg-secondary">
      <div class="container">
          <h2 class="text-white">Task Manager</h2>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav ms-auto">
                  @guest
                  <li class="nav-item">
                      <button class="btn btn-link text-white" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                  </li>
                  <li class="nav-item">
                      <button class="btn btn-link text-white" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
                  </li>
                  @else
                  <li class="nav-item">
                      <span class="nav-link text-white">Welcome {{ Auth::user()->name }}</span>
                  </li>
                  <li class="nav-item">
                       <a class="nav-link text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </li>
                  @endguest
              </ul>
          </div>
      </div>
  </nav>

      {{-- Display success message --}}
      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show my-3" role="alert" style="background-color: #d4edda; border-color: #c3e6cb; color: #155724;">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
       @endif
      {{-- Display error message --}}
      @if(session('error'))
      <div class="alert alert-error alert-dismissible fade show my-3" role="alert" style="background-color: #f8d7da; border-color: #f5c6cb; color: #721c24;">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
    @yield('content')
</body>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
          <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="loginModalLabel">Login Here</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="loginForm" action="{{ route('authenticate') }}" method="post">
                  @csrf
                  <div class="mb-3">
                      <label for="email" class="form-label">Email:</label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="Email" name="email" required>
                      @if ($errors->has('email'))
                          <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                      @endif
                  </div>
                  <div class="mb-3">
                      <label for="password" class="form-label">Password:</label>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" id="Password" name="password" required>
                      @if ($errors->has('password'))
                          <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                      @endif
                  </div>
                  <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-success">Log-In</button>
                </div>
              <div class="mb-3 text-center">
                  <p>New User? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">Register here</a></p>
                  {{-- <p>Forgot Password? <a href="{{ route('password.request')}}">Reset here</a></p> --}}
              </div>
            </form>
          </div>
      </div>
  </div>
</div>
<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
          <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="registerModalLabel">Register Yourself</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="registrationForm" action="{{ route('store') }}" method="post">
              @csrf
                  <div class="mb-3 row">
                      <label for="name" class="col-md-4 col-form-label text-md-end">Name:</label>
                      <div class="col-md-8">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                          @if ($errors->has('name'))
                              <span class="text-danger">{{ $errors->first('name') }}</span>
                          @endif
                      </div>
                  </div>
                  <div class="mb-3 row">
                      <label for="email" class="col-md-4 col-form-label text-md-end">Email Address:</label>
                      <div class="col-md-8">
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                          @if ($errors->has('email'))
                              <span class="text-danger">{{ $errors->first('email') }}</span>
                          @endif
                      </div>
                  </div>
                  <div class="mb-3 row">
                      <label for="password" class="col-md-4 col-form-label text-md-end">Password:</label>
                      <div class="col-md-8">
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                          @if ($errors->has('password'))
                              <span class="text-danger">{{ $errors->first('password') }}</span>
                          @endif
                      </div>
                  </div>
                  <div class="mb-3 row">
                      <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Confirm Password:</label>
                      <div class="col-md-8">
                          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                      </div>
                  </div>
                  <div class="mb-3 row">
                      <div class="col-md-8 offset-md-4">
                          <button type="submit" class="btn btn-success">Register</button>
                      </div>
                  </div>
                  <div class="mb-3 row">
                      <p class="text-center text-muted">Registered User? <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Login</a></p>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>



  <!-- Add New Task Modal Start -->
  <div class="modal fade" tabindex="-1" id="addNewTaskModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="add-task-form" action="/addTask" method="post" novalidate>
                @csrf
                <div class="mb-3">
                <input type="text" name="taskname" class="form-control form-control-lg" placeholder="Enter Task Name" required>
                <div class="invalid-feedback">Task name is required!</div>
              </div>

              <div class="mb-3">
                <textarea name="taskdescription" class="form-control form-control-lg" rows="5" placeholder="Enter Task Description" required></textarea>
                <div class="invalid-feedback">Description is required!</div>
              </div>
            

            <div class="mb-3">
              <input type="date" name="duedate" class="form-control form-control-lg" required>
              <div class="invalid-feedback">dueDate is required!</div>
            </div>

            <div class="mb-3">
              <input type="submit" value="Add Task" class="btn btn-primary btn-block btn-lg" id="add-task-btn">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Add New Task Modal End -->

  <!-- Edit Task Modal Start -->
<div class="modal fade" tabindex="-1" id="editTaskModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <form id="edit-task-form" action="{{ url('UpdateTask')}}" method="post" class="p-2" novalidate>
                @csrf
                @method('PUT') 

                <input type="hidden" name="taskId" id="taskId" > 

                  <div class="mb-3">
                      <input type="text" name="taskname" id = "taskname" class="form-control form-control-lg" placeholder="Enter Task Name" required>
                      <div class="invalid-feedback">Task name is required!</div>
                  </div>

                  <div class="mb-3">
                      <textarea name="taskdescription" id = "taskdescription" class="form-control form-control-lg" rows="5" placeholder="Enter Task Description" required></textarea>
                      <div class="invalid-feedback">Description is required!</div>
                  </div>

                  <div class="mb-3">
                      <input type="date" name="duedate" id = "duedate"  class="form-control form-control-lg" required>
                      <div class="invalid-feedback">dueDate is required!</div>
                  </div>

                  <div class="mb-3">
                      <button type="submit" class="btn btn-success btn-block btn-lg">Update Task </button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
<!-- Edit Task Modal End -->