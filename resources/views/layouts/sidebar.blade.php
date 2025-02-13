<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="index.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <!-- students -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1"
                    aria-expanded="false" aria-controls="collapseLayouts1">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Students
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('studentform') }}">Add Students</a>
                    </nav>
                </div>
                <!-- Courses -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2"
                    aria-expanded="false" aria-controls="collapseLayouts2">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Courses
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('courseform') }}">Add Courses</a>
                    </nav>
                </div>

                  <!-- Enrollment -->
                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3"
                    aria-expanded="false" aria-controls="collapseLayouts3">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Enrollments
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('enrollmentform') }}">Add Enrollments</a>
                    </nav>
                </div>
                 <!--Tecaher -->
                 <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts4"
                    aria-expanded="false" aria-controls="collapseLayouts4">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Teacher
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('teacherform') }}">Add Teacher</a>
                    </nav>
                </div>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>