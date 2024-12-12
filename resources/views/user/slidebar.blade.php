<!DOCTYPE html>
<html lang="en">
<head>
    {{-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Layout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet"> --}}
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500');
        body {
  overflow-x: hidden;
  font-family: 'Roboto', sans-serif;
  font-size: 16px;
}

/* Toggle Styles */

#viewport {
  padding-left: 250px;
  -webkit-transition: all 0.5s ease;
  -moz-transition: all 0.5s ease;
  -o-transition: all 0.5s ease;
  transition: all 0.5s ease;
}

#content {
  width: 100%;
  position: relative;
  margin-right: 0;
}

/* Sidebar Styles */

#sidebar {
  z-index: 1000;
  position: fixed;
  left: 250px;
  width: 250px;
  height: 100%;
  margin-left: -250px;
  overflow-y: auto;
  background: #37474F;
  -webkit-transition: all 0.5s ease;
  -moz-transition: all 0.5s ease;
  -o-transition: all 0.5s ease;
  transition: all 0.5s ease;
}

#sidebar header {
  background-color: #263238;
  font-size: 20px;
  line-height: 52px;
  text-align: center;
}

#sidebar header a {
  color: #fff;
  display: block;
  text-decoration: none;
}

#sidebar header a:hover {
  color: #fff;
}

#sidebar .nav{
  
}

#sidebar .nav a{
  background: none;
  border-bottom: 1px solid #455A64;
  color: #CFD8DC;
  font-size: 14px;
  padding: 16px 24px;
}

#sidebar .nav a:hover{
  background: none;
  color: #ECEFF1;
}

#sidebar .nav a i{
  margin-right: 16px;
}
    </style>
</head>
<body>
    <div id="viewport">
        <!-- Sidebar -->
        <div id="sidebar">
          <header>
            <a href="#">My App</a>
          </header>
          <ul class="nav">
            <li>
                <a class="nav-link" href="{{ route('attendance') }}">
                <i class="zmdi zmdi-view-dashboard"></i> Báo cáo chấm công
              </a>
            </li>
            <li>
                {{-- <a class="nav-link" href="{{ route('attendance.monthlyReport') }}">
                <i class="zmdi zmdi-link"></i> Quản lý chấm công --}}
              </a>
            </li>
            
            <li>
              <a href="{{ route('leave_requests.index') }}">
                <i class="zmdi zmdi-widgets"></i> Quản lí các đơn
                xin
                nghỉ
              </a>
            </li>
            {{-- <li>
              <a href="{{ route('salary') }}">
                <i class="zmdi zmdi-link"></i> Quản lý bậc lương
              </a>
            </li> --}}
          </ul>
        </div>
        <!-- Content -->
        {{-- <div id="content">
          <nav class="navbar navbar-default">
            <div class="container-fluid">
              <ul class="nav navbar-nav navbar-right">
                <li>
                  <a href="#"><i class="zmdi zmdi-notifications text-danger"></i></a>
                </li>
                <li><a href="#">Test User</a></li>
              </ul>
            </div>
          </nav>
          <div class="container-fluid">
            <h1>Simple Sidebar</h1>
            <p>
              Make sure to keep all page content within the 
              <code>#content</code>.
            </p>
          </div>
        </div> --}}
      </div>
      
      
    

    <!-- Bootstrap JS and Popper.js -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> --}}
</body>
</html>
