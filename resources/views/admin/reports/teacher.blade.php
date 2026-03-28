<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Performance Report - Admin Dashboard</title>
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
            max-width: 1400px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 25px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .card-header h3 {
            color: #333;
            font-size: 18px;
            font-weight: 600;
        }

        .card-header h3 i {
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

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
            color: #666;
            font-size: 13px;
        }

        tr:hover td {
            background: #f8f9ff;
        }

        .badge {
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-info {
            background: #d1ecf1;
            color: #0c5460;
        }

        .progress {
            height: 6px;
            background: #e0e0e0;
            border-radius: 3px;
            overflow: hidden;
            width: 100px;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 3px;
        }

        .action-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .stat-card h4 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 28px;
            font-weight: bold;
            color: #667eea;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .alert-success {
            background: #d4edda;
            border-left: 4px solid #28a745;
            color: #155724;
        }

        .alert i {
            margin-right: 10px;
            font-size: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .main-content {
                margin-left: 0;
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
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.teachers.index') }}" class="menu-item">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Teachers</span>
            </a>
            <a href="{{ route('admin.students.index') }}" class="menu-item">
                <i class="fas fa-users"></i>
                <span>Students</span>
            </a>
            <a href="{{ route('admin.students.dropped') }}" class="menu-item">
                <i class="fas fa-user-slash"></i>
                <span>Dropped Students</span>
            </a>
            <a href="{{ route('admin.subjects.index') }}" class="menu-item">
                <i class="fas fa-book"></i>
                <span>Subjects</span>
            </a>
            <a href="{{ route('admin.classes.index') }}" class="menu-item">
                <i class="fas fa-school"></i>
                <span>Classes</span>
            </a>
            <a href="{{ route('admin.reports.index') }}" class="menu-item active">
                <i class="fas fa-file-alt"></i>
                <span>Reports</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-wrapper">
            <!-- Action Bar -->
            <div class="action-bar">
                <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Reports
                </a>
            </div>

            <!-- Statistics -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h4>Total Teachers</h4>
                    <div class="number">{{ $teachers->count() }}</div>
                </div>
                <div class="stat-card">
                    <h4>Total Classes</h4>
                    <div class="number">{{ $teachers->sum(function($t) { return $t->classes->count(); }) }}</div>
                </div>
                <div class="stat-card">
                    <h4>Total Students</h4>
                    <div class="number">{{ $teachers->sum(function($t) { 
                        return $t->classes->sum(function($c) { return $c->students->count(); }); 
                    }) }}</div>
                </div>
            </div>

            <!-- Teacher Performance Table -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-chalkboard-teacher"></i> Teacher Performance Report</h3>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Teacher Name</th>
                                <th>Department</th>
                                <th>Classes</th>
                                <th>Students</th>
                                <th>Average Grade</th>
                                <th>Passing Rate</th>
                                <th>Performance</th>
                            </thead>
                        <tbody>
                            @forelse($teachers as $teacher)
                                <tr>
                                    <td>
                                        <strong>{{ $teacher->user->name }}</strong>
                                        <br>
                                        <small style="color: #999;">{{ $teacher->employee_id }}</small>
                                    </td>
                                    <td>{{ $teacher->department }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $teacher->total_classes }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $teacher->total_students }}</span>
                                    </td>
                                    <td>
                                        @if($teacher->average_grade > 0)
                                            <strong>{{ number_format($teacher->average_grade, 1) }}</strong>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: {{ $teacher->average_grade }}%"></div>
                                            </div>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($teacher->passing_rate > 0)
                                            <strong>{{ number_format($teacher->passing_rate, 1) }}%</strong>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: {{ $teacher->passing_rate }}%; background: #28a745;"></div>
                                            </div>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($teacher->average_grade >= 90)
                                            <span class="badge badge-success">Excellent</span>
                                        @elseif($teacher->average_grade >= 80)
                                            <span class="badge badge-success">Very Good</span>
                                        @elseif($teacher->average_grade >= 75)
                                            <span class="badge badge-success">Good</span>
                                        @elseif($teacher->average_grade > 0)
                                            <span class="badge badge-warning">Needs Improvement</span>
                                        @else
                                            <span class="badge badge-warning">No Data</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center; padding: 40px;">
                                        <i class="fas fa-chalkboard-teacher" style="font-size: 48px; color: #ccc; margin-bottom: 20px; display: block;"></i>
                                        No teacher data available.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>