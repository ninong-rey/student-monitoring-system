<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Teachers - Admin Dashboard</title>
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

        .skeleton-action-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .skeleton-action-button {
            width: 150px;
            height: 42px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 8px;
        }

        .skeleton-card-item {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
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

        .skeleton-search-box {
            width: 100%;
            height: 46px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .skeleton-table {
            width: 100%;
        }

        .skeleton-table-header {
            display: grid;
            grid-template-columns: 1.2fr 2fr 2fr 1.5fr 1.5fr 1.5fr;
            gap: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 12px 15px;
            border-radius: 8px 8px 0 0;
            margin-bottom: 2px;
        }

        .skeleton-table-header-cell {
            height: 16px;
            background: linear-gradient(90deg, rgba(255,255,255,0.2) 25%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0.2) 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
        }

        .skeleton-table-row {
            display: grid;
            grid-template-columns: 1.2fr 2fr 2fr 1.5fr 1.5fr 1.5fr;
            gap: 15px;
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
            background: white;
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

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-warning {
            background: #ffc107;
            color: #333;
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
            font-weight: 500;
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

        .badge-primary {
            background: #667eea20;
            color: #667eea;
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .search-box input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
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

        .action-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
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
            <a href="{{ route('admin.teachers.index') }}" class="menu-item active">
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
                <div class="skeleton-action-button"></div>
            </div>

            <!-- Card Skeleton -->
            <div class="skeleton-card-item">
                <div class="skeleton-card-header">
                    <div class="skeleton-card-title"></div>
                </div>

                <!-- Search Box Skeleton -->
                <div class="skeleton-search-box"></div>

                <!-- Table Skeleton -->
                <div class="skeleton-table">
                    <!-- Table Header -->
                    <div class="skeleton-table-header">
                        <div class="skeleton-table-header-cell"></div>
                        <div class="skeleton-table-header-cell"></div>
                        <div class="skeleton-table-header-cell"></div>
                        <div class="skeleton-table-header-cell"></div>
                        <div class="skeleton-table-header-cell"></div>
                        <div class="skeleton-table-header-cell"></div>
                    </div>

                    <!-- Table Rows -->
                    @for($i = 0; $i < 8; $i++)
                        <div class="skeleton-table-row">
                            <div class="skeleton-table-cell"></div>
                            <div class="skeleton-table-cell"></div>
                            <div class="skeleton-table-cell"></div>
                            <div class="skeleton-table-cell"></div>
                            <div class="skeleton-table-cell"></div>
                            <div style="display: flex; gap: 5px;">
                                <div class="skeleton-table-cell" style="width: 30px;"></div>
                                <div class="skeleton-table-cell" style="width: 30px;"></div>
                                <div class="skeleton-table-cell" style="width: 30px;"></div>
                            </div>
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
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="action-bar">
                <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Add New Teacher
                </a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-chalkboard-teacher"></i> Teacher Management</h3>
                </div>

                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Search by name, employee ID, or department..." onkeyup="searchTable()">
                </div>

                <div class="table-container">
                    <table id="teachersTable">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teachers as $teacher)
                                <tr>
                                    <td>{{ $teacher->employee_id }}</td>
                                    <td>{{ $teacher->user->name }}</td>
                                    <td>{{ $teacher->user->email }}</td>
                                    <td>{{ $teacher->department }}</td>
                                    <td>{{ $teacher->phone }}</td>
                                    <td>
                                        <a href="{{ route('admin.teachers.show', $teacher) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this teacher?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 40px;">
                                        <i class="fas fa-chalkboard-teacher" style="font-size: 48px; color: #ccc; margin-bottom: 20px; display: block;"></i>
                                        No teachers found. 
                                        <a href="{{ route('admin.teachers.create') }}" style="color: #667eea;">Add your first teacher</a>
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

        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('teachersTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length - 1; j++) {
                    const cell = cells[j];
                    if (cell) {
                        const textValue = cell.textContent || cell.innerText;
                        if (textValue.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }

                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }

        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>