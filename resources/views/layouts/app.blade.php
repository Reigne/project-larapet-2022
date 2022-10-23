<div id="viewport">
  <!-- Sidebar -->
  <div id="sidebar">
    <header>
      <a href="{{ route('home') }}">Acme Clinic</a>
      @if (Auth::check())
      <h5 style="color: white;">{{ Auth::user()->name}}</h5>
      <h5><span class="label label-success">Employee</span></h5>
      <h5>---</h5>
      @else
      <h5><span class="label label-success">Guest</span></h5>
      <h5>---</h5>
      @endif
    </header>
    <ul class="nav">
      <li>
          <a href="{{ route('home') }}">
            <i class="glyphicon glyphicon-home"></i> Home
          </a>
        </li>
        
      @if (Auth::check())
        <li>
          <a href="{{ route('employee.profile') }}">
            <i class="glyphicon glyphicon-cog"></i> Employee Profile
          </a>
        </li>
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
          <a href="{{ route('employee.index') }}">
            <i class="glyphicon glyphicon-user" aria-hidden="true"></i>  Employee
          </a>
        </li>
        <li>
          <a href="{{ route('grooming.index') }}">
            <i class="glyphicon glyphicon-scissors"></i> Pet Grooming
        </a>
        </li>
        <li>
          <a href="{{ route('consultation.index') }}">
            <i class="fas fa-heartbeat"></i> Consulation
        </a>
        </li>
        <li>
          <a href="">
            <i class="fas fa-search"></i> Medical History
        </a>
        </li>
        <li>
          <a href="{{ route('history.history') }}">
            <i class="fas fa-search"></i> Transaction History
        </a>
        </li>
        <li>
          <a href="{{ route('employee.logout') }}">
            <i class="glyphicon glyphicon-log-out"></i> Logout
          </a>
        </li>
      @else
        <li>
          <a href="{{ route('consultation.index') }}">
            <i class="fas fa-heartbeat"></i> Consulation
        </a>
        </li>
        <li>
        <a href="{{ route('shop.index') }}">
          <i class="fas fa-shopping-bag"></i> Pet Shop
        </a>
      </li>
      <li>
        <a href="{{ route('shop.shoppingCart') }}">
          <i class="fas fa-shopping-cart"></i> My Cart
        </a>
      </li>
      <li>
          <a href="{{ route('employee.signin') }}">
            <i class="glyphicon glyphicon-log-in"></i> Signin
        </a>
      </li>
      @endif

    </ul>
  </div>
  <!-- Content -->

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