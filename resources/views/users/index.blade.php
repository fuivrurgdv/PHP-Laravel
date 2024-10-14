<html>
 <head>
  <title>
   Danh sách người dùng
  </title>
  <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   body {
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            padding: 15px;
            height: 100vh;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            text-decoration: underline;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-create {
            font-size: 14px;
            padding: 5px 10px;
        }
  </style>
 </head>
 <body>
  <!-- <div class="sidebar">
   <div class="text-center mb-4">
    <img alt="User Avatar" class="rounded-circle" height="50" src="https://storage.googleapis.com/a1aa/image/IkQffAuUQXngHUBAy0EAxWjpWWt6T4ravemq9xQmjLAA8mMnA.jpg" width="50"/>
    <p>
     Welcome, William Anderson
    </p>
    <a href="#">
     Đăng Xuất
    </a>
   </div>
   <div class="mb-4">
    <a href="#">
     Back to home
    </a>
   </div>
   <h4>
    Admin
   </h4>
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
  </div> -->
  <div class="content">
   <h2>
    Danh sách người dùng
   </h2>
   <div class="d-flex justify-content-between mb-3">
    <button class="btn btn-primary btn-create" onclick="navigateToPage()" style="padding: 5px 10px; font-size: 14px;">
     <i class="fas fa-user-plus">
     </i>
     Thêm mới người dùng
    </button>
    <div>
     <label class="form-label" for="search">
      Tìm kiếm:
     </label>
     <input class="form-control" id="search" placeholder="Tên người dùng, email..." type="text"/>
     <button class="btn btn-primary btn-create mt-2">
      Tìm kiếm
     </button>
    </div>
   </div>
   <div class="mb-3">
    <label class="form-label" for="filter">
     Lọc người dùng:
    </label>
    <select class="form-select mb-2" id="filter">
     <option>
      Chọn theo...
     </option>
    </select>
    <select class="form-select">
     <option>
      Lựa chọn
     </option>
    </select>
   </div>
   <table class="table table-bordered">
    <thead>
     <tr>
      <th>
       ID
      </th>
      <th>
        department ID
       </th>
      <th>
       Họ và tên
      </th>
      <th>
        Số điện thoại
      </th>
      <th>
       Dia chi
      </th>
      <th>
       ngay sinh
      </th>
      <th>
       Username
      </th>
      <th>
       Password
      </th>
      <th>
       Chức năng
      </th>
     </tr>
    </thead>
    <tbody>
     <tr>
    @foreach ($user as $item)
        
    
      <td>
       {{ $item->id }}
      </td>
      <td>
        {{ $item->department_id }}
      </td>
      <td>
        {{ $item->fullname }}
      </td>
      <td>
        {{ $item->phone }}
      </td>
      <td>
        {{ $item->address }}
      </td>
      
      <td>
       {{ $item->dob }}
      </td>
      <td>
        {{ $item->username }}
      </td>
      <td>
        {{ $item->password }}
      </td>
      <td>
        <a href="">
       <i class="fas fa-eye">
       </i>
      </a>
        <a href="users/{{ $item->id }}/edit">
        <i class="fas fa-edit"></i>
      </a>
       
      </td>
     </tr>
     @endforeach
    </tbody>
   </table>
   <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
     <li class="page-item">
      <a class="page-link" href="#">
       Previous
      </a>
     </li>
     <li class="page-item">
      <a class="page-link" href="#">
       1
      </a>
     </li>
     <li class="page-item">
      <a class="page-link" href="#">
       2
      </a>
     </li>
     <li class="page-item">
      <a class="page-link" href="#">
       3
      </a>
     </li>
     <li class="page-item">
      <a class="page-link" href="#">
       4
      </a>
     </li>
     <li class="page-item">
      <a class="page-link" href="#">
       Next
      </a>
     </li>
    </ul>
   </nav>
  </div>
 </body>
 <script>
    function navigateToPage() {
        window.location.href = 'users/create'; // Thay 'your-target-page.html' bằng địa chỉ trang bạn muốn điều hướng đến
    }
</script>
</html>
