<html>
 <head>
  <title>
   Thêm người dùng
  </title>
  <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
  <style>
   body {
            display: flex;
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            padding: 15px;
            height: 100vh;
            position: fixed;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
        }
        .sidebar a:hover {
            color: white;
        }
        .sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .sidebar .nav-link {
            padding: 0.5rem 0;
            font-size: 1rem;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }
        .breadcrumb {
            background-color: #e9ecef;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 0.25rem;
        }
        .breadcrumb a {
            text-decoration: none;
            color: #007bff;
        }
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }
        .form-label {
            font-weight: 500;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
  </style>
 </head>
 <body>
  {{-- <div class="sidebar">
   <div class="text-center mb-4">
    <img alt="User Avatar" class="rounded-circle" height="50" src="https://placehold.co/50x50" width="50"/>
    <p>
     <a href="#" class="text-white">Đăng Xuất</a>
    </p>
    <p>
     Welcome, William Anderson
    </p>
    <a href="#">
     Back to home
    </a>
   </div>
   <h2>
    Admin
   </h2>
   <ul class="nav flex-column">
    <li class="nav-item">
     <a class="nav-link" href="#">
      Thống kê
     </a>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="#">
      Danh sách cài đặt
     </a>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="#">
      Danh sách người dùng
     </a>
    </li>
   </ul>
  </div> --}}
  <div class="content">
   <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
     <li class="breadcrumb-item">
      <a href="#">
       Danh sách người dùng
      </a>
     </li>
     <li aria-current="page" class="breadcrumb-item active">
      Thêm người dùng
     </li>
    </ol>
   </nav>
   <h2>
    Thêm người dùng
   </h2>
   <form action="/users" method="post">
    @csrf
    <div class="row mb-3">
     <div class="col">
      <label class="form-label" for="username">
       Tên người dùng
      </label>
      <input class="form-control" name="fullname" type="text"/>
     </div>
     <div class="col">
        <label class="form-label" for="username">
         So dien thoai
        </label>
        <input class="form-control" name="phone" type="text"/>
       </div>
     <div class="col">
      <label class="form-label" for="gender">
       Giới tính
      </label>
      <select class="form-select" id="gender">
       <option selected="">
        Nam
       </option>
       <option>
        Nữ
       </option>
      </select>
     </div>
    </div>
    <div class="row mb-3">
     <div class="col">
      <label class="form-label" for="email">
       Dia chi
      </label>
      <input class="form-control" name="adress" type="text"/>
     </div>
     <div class="col">
        <label class="form-label" for="email">
         ngay sinh
        </label>
        <input class="form-control" name="dob" type="text"/>
       </div>
     <div class="col">
      <label class="form-label" for="status">
       Trạng thái
      </label>
      <select class="form-select" id="status">
       <option selected="">
        Khả dụng
       </option>
       <option>
        Không khả dụng
       </option>
      </select>
     </div>
    </div>
    <div class="row mb-3">
     <div class="col">
        <div class="col">
            <label class="form-label" for="phone">
             Department
            </label>
            <input class="form-control" name="department_id" type="text"/>
           </div>
      <label class="form-label" for="phone">
       Username
      </label>
      <input class="form-control" name="username" type="text"/>
     </div>
     <div class="col">
      <label class="form-label" for="password">
       Mật Khẩu
      </label>
      <input class="form-control" name="password" type="password"/>
     </div>
    </div>
    <div class="row mb-3">
     <div class="col">
      <label class="form-label" for="role">
       Vai trò
      </label>
      <select class="form-select" id="role">
       <option selected="">
        user
       </option>
       <option>
        admin
       </option>
      </select>
     </div>
    </div>
    <button class="btn btn-primary" type="submit">
     Thêm người dùng
    </button>
    <button class="btn btn-secondary" type="reset">
     Hủy bỏ
    </button>
   </form>
  </div>
 </body>
</html>