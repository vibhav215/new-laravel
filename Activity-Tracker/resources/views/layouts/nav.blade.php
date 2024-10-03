
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="{{asset('assets/images/ActivityTracker.jpg')}}" alt="Activity Tracker Logo" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{url('/')}}">Home</a></li>

                @if(!session()->has('userdata'))
            <li class="nav-item"><a  class="nav-link" href="{{url('register')}}">Register</a></li>
                @endif
                @if(!session()->has('userdata'))
            <li class="nav-item"><a  class="nav-link" href="{{url('login')}}">Login</a></li>
        @else
            <li class="nav-item"><a  class="nav-link" href="{{url('user/logout')}}">Logout</a></li>
        @endif

        <li class="nav-item"><a  class="nav-link" href="{{url('about')}}">About Software</a></li>
        <li class="nav-item"><a  class="nav-link" href="{{url('license')}}">License</a></li>
        <li class="nav-item"><a class="nav-link" href="{{url('contact')}}">Contact</a></li>
            </ul>
        </div>
    </nav>
