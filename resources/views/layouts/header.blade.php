<nav class="navbar navbar-expand-md bg-primary shadow fixed-top">
    <div class="container">
        <div class="navbar-brand text-white pe-none">
            <i class="bi bi-pin-angle-fill" style="color: lime"></i>
            برنامه آموزشی دانشگاه
        </div>

        @auth
            <div class="d-none d-md-block badge badge-lg bg-secondary me-4 fw-normal">
                {{ jdate(now())->format('%A %d %B %Y') }}
            </div>
        @endauth

        <button class="navbar-toggler ms-2 ms-sm-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
            <span class="navbar-toggler-icon text-white"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ms-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav my-2 my-md-0 me-auto p-0 text-center">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">ورود</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">عضویت</a>
                        </li>
                    @endif
                @else
                    @php
                        $terms = App\Models\Term::orderBy('number')->get();
                    @endphp

                    <li class="d-none d-md-block nav-item dropdown">
                        <a id="navbarDropdown2" class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            ترم :‌
                            {{ $current_term ?? 'انتخاب نشده' }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-start text-center" aria-labelledby="navbarDropdown2">
                            @foreach ($terms as $term)
                                <a href="{{ route('terms.set-term', ['term' => $term->id]) }}" class="dropdown-item">{{ $term->number }}</a>
                            @endforeach

                            <div>
                                <hr class="dropdown-divider">
                            </div>
                            <a class="dropdown-item" href="{{ route('terms.index') }}">
                                <i class="bi bi-pencil" style="font-size: 0.8rem"></i>
                                عملیات
                            </a>

                            <a class="dropdown-item" href="{{ route('terms.create') }}">
                                <i class="bi bi-plus-lg"></i>
                                جدید
                            </a>
                        </div>
                    </li>
                    <div class="vr text-white mx-2 d-none d-md-block"></div>
                    <li class="nav-item dropdown text-white nav-link">
                        <i class="bi bi-person"></i>
                        نام کاربری : {{ Auth::user()->username }}
                    </li>
                    <div class="vr text-white mx-2 d-none d-md-block"></div>
                    <li class="d-md-none mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white" data-bs-toggle="collapse" data-bs-target="#term-collapse" aria-expanded="false">
                            ترم :
                            {{ $current_term ?? 'انتخاب نشده' }}
                        </button>
                        <div class="collapse" id="term-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                @foreach ($terms as $term)
                                    <li><a href="{{ route('terms.set-term', ['term' => $term->id]) }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2">{{ $term->number }}</a></li>
                                @endforeach

                                <li><a href="{{ route('terms.index') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"></i><i class="bi bi-pencil ms-1" style="font-size: 0.8rem"></i>عملیات</a></li>
                                <li><a href="{{ route('terms.create') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"></i><i class="bi bi-plus-lg"></i>جدید</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="d-md-none mb-1">
                        <a href="{{ route('dashboard') }}" class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white" aria-expanded="false">
                            <i class="bi bi-house ms-1"></i>داشبورد
                        </a>
                    </li>
                    <li class="d-md-none mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white" data-bs-toggle="collapse" data-bs-target="#lessons-collapse" aria-expanded="false">
                            <i class="bi bi-book ms-1"></i>
                            دروس
                        </button>
                        <div class="collapse" id="lessons-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{ route('lessons.index') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>همه</a></li>
                                <li><a href="{{ route('lessons.create') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>ایجاد</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="d-md-none mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white" data-bs-toggle="collapse" data-bs-target="#professors-collapse" aria-expanded="false">
                            <i class="bi bi-people ms-1"></i>
                            اساتید
                        </button>
                        <div class="collapse" id="professors-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{ route('professors.index') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>همه</a></li>
                                <li><a href="{{ route('professors.create') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>افزودن</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="d-md-none mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white" data-bs-toggle="collapse" data-bs-target="#time-periods-collapse" aria-expanded="false">
                            <i class="bi bi-clock ms-1"></i>
                            زمان بندی
                        </button>
                        <div class="collapse" id="time-periods-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{ route('time-periods.index') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>همه</a></li>
                                <li><a href="{{ route('time-periods.create') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>ایجاد</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="d-md-none mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white" data-bs-toggle="collapse" data-bs-target="#eg-collapse" aria-expanded="false">
                            <i class="bi bi-mortarboard ms-1"></i>
                            گروه های آموزشی
                        </button>
                        <div class="collapse" id="eg-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{ route('educational-groups.index') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>همه</a></li>
                                <li><a href="{{ route('educational-groups.create') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>ایجاد</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="d-md-none mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white" data-bs-toggle="collapse" data-bs-target="#entries-collapse" aria-expanded="false">
                            <i class="bi bi-calendar-date ms-1"></i>
                            ورودی ها
                        </button>
                        <div class="collapse" id="entries-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{ route('entries.index') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>همه</a></li>
                                <li><a href="{{ route('entries.create') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>ایجاد</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="d-md-none mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white" data-bs-toggle="collapse" data-bs-target="#class-collapse" aria-expanded="false">
                            <i class="bi bi-easel ms-1"></i>
                            کلاس ها
                        </button>
                        <div class="collapse" id="class-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{ route('classrooms.index') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>جدول کلاس ها</a></li>
                                <li><a href="{{ route('classrooms.create') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>تعریف کلاس</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="d-md-none mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white" data-bs-toggle="collapse" data-bs-target="#location-collapse" aria-expanded="false">
                            <i class="bi bi-pin-map ms-1"></i>
                            مکان کلاس ها
                        </button>
                        <div class="collapse" id="location-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{ route('locations.index') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>همه</a></li>
                                <li><a href="{{ route('locations.create') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>ایجاد</a></li>
                                <li><a href="{{ route('locations.determine') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white text-nowrap my-2"><i class="bi bi-chevron-left"></i>تعیین مکان کلاس ها</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="d-md-none mb-1">
                        <a href="{{ route('schedule.index') }}" class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white" aria-expanded="false">
                            <i class="bi bi-filetype-pdf ms-1"></i>
                            گزارش گیری
                        </a>
                    </li>
                    <li class="d-md-none mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white" data-bs-toggle="collapse" data-bs-target="#p-a-collapse" aria-expanded="false">
                            <i class="bi bi-card-checklist ms-1"></i>
                            حضور غیاب
                        </button>
                        <div class="collapse" id="p-a-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{ route('p-a.index') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>جدول هفتگی</a></li>
                                <li><a href="{{ route('p-a.history') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-chevron-left"></i>گزارش گیری چه</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="d-md-none border-top my-3"></li>
                    <li class="d-md-none mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                            <i class="bi bi-person"></i>حساب
                        </button>
                        <div class="collapse" id="account-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{ route('change-password') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-lock"></i>تغییر رمز عبور</a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); 
                                document.getElementById('logout-form').submit();" class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i class="bi bi-door-open"></i>خروج</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="d-none d-md-block nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-start text-center" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('change-password') }}">
                                تغییر رمز عبور
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                خروج
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
