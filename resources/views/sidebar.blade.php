<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   .sidebar {
            background-color: #343a40;
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
            width: 250px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar .user-info {
            margin-bottom: 20px;
            text-align: center;
        }
        .sidebar .user-info img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .sidebar .user-info p {
            margin: 0;
        }
        .sidebar h4 {
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 1.2rem;
            color: #adb5bd;
        }
        .sidebar .nav-item {
            margin: 10px 0;
        }
  </style>
  <title>
   Sidebar
  </title>
 </head>
 <body>
  <div class="sidebar">
   <div class="user-info">
    <img alt="User Avatar" height="50" src="https://storage.googleapis.com/a1aa/image/D7aalXRCqb7pKZLnQs2909vl1bLDbivmNf8WHMc1CvohpJzJA.jpg" width="50"/>
    <a class="d-block" href="#">
     <i class="fas fa-sign-out-alt">
     </i>
     Đăng Xuất
    </a>
    <p>
     Welcome, William Anderson
    </p>
   </div>
   <a class="d-block mb-3" href="#">
    <i class="fas fa-home">
    </i>
    Back to home
   </a>
   <h4>
    Admin
   </h4>
   <div class="nav-item">
    <a href="#">
     <i class="fas fa-chart-line">
     </i>
     Thống kê
    </a>
   </div>
   <div class="nav-item">
    <a href="#">
     <i class="fas fa-cogs">
     </i>
     Danh sách cài đặt
    </a>
   </div>
   <div class="nav-item">
    <a href="#">
     <i class="fas fa-users">
     </i>
     Danh sách người dùng
    </a>
   </div>
  </div>
 </body>
</html>
