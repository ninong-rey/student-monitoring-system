<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Admin Dashboard</title>
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
            max-width: 1400px;
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
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
        }

        /* Stats Grid Skeleton */
        .skeleton-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .skeleton-stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
        }

        .skeleton-stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            margin-right: 20px;
        }

        .skeleton-stat-info {
            flex: 1;
        }

        .skeleton-stat-label {
            width: 100px;
            height: 14px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .skeleton-stat-value {
            width: 80px;
            height: 28px;
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

        /* Gender Distribution Skeleton */
        .skeleton-gender-container {
            display: flex;
            gap: 40px;
            align-items: center;
            flex-wrap: wrap;
        }

        .skeleton-gender-item {
            flex: 1;
            min-width: 200px;
        }

        .skeleton-progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .skeleton-progress-text {
            width: 60px;
            height: 14px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
        }

        .skeleton-progress {
            height: 8px;
            background: #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
            margin: 5px 0 15px;
        }

        .skeleton-progress-bar {
            width: 60%;
            height: 100%;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        /* Grade Summary Skeleton */
        .skeleton-grade-summary {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .skeleton-grade-item {
            flex: 1;
            min-width: 150px;
            text-align: center;
        }

        .skeleton-grade-number {
            width: 80px;
            height: 36px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin: 0 auto 10px;
        }

        .skeleton-grade-label {
            width: 100px;
            height: 14px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin: 0 auto 5px;
        }

        .skeleton-grade-percent {
            width: 60px;
            height: 12px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin: 0 auto;
        }

        /* Report Grid Skeleton */
        .skeleton-report-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .skeleton-report-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 25px;
            opacity: 0.7;
        }

        .skeleton-report-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(90deg, rgba(255,255,255,0.2) 25%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0.2) 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .skeleton-report-title {
            width: 150px;
            height: 20px;
            background: linear-gradient(90deg, rgba(255,255,255,0.2) 25%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0.2) 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .skeleton-report-desc {
            width: 100%;
            height: 14px;
            background: linear-gradient(90deg, rgba(255,255,255,0.2) 25%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0.2) 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .skeleton-report-desc:last-child {
            width: 80%;
        }

        /* Table Skeleton */
        .skeleton-table {
            width: 100%;
        }

        .skeleton-table-header {
            display: grid;
            grid-template-columns: 2fr 2fr 1fr 1fr 1fr;
            gap: 15px;
            background: #f0f0f0;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .skeleton-table-row {
            display: grid;
            grid-template-columns: 2fr 2fr 1fr 1fr 1fr;
            gap: 15px;
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .skeleton-table-cell {
            height: 16px;
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

        .btn-info {
            background: #17a2b8;
            color: white;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 28px;
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%);
            color: #667eea;
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #28a74520 0%, #20c99720 100%);
            color: #28a745;
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, #ffc10720 0%, #fd7e1420 100%);
            color: #ff9800;
        }

        .stat-icon.purple {
            background: linear-gradient(135deg, #6f42c120 0%, #e83e8c20 100%);
            color: #6f42c1;
        }

        .stat-info h4 {
            color: #666;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .stat-info p {
            color: #333;
            font-size: 28px;
            font-weight: 700;
        }

        .report-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .report-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 25px;
            color: white;
            transition: all 0.3s;
            text-decoration: none;
            display: block;
        }

        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .report-card h4 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .report-card p {
            opacity: 0.9;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .report-icon {
            font-size: 40px;
            margin-bottom: 15px;
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

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
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
            height: 8px;
            background: #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
            margin: 5px 0;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 4px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .alert-info {
            background: #d1ecf1;
            border-left: 4px solid #17a2b8;
            color: #0c5460;
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

            .skeleton-loader {
                margin-left: 0;
            }

            .skeleton-stats-grid {
                grid-template-columns: 1fr;
            }

            .skeleton-report-grid {
                grid-template-columns: 1fr;
            }

            .skeleton-table-header,
            .skeleton-table-row {
                grid-template-columns: 1fr;
                gap: 8px;
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

    <!-- Skeleton Loader -->
    <div class="skeleton-loader" id="skeletonLoader">
        <div class="skeleton-card">
            <!-- Stats Cards Skeleton -->
            <div class="skeleton-stats-grid">
                @for($i = 0; $i < 4; $i++)
                    <div class="skeleton-stat-card">
                        <div class="skeleton-stat-icon"></div>
                        <div class="skeleton-stat-info">
                            <div class="skeleton-stat-label"></div>
                            <div class="skeleton-stat-value"></div>
                        </div>
                    </div>
                @endfor
            </div>

            <!-- Gender Distribution Skeleton -->
            <div class="skeleton-card">
                <div class="skeleton-card-header">
                    <div class="skeleton-card-title"></div>
                </div>
                <div class="skeleton-gender-container">
                    <div class="skeleton-gender-item">
                        <div class="skeleton-progress-label">
                            <div class="skeleton-progress-text"></div>
                            <div class="skeleton-progress-text"></div>
                        </div>
                        <div class="skeleton-progress">
                            <div class="skeleton-progress-bar" style="width: 60%"></div>
                        </div>
                        <div class="skeleton-progress-label">
                            <div class="skeleton-progress-text"></div>
                            <div class="skeleton-progress-text"></div>
                        </div>
                        <div class="skeleton-progress">
                            <div class="skeleton-progress-bar" style="width: 40%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grade Summary Skeleton -->
            <div class="skeleton-card">
                <div class="skeleton-card-header">
                    <div class="skeleton-card-title"></div>
                </div>
                <div class="skeleton-grade-summary">
                    @for($i = 0; $i < 3; $i++)
                        <div class="skeleton-grade-item">
                            <div class="skeleton-grade-number"></div>
                            <div class="skeleton-grade-label"></div>
                            <div class="skeleton-grade-percent"></div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Report Grid Skeleton -->
            <div class="skeleton-report-grid">
                @for($i = 0; $i < 3; $i++)
                    <div class="skeleton-report-card">
                        <div class="skeleton-report-icon"></div>
                        <div class="skeleton-report-title"></div>
                        <div class="skeleton-report-desc"></div>
                        <div class="skeleton-report-desc"></div>
                        <div class="skeleton-report-desc"></div>
                    </div>
                @endfor
            </div>

            <!-- Recent Grades Table Skeleton -->
            <div class="skeleton-card">
                <div class="skeleton-card-header">
                    <div class="skeleton-card-title"></div>
                </div>
                <div class="skeleton-table">
                    <div class="skeleton-table-header">
                        <div class="skeleton-table-cell"></div>
                        <div class="skeleton-table-cell"></div>
                        <div class="skeleton-table-cell"></div>
                        <div class="skeleton-table-cell"></div>
                        <div class="skeleton-table-cell"></div>
                    </div>
                    @for($i = 0; $i < 5; $i++)
                        <div class="skeleton-table-row">
                            <div class="skeleton-table-cell"></div>
                            <div class="skeleton-table-cell"></div>
                            <div class="skeleton-table-cell"></div>
                            <div class="skeleton-table-cell"></div>
                            <div class="skeleton-table-cell"></div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Top Classes Table Skeleton -->
            <div class="skeleton-card">
                <div class="skeleton-card-header">
                    <div class="skeleton-card-title"></div>
                </div>
                <div class="skeleton-table">
                    <div class="skeleton-table-header" style="grid-template-columns: 2fr 2fr 1fr 2fr;">
                        <div class="skeleton-table-cell"></div>
                        <div class="skeleton-table-cell"></div>
                        <div class="skeleton-table-cell"></div>
                        <div class="skeleton-table-cell"></div>
                    </div>
                    @for($i = 0; $i < 5; $i++)
                        <div class="skeleton-table-row" style="grid-template-columns: 2fr 2fr 1fr 2fr;">
                            <div class="skeleton-table-cell"></div>
                            <div class="skeleton-table-cell"></div>
                            <div class="skeleton-table-cell"></div>
                            <div class="skeleton-table-cell"></div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Error State -->
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
            @if(session('info'))
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    {{ session('info') }}
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Total Students</h4>
                        <p>{{ $totalStudents }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Total Teachers</h4>
                        <p>{{ $totalTeachers }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fas fa-school"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Total Classes</h4>
                        <p>{{ $totalClasses }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon purple">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Total Subjects</h4>
                        <p>{{ $totalSubjects }}</p>
                    </div>
                </div>
            </div>

            <!-- Gender Distribution -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-venus-mars"></i> Student Gender Distribution</h3>
                </div>
                <div style="display: flex; gap: 40px; align-items: center; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 200px;">
                        <div style="margin-bottom: 15px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                <span>Male</span>
                                <span><strong>{{ $maleStudents }}</strong> ({{ $totalStudents > 0 ? round(($maleStudents / $totalStudents) * 100, 1) : 0 }}%)</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: {{ $totalStudents > 0 ? ($maleStudents / $totalStudents) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                <span>Female</span>
                                <span><strong>{{ $femaleStudents }}</strong> ({{ $totalStudents > 0 ? round(($femaleStudents / $totalStudents) * 100, 1) : 0 }}%)</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: {{ $totalStudents > 0 ? ($femaleStudents / $totalStudents) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grade Performance Summary -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-chart-line"></i> Grade Performance Summary</h3>
                </div>
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 150px; text-align: center;">
                        <div style="font-size: 36px; font-weight: bold; color: #28a745;">{{ $passingGrades }}</div>
                        <div style="color: #666;">Passing Grades</div>
                        <div style="font-size: 14px; color: #999;">{{ $totalGrades > 0 ? round(($passingGrades / $totalGrades) * 100, 1) : 0 }}% of total</div>
                    </div>
                    <div style="flex: 1; min-width: 150px; text-align: center;">
                        <div style="font-size: 36px; font-weight: bold; color: #dc3545;">{{ $failingGrades }}</div>
                        <div style="color: #666;">Failing Grades</div>
                        <div style="font-size: 14px; color: #999;">{{ $totalGrades > 0 ? round(($failingGrades / $totalGrades) * 100, 1) : 0 }}% of total</div>
                    </div>
                    <div style="flex: 1; min-width: 150px; text-align: center;">
                        <div style="font-size: 36px; font-weight: bold; color: #667eea;">{{ $totalGrades }}</div>
                        <div style="color: #666;">Total Grades</div>
                        <div style="font-size: 14px; color: #999;">recorded</div>
                    </div>
                </div>
            </div>

            <!-- Report Types -->
            <div class="report-grid">
                <a href="{{ route('admin.reports.student') }}" class="report-card">
                    <div class="report-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h4>Student Performance Report</h4>
                    <p>View detailed performance reports for individual students, including grades, attendance, and progress tracking.</p>
                </a>

                <a href="{{ route('admin.reports.class') }}" class="report-card">
                    <div class="report-icon">
                        <i class="fas fa-school"></i>
                    </div>
                    <h4>Class Performance Report</h4>
                    <p>Analyze class-wide performance metrics, grade distributions, and subject-wise achievements.</p>
                </a>

                <a href="{{ route('admin.reports.teacher') }}" class="report-card">
                    <div class="report-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h4>Teacher Performance Report</h4>
                    <p>Evaluate teacher effectiveness through class performance, student feedback, and grade distributions.</p>
                </a>
            </div>

            <!-- Recent Grades -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-clock"></i> Recent Grade Entries</h3>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Class</th>
                                <th>Average Grade</th>
                                <th>Remarks</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentGrades as $grade)
                                <tr>
                                    <td>{{ $grade->student->last_name ?? 'N/A' }}, {{ $grade->student->first_name ?? 'N/A' }}</td>
                                    <td>{{ $grade->class->class_name ?? 'N/A' }} - {{ $grade->class->section ?? 'N/A' }}</td>
                                    <td><strong>{{ number_format($grade->average_grade, 1) }}</strong></td>
                                    <td>
                                        <span class="badge {{ $grade->remarks == 'Passed' ? 'badge-success' : 'badge-danger' }}">
                                            {{ $grade->remarks }}
                                        </span>
                                    </td>
                                    <td>{{ $grade->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center;">No grade entries yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Performing Classes -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-trophy"></i> Top Performing Classes</h3>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Students</th>
                                <th>Average Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($classPerformance as $class)
                                <tr>
                                    <td>{{ $class->class_name }} - {{ $class->section }}</td>
                                    <td>{{ $class->subject->subject_name ?? 'N/A' }}</td>
                                    <td>{{ $class->students_count }}</td>
                                    <td>
                                        <strong>{{ $class->average_grade }}</strong>
                                        <div class="progress" style="width: 100px; display: inline-block; margin-left: 10px;">
                                            <div class="progress-bar" style="width: {{ $class->average_grade }}%"></div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center;">No class data available</td>
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