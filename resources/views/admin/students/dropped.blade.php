<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropped Students - Admin Dashboard</title>
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
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-info {
            background: #17a2b8;
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

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .action-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
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
            <a href="{{ route('admin.students.dropped') }}" class="menu-item active">
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
            <a href="{{ route('admin.reports.index') }}" class="menu-item">
                <i class="fas fa-file-alt"></i>
                <span>Reports</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="action-bar">
                <a href="{{ route('admin.students.index') }}" class="btn btn-info">
                    <i class="fas fa-arrow-left"></i> Back to Active Students
                </a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-user-slash"></i> Dropped Students</h3>
                </div>

                <div class="table-container">
                     <table>
                        <thead>
                             <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Former Class</th>
                                <th>Drop Date</th>
                                <th>Reason</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($droppedStudents as $student)
                            <tr>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->last_name }}, {{ $student->first_name }}</td>
                                <td>{{ $student->class->class_name ?? 'N/A' }} - {{ $student->class->section ?? '' }}</td>
                                <td>{{ $student->drop_date ? $student->drop_date->format('M d, Y') : 'N/A' }}</td>
                                <td><span class="badge badge-danger">{{ $student->drop_reason ?? 'Not specified' }}</span></td>
                                <td>
                                    <a href="{{ route('admin.students.show', $student) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <form action="{{ route('admin.students.restore', $student) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Restore this student?')">
                                            <i class="fas fa-undo"></i> Restore
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 40px;">
                                    <i class="fas fa-user-slash" style="font-size: 48px; color: #ccc; margin-bottom: 20px; display: block;"></i>
                                    No dropped students found.
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