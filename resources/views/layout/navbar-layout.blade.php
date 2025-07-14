<!DOCTYPE html>
<html lang="en">
  <head>
  	<title>Equity Management System Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      #sidebar li a {
          color: #ffffff;
          text-decoration: none !important;
          padding: 10px 15px;
          display: block;
          border-radius: 6px;
      }

      #sidebar li a:hover {
          background-color: #1d5edc;
      }

        .top-header {
            width: 100%;
            padding: 14px 0;
            background: linear-gradient(90deg, #2f89fc, #1d5edc);
            color: #ffffff;
            font-size: 26px;
            font-weight: 600;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 999;
            transition: all 0.3s ease;
        }

        .top-header span {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            padding: 6px 20px;
            border-radius: 8px;
        }

        .wrapper {
            padding-top: 66px;
        }

        /* #sidebar {
            margin-top: 0px;
        } */
        #sidebar.collapsed {
          width: 80px;
        }

        #sidebar {
          width: 250px;
        }


        #sidebarCollapse {
          position: fixed;
          top: 76px;
          left: 250px; 
          z-index: 1001;
          transition: left 0.3s ease;
        }


        @media (max-width: 768px) {
            .top-header {
                font-size: 20px;
                padding: 14px 0;
            }

            .top-header span {
                padding: 5px 15px;
            }
        }
    </style>

  </head>
  <body>
		<div class="top-header">
        Equity Management System
    </div>
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
	  		<h1><a href="dashboard" class="logo" style="text-decoration: none !important;">@php
                  $roleTitle = match(Auth::user()->is_admin) {
                      1 => 'Admin Dashboard',
                      0 => 'Manager Dashboard',
                      2 => 'Analyst Dashboard',
                      3 => 'Client Dashboard',
                      default => 'Dashboard',
                  };
              @endphp

              {{ $roleTitle }}
        </a></h1>
              <ul class="list-unstyled components mb-5">
        @if(auth()->check() && auth()->user()->is_admin == 1)
          <li class="active">
            <a href="/admin/clientlist"><span class="fa fa-book mr-3"></span> Client List</a>
          </li>
          <li class="active">
            <a href="/admin/client/holdings"><span class="fa fa-tasks mr-3"></span> Client Holdings</a>
          </li>

          <li class="active">
            <a href="/admin/client/holdings/create"><span class="fa fa-plus-square mr-3"></span> Create Holdings</a>
          </li>
          
          <li class="active">
            <a href="/admin/upload-holdings"><span class="fa fa-upload mr-3"></span> Bulk Stock</a>
          </li>

          <li class="active">
            <a href="/reports/equity-summary"><span class="fa fa-plus-square mr-3"></span> Equity Report</a>
          </li>
        @endif
        
            <li class="active">
                <a href="/default/stock/dashboard"><span class="fa fa-question-circle mr-3"></span> All Stack</a>
            </li>
        

          

          <li>
            <a href="/logout"><span class="fa fa-sign-out mr-3"></span> Log Out</a>
          </li>
        </ul>

    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        @yield('space-work')
      </div>
		</div>

    
   <!-- <script src="{{asset('jquery-3.6.4.min.js')}}"></script>  -->
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
  </body>
  <script>
    $(document).ready(function () {
      $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('collapsed');

        if ($('#sidebar').hasClass('collapsed')) {
          $('#sidebarCollapse').css('left', '80px'); 
        } else {
          $('#sidebarCollapse').css('left', '250px'); 
        }
      });
    });
  </script>

</html>

