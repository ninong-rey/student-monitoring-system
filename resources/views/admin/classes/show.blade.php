<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Details - Admin Dashboard</title>
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
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .main-content.loaded {
            opacity: 1;
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ===== SKELETON LOADER ===== */
        .skeleton-loader {
            position: fixed;
            inset: 0;
            background: #f0f2f5;
            z-index: 9999;
            overflow-y: auto;
            padding: 30px;
            margin-left: 260px;
            margin-top: 70px;
            transition: opacity 0.3s ease;
        }

        .skeleton-loader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .skeleton-card {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Action Bar Skeleton */
        .skeleton-action-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .skeleton-action-btn {
            width: 120px;
            height: 42px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 8px;
        }

        /* Class Info Skeleton */
        .skeleton-class-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
            opacity: 0.7;
        }

        .skeleton-info-title {
            width: 400px;
            height: 32px;
            background: linear-gradient(90deg, rgba(255,255,255,0.2) 25%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0.2) 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .skeleton-info-subtitle {
            width: 300px;
            height: 18px;
            background: linear-gradient(90deg, rgba(255,255,255,0.2) 25%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0.2) 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .skeleton-info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .skeleton-info-item {
            background: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 8px;
        }

        .skeleton-info-label {
            width: 60px;
            height: 12px;
            background: linear-gradient(90deg, rgba(255,255,255,0.2) 25%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0.2) 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .skeleton-info-value {
            width: 120px;
            height: 18px;
            background: linear-gradient(90deg, rgba(255,255,255,0.2) 25%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0.2) 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
        }

        /* Stats Grid Skeleton */
        .skeleton-stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .skeleton-stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .skeleton-stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        .skeleton-stat-info {
            flex: 1;
        }

        .skeleton-stat-label {
            width: 80px;
            height: 14px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .skeleton-stat-value {
            width: 60px;
            height: 24px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
        }

        /* Card Skeleton */
        .skeleton-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .skeleton-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .skeleton-card-title {
            width: 200px;
            height: 22px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
        }

        .skeleton-card-btn {
            width: 140px;
            height: 36px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 8px;
        }

        .skeleton-table {
            width: 100%;
        }

        .skeleton-table-row {
            display: grid;
            grid-template-columns: 1fr 2fr 0.8fr 1.5fr 1fr 0.8fr;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .skeleton-table-cell {
            height: 18px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
        }

        /* Error State */
        .error-state {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 400px;
            display: none;
            z-index: 10000;
        }

        .error-state.show {
            display: block;
        }

        .error-state i {
            font-size: 60px;
            color: #dc3545;
            margin-bottom: 20px;
        }

        .error-state h3 {
            color: #333;
            font-size: 22px;
            margin-bottom: 10px;
        }

        .error-state p {
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .btn-retry {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-retry:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-retry i {
            font-size: 16px;
            margin: 0;
            color: white;
        }

        /* Connection status indicator */
        .connection-status {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            z-index: 10000;
            display: flex;
            align-items: center;
            gap: 8px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .connection-status.connected {
            color: #28a745;
            border-left: 4px solid #28a745;
        }

        .connection-status.disconnected {
            color: #dc3545;
            border-left: 4px solid #dc3545;
        }

        .connection-status i {
            font-size: 14px;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
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

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-warning {
            background: #ffc107;
            color: #333;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .class-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .class-info h2 {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .class-info p {
            opacity: 0.9;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .class-info i {
            margin-right: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .info-item {
            background: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 8px;
        }

        .info-item label {
            display: block;
            font-size: 12px;
            opacity: 0.8;
            margin-bottom: 5px;
        }

        .info-item p {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-size: 24px;
        }

        .stat-info h4 {
            color: #666;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .stat-info p {
            color: #333;
            font-size: 24px;
            font-weight: 700;
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

        .badge-primary {
            background: #667eea20;
            color: #667eea;
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

            .info-grid, .stats-grid {
                grid-template-columns: 1fr;
            }

            .skeleton-loader {
                margin-left: 0;
            }

            .skeleton-table-row {
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .skeleton-info-grid {
                grid-template-columns: 1fr;
            }

            .skeleton-stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Connection Status Indicator -->
    <div class="connection-status" id="connectionStatus">
        <i class="fas fa-wifi"></i>
        <span>Checking connection...</span>
    </div>

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
            <a href="{{ route('admin.subjects.index') }}" class="menu-item">
                <i class="fas fa-book"></i>
                <span>Subjects</span>
            </a>
            <a href="{{ route('admin.classes.index') }}" class="menu-item active">
                <i class="fas fa-school"></i>
                <span>Classes</span>
            </a>
            <a href="{{ route('admin.reports.index') }}" class="menu-item">
                <i class="fas fa-file-alt"></i>
                <span>Reports</span>
            </a>
        </div>
    </div>

    <!-- Skeleton Loader -->
    <div class="skeleton-loader" id="skeletonLoader">
        <div class="skeleton-card">
            <!-- Action Bar Skeleton -->
            <div class="skeleton-action-bar">
                <div class="skeleton-action-btn"></div>
                <div class="skeleton-action-btn"></div>
                <div class="skeleton-action-btn"></div>
                <div class="skeleton-action-btn"></div>
            </div>

            <!-- Class Info Skeleton -->
            <div class="skeleton-class-info">
                <div class="skeleton-info-title"></div>
                <div class="skeleton-info-subtitle"></div>
                
                <div class="skeleton-info-grid">
                    <div class="skeleton-info-item">
                        <div class="skeleton-info-label"></div>
                        <div class="skeleton-info-value"></div>
                    </div>
                    <div class="skeleton-info-item">
                        <div class="skeleton-info-label"></div>
                        <div class="skeleton-info-value"></div>
                    </div>
                    <div class="skeleton-info-item">
                        <div class="skeleton-info-label"></div>
                        <div class="skeleton-info-value"></div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid Skeleton -->
            <div class="skeleton-stats-grid">
                <div class="skeleton-stat-card">
                    <div class="skeleton-stat-icon"></div>
                    <div class="skeleton-stat-info">
                        <div class="skeleton-stat-label"></div>
                        <div class="skeleton-stat-value"></div>
                    </div>
                </div>
                <div class="skeleton-stat-card">
                    <div class="skeleton-stat-icon"></div>
                    <div class="skeleton-stat-info">
                        <div class="skeleton-stat-label"></div>
                        <div class="skeleton-stat-value"></div>
                    </div>
                </div>
                <div class="skeleton-stat-card">
                    <div class="skeleton-stat-icon"></div>
                    <div class="skeleton-stat-info">
                        <div class="skeleton-stat-label"></div>
                        <div class="skeleton-stat-value"></div>
                    </div>
                </div>
            </div>

            <!-- Students Card Skeleton -->
            <div class="skeleton-card">
                <div class="skeleton-card-header">
                    <div class="skeleton-card-title"></div>
                    <div class="skeleton-card-btn"></div>
                </div>
                
                <!-- Table Header -->
                <div class="skeleton-table-row" style="background: #f0f0f0; border-radius: 8px; margin-bottom: 10px;">
                    <div class="skeleton-table-cell"></div>
                    <div class="skeleton-table-cell"></div>
                    <div class="skeleton-table-cell"></div>
                    <div class="skeleton-table-cell"></div>
                    <div class="skeleton-table-cell"></div>
                    <div class="skeleton-table-cell"></div>
                </div>

                <!-- Table Rows -->
                @for($i = 0; $i < 5; $i++)
                    <div class="skeleton-table-row">
                        <div class="skeleton-table-cell"></div>
                        <div class="skeleton-table-cell"></div>
                        <div class="skeleton-table-cell"></div>
                        <div class="skeleton-table-cell"></div>
                        <div class="skeleton-table-cell"></div>
                        <div class="skeleton-table-cell"></div>
                    </div>
                @endfor
            </div>

            <!-- Error State (initially hidden) -->
            <div class="error-state" id="errorState">
                <i class="fas fa-exclamation-circle"></i>
                <h3>Connection Lost</h3>
                <p>Unable to load the page. Please check your internet connection and try again.</p>
                <button class="btn-retry" onclick="retryConnection()">
                    <i class="fas fa-sync-alt"></i> Retry
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Action Bar -->
            <div class="action-bar">
                <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Classes
                </a>
                <a href="{{ route('admin.classes.edit', $class) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Class
                </a>
                <a href="{{ route('admin.classes.assign-form', $class) }}" class="btn btn-success">
                    <i class="fas fa-user-plus"></i> Assign Students
                </a>
                <form action="{{ route('admin.classes.destroy', $class) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this class?')">
                        <i class="fas fa-trash"></i> Delete Class
                    </button>
                </form>
            </div>

            <!-- Class Info -->
            <div class="class-info">
                <h2><i class="fas fa-school"></i> {{ $class->class_name }} - Section {{ $class->section }}</h2>
                <p><i class="fas fa-calendar"></i> Academic Year: {{ $class->academic_year }} | Semester: {{ $class->semester }}</p>
                
                <div class="info-grid">
                    <div class="info-item">
                        <label><i class="fas fa-chalkboard-teacher"></i> Teacher</label>
                        <p>{{ $class->teacher->user->name ?? 'Not Assigned' }}</p>
                    </div>
                    <div class="info-item">
                        <label><i class="fas fa-book"></i> Subject</label>
                        <p>{{ $class->subject->subject_name ?? 'Not Assigned' }} ({{ $class->subject->subject_code ?? '' }})</p>
                    </div>
                    <div class="info-item">
                        <label><i class="fas fa-users"></i> Total Students</label>
                        <p>{{ $class->students->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Enrolled Students</h4>
                        <p>{{ $class->students->count() }}</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-venus-mars"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Male / Female</h4>
                        <p>{{ $class->students->where('gender', 'Male')->count() }} / {{ $class->students->where('gender', 'Female')->count() }}</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-info">
                        <h4>With Grades</h4>
                        <p>{{ $class->grades->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Students List -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-users"></i> Students in This Class</h3>
                    <a href="{{ route('admin.classes.assign-form', $class) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus"></i> Manage Students
                    </a>
                </div>
                
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Guardian</th>
                                <th>Contact</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($class->students as $student)
                                <tr>
                                    <td>{{ $student->student_id }}</td>
                                    <td>{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}</td>
                                    <td>{{ $student->gender }}</td>
                                    <td>{{ $student->guardian_name }}</td>
                                    <td>{{ $student->guardian_contact }}</td>
                                    <td>
                                        <a href="{{ route('admin.students.show', $student) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 40px;">
                                        <i class="fas fa-users" style="font-size: 48px; color: #ccc; margin-bottom: 20px; display: block;"></i>
                                        No students assigned to this class yet.
                                        <a href="{{ route('admin.classes.assign-form', $class) }}" style="color: #667eea; display: block; margin-top: 10px;">
                                            Click here to assign students
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        let loadingTimeout;
        let connectionCheckInterval;
        let hasLoaded = false;

        // Monitor connection status
        function updateConnectionStatus() {
            const statusDiv = document.getElementById('connectionStatus');
            
            if (navigator.onLine) {
                statusDiv.className = 'connection-status connected';
                statusDiv.innerHTML = '<i class="fas fa-wifi"></i><span>Connected</span>';
                
                // Auto-hide after 2 seconds
                setTimeout(() => {
                    statusDiv.style.opacity = '0';
                    setTimeout(() => {
                        statusDiv.style.display = 'none';
                    }, 300);
                }, 2000);
            } else {
                statusDiv.className = 'connection-status disconnected';
                statusDiv.innerHTML = '<i class="fas fa-wifi-slash"></i><span>Disconnected</span>';
                statusDiv.style.display = 'flex';
                statusDiv.style.opacity = '1';
            }
        }

        // Check connection on load and when it changes
        window.addEventListener('load', updateConnectionStatus);
        window.addEventListener('online', updateConnectionStatus);
        window.addEventListener('offline', updateConnectionStatus);

        // Simple function to hide skeleton when page is ready
        function checkPageReady() {
            if (hasLoaded) return;
            
            // Check if page is fully loaded and online
            if (document.readyState === 'complete' && navigator.onLine) {
                // Small delay to ensure everything is rendered
                setTimeout(hideSkeleton, 500);
            }
        }

        // Start timeout for error state (8 seconds)
        loadingTimeout = setTimeout(function() {
            if (!hasLoaded) {
                if (!navigator.onLine) {
                    // No internet - show error state
                    showErrorState();
                } else {
                    // Has internet but still loading - force hide after timeout
                    console.log('Loading timeout reached, forcing hide');
                    hideSkeleton();
                }
            }
        }, 8000);

        // Check connection every 2 seconds after timeout
        function startConnectionCheck() {
            connectionCheckInterval = setInterval(function() {
                if (navigator.onLine && !hasLoaded) {
                    // Connection restored, reload the page
                    window.location.reload();
                }
            }, 2000);
        }

        function showErrorState() {
            const errorState = document.getElementById('errorState');
            errorState.classList.add('show');
            startConnectionCheck();
        }

        function hideErrorState() {
            const errorState = document.getElementById('errorState');
            errorState.classList.remove('show');
            
            if (connectionCheckInterval) {
                clearInterval(connectionCheckInterval);
            }
        }

        function hideSkeleton() {
            if (hasLoaded) return;
            
            const skeleton = document.getElementById('skeletonLoader');
            const content = document.getElementById('mainContent');
            
            hasLoaded = true;
            clearTimeout(loadingTimeout);
            
            if (connectionCheckInterval) {
                clearInterval(connectionCheckInterval);
            }
            
            hideErrorState();
            skeleton.classList.add('hidden');
            content.classList.add('loaded');
            
            // Remove skeleton from DOM after transition
            setTimeout(() => {
                skeleton.style.display = 'none';
            }, 300);
        }

        function retryConnection() {
            if (navigator.onLine) {
                // If online, reload the page
                window.location.reload();
            } else {
                // If still offline, show message
                alert('Still offline. Please check your internet connection.');
            }
        }

        // Check when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            checkPageReady();
        });

        // Check when page is fully loaded
        window.addEventListener('load', function() {
            checkPageReady();
        });

        // If page is already complete, check immediately
        if (document.readyState === 'complete') {
            checkPageReady();
        }

        // If offline at start, start the timeout
        if (!navigator.onLine) {
            loadingTimeout = setTimeout(showErrorState, 8000);
        }

        // Listen for online event to reload
        window.addEventListener('online', function() {
            if (!hasLoaded) {
                window.location.reload();
            }
        });
    </script>
</body>
</html>