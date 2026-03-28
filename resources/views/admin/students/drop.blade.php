<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drop Student - Admin Dashboard</title>
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
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 30px;
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

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #555;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group label i {
            color: #667eea;
            margin-right: 5px;
        }

        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
        }

        .warning-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            color: #856404;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .student-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .student-info p {
            margin: 5px 0;
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
            <a href="{{ route('admin.students.index') }}" class="menu-item active">
                <i class="fas fa-users"></i>
                <span>Students</span>
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
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-user-slash"></i> Drop Student</h2>
                    <a href="{{ route('admin.students.show', $student) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

                <div class="warning-box">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Warning:</strong> This action will mark the student as dropped. The student will be removed from their class and their records will be archived.
                </div>

                <div class="student-info">
                    <h3>Student Information</h3>
                    <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
                    <p><strong>Name:</strong> {{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}</p>
                    <p><strong>Class:</strong> {{ $student->class->class_name ?? 'Not Assigned' }} - {{ $student->class->section ?? '' }}</p>
                    <p><strong>Current Grades:</strong> 
                        @php
                            $latestGrade = $student->grades->first();
                        @endphp
                        @if($latestGrade && $latestGrade->average_grade)
                            {{ number_format($latestGrade->average_grade, 1) }}%
                        @else
                            No grades recorded
                        @endif
                    </p>
                </div>

                <form action="{{ route('admin.students.drop', $student) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="form-group">
                        <label><i class="fas fa-info-circle"></i> Reason for Dropping</label>
                        <select name="reason" required>
                            <option value="">Select Reason</option>
                            <option value="Transferred to another school">Transferred to another school</option>
                            <option value="Academic reasons">Academic reasons</option>
                            <option value="Financial reasons">Financial reasons</option>
                            <option value="Health reasons">Health reasons</option>
                            <option value="Personal reasons">Personal reasons</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-comment"></i> Additional Remarks (Optional)</label>
                        <textarea name="remarks" rows="4" placeholder="Enter any additional notes about why the student is being dropped..."></textarea>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.students.show', $student) }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to drop this student? This action can be reversed later.')">
                            <i class="fas fa-user-slash"></i> Confirm Drop Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>