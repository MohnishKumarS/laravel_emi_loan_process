<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="{{url('/home')}}">
        <img src="{{asset('assets/img/emi-logo.png')}}" alt="emi-logo" width="50">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('loan-details') ? 'active' : ''}}" href="{{url('loan-details')}}">LoanDetails</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('process-data') ? 'active' : ''}}" href="{{url('process-data')}}"> ProcessData</a>
          </li>
        </ul>
    
      </div>
    </div>
  </nav>
</header>

<style>
  .nav-link.active{
    color: #f0498c !important;
    font-weight: 600;
    letter-spacing: 1px
  }
  .nav-link:hover{
    color: #f0498c !important;

  }
</style>