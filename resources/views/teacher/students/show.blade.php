<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - Teacher Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f0f2f5;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            color: #667eea;
            font-size: 28px;
        }

        .logo span {
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }

        .logo span span {
            color: #667eea;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-name {
            color: #555;
            font-weight: 500;
        }

        .user-name i {
            color: #667eea;
            margin-right: 5px;
        }

        .logout-form {
            margin: 0;
        }

        .logout-btn {
            background: none;
            border: 1px solid #ff4757;
            color: #ff4757;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: #ff4757;
            color: white;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 70px;
            width: 260px;
            height: calc(100vh - 70px);
            background: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            overflow-y: auto;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: #666;
            text-decoration: none;
            transition: all 0.3s;
            margin: 5px 10px;
            border-radius: 8px;
        }

        .menu-item i {
            width: 25px;
            font-size: 18px;
            margin-right: 10px;
        }

        .menu-item:hover {
            background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%);
            color: #667eea;
        }

        .menu-item.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .main-content {
            margin-left: 260px;
            margin-top: 70px;
            padding: 30px;
            min-height: calc(100vh - 70px);
        }

        .content-wrapper {
            max-width: 1000px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 25px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .card-header h2 {
            color: #333;
            font-size: 24px;
            font-weight: 600;
        }

        .card-header h2 i {
            color: #667eea;
            margin-right: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .student-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .info-group {
            margin-bottom: 15px;
        }

        .info-group label {
            display: block;
            color: #999;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .info-group p {
            color: #333;
            font-size: 16px;
            font-weight: 500;
        }

        .info-group .badge {
            display: inline-block;
            padding: 5px 10px;
            background: #667eea20;
            color: #667eea;
            border-radius: 20px;
            font-size: 14px;
        }

        .full-width {
            grid-column: span 2;
        }

        .grades-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .grades-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-size: 14px;
        }

        .grades-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .main-content {
                margin-left: 0;
            }

            .student-info {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: span 1;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
                <span>Student<span>PMS</span></span>
            </div>
            <div class="user-menu">
                <span class="user-name">
                    <i class="far fa-user-circle"></i> 
                    {{ Auth::user()->name }}
                </span>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-menu">
            <a href="{{ route('teacher.dashboard') }}" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('teacher.classes.index') }}" class="menu-item">
                <i class="fas fa-school"></i>
                <span>My Classes</span>
            </a>
            <a href="{{ route('teacher.students.index') }}" class="menu-item active">
                <i class="fas fa-users"></i>
                <span>My Students</span>
            </a>
            <a href="{{ route('teacher.grades.index') }}" class="menu-item">
                <i class="fas fa-chart-line"></i>
                <span>Grades</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-user-graduate"></i> Student Profile</h2>
                    <div>
                        @if($student->class)
                            <a href="{{ route('teacher.grades.class', $student->class) }}" class="btn btn-success">
                                <i class="fas fa-chart-line"></i> View Class Grades
                            </a>
                        @endif
                        <a href="{{ route('teacher.students.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="student-info">
                    <div class="info-group">
                        <label>Student ID</label>
                        <p>{{ $student->student_id }}</p>
                    </div>
                    <div class="info-group">
                        <label>Full Name</label>
                        <p>{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}</p>
                    </div>
                    <div class="info-group">
                        <label>Birth Date</label>
                        <p>{{ $student->birth_date->format('F d, Y') }}</p>
                    </div>
                    <div class="info-group">
                        <label>Gender</label>
                        <p>{{ $student->gender }}</p>
                    </div>
                    <div class="info-group">
                        <label>Class</label>
                        <p>
                            @if($student->class)
                                <span class="badge">{{ $student->class->class_name }} - {{ $student->class->section }}</span>
                            @else
                                Not Assigned
                            @endif
                        </p>
                    </div>
                    <div class="info-group">
                        <label>Contact Number</label>
                        <p>{{ $student->contact_number ?? 'N/A' }}</p>
                    </div>
                    <div class="info-group full-width">
                        <label>Address</label>
                        <p>{{ $student->address }}</p>
                    </div>
                    <div class="info-group">
                        <label>Guardian Name</label>
                        <p>{{ $student->guardian_name }}</p>
                    </div>
                    <div class="info-group">
                        <label>Guardian Contact</label>
                        <p>{{ $student->guardian_contact }}</p>
                    </div>
                </div>
            </div>

            @if($student->grades->isNotEmpty())
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-chart-line"></i> Grade Summary</h3>
                </div>
                <table class="grades-table">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Prelim</th>
                            <th>Midterm</th>
                            <th>Final</th>
                            <th>Average</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student->grades as $grade)
                        <tr>
                            <td>{{ $grade->class->class_name }} - {{ $grade->class->section }}</td>
                            <td>{{ $grade->prelim_grade ?? '—' }}</td>
                            <td>{{ $grade->midterm_grade ?? '—' }}</td>
                            <td>{{ $grade->final_grade ?? '—' }}</td>
                            <td><strong>{{ $grade->average_grade ? number_format($grade->average_grade, 1) : '—' }}</strong></td>
                            <td>
                                @if($grade->remarks)
                                    <span class="badge {{ $grade->remarks == 'Passed' ? 'badge-success' : 'badge-danger' }}">
                                        {{ $grade->remarks }}
                                    </span>
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </main>
</body>
</html>