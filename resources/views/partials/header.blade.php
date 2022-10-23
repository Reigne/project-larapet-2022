<div id="viewport">
  <!-- Sidebar -->
  <div id="sidebar">
    <header>
      <a href="{{ route('home') }}">Larashop</a>
      <h5 style="color: white;">{{-- {{ Auth::user()->name}} --}}</h5>
      <h5><span class="label label-success">Online</span></h5>
      <h5>---</h5>
    </header>
    <ul class="nav">
      <li>
        <a href="{{ route('customer.index') }}">
          <i class="glyphicon glyphicon-user"></i> Customers
        </a>
      </li>
      <li>
        <a href="{{ route('pet.index') }}">
          <i class="glyphicon glyphicon-book"></i> Pets
        </a>
      </li>
      <li>
        <a href="#">
          <i class="glyphicon glyphicon-user" aria-hidden="true"></i>  Employee
        </a>
      </li>
      <li>
        <a href="#">
          <i class="glyphicon glyphicon-scissors"></i> Pet Grooming
      </li>
      
      {{-- <li>
        <a href="#">
          <i class="zmdi zmdi-info-outline"></i> About
        </a>
      </li>
      <li>
        <a href="#">
          <i class="zmdi zmdi-settings"></i> Services
        </a>
      </li>
      <li>
        <a href="#">
          <i class="zmdi zmdi-comment-more"></i> Contact
        </a>
      </li> --}}
    </ul>
  </div>
  <!-- Content -->
  <div id="content">
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
    </div>
     <!-- Collect the nav links, forms, and other content for toggling -->
  </div><!-- /.container-fluid -->
</nav> 
    </nav>
{{--     <div class="container-fluid">
      <h1>Simple Sidebar</h1>
      <p>
        Make sure to keep all page content within the 
        <code>#content</code>.
      </p>
    </div> --}}
  </div>
</div>