<!-- For Admin Navigation start -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{url('/admin/manage-project/')}}" class="nav-link {{request()->segment(2) == 'manage-project' ? 'active' : ''}}">Manage Project</a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/manage-role/')}}" class="nav-link {{request()->segment(2) == 'manage-role' ? 'active' : ''}}">Manage Role</a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/manage-team/')}}" class="nav-link {{request()->segment(2) == 'manage-team' ? 'active' : ''}}">Manage Team</a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/manage-task/')}}" class="nav-link {{request()->segment(2) == 'manage-task' ? 'active' : ''}}">Manage Task</a>
                </li>
            </ul>
        </div>
    </nav>
<!-- For Admin Navigation End-->