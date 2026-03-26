<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject - Admin Dashboard</title>
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
            max-width: 800px;
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
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            position: relative;
        }

        .skeleton-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .skeleton-header-title {
            width: 180px;
            height: 28px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
        }

        .skeleton-header-button {
            width: 100px;
            height: 38px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 8px;
        }

        .skeleton-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .skeleton-field {
            height: 80px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 10px;
        }

        .skeleton-field-full {
            height: 80px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .skeleton-field-textarea {
            height: 120px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .skeleton-form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
        }

        .skeleton-button {
            width: 100px;
            height: 42px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 8px;
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

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error-message ul {
            margin-left: 20px;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .main-content {
                margin-left: 0;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .skeleton-loader {
                margin-left: 0;
            }

            .skeleton-row {
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
            <a href="{{ route('admin.subjects.index') }}" class="menu-item active">
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
            <div class="skeleton-header">
                <div class="skeleton-header-title"></div>
                <div class="skeleton-header-button"></div>
            </div>

            <!-- First row - Subject Code & Name -->
            <div class="skeleton-row">
                <div class="skeleton-field"></div>
                <div class="skeleton-field"></div>
            </div>

            <!-- Units -->
            <div class="skeleton-field-full"></div>

            <!-- Description (textarea) -->
            <div class="skeleton-field-textarea"></div>

            <!-- Form actions -->
            <div class="skeleton-form-actions">
                <div class="skeleton-button"></div>
                <div class="skeleton-button"></div>
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
            @if($errors->any())
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <strong>Please fix the following errors:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-book"></i> Add New Subject</h2>
                    <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>

                <form action="{{ route('admin.subjects.store') }}" method="POST">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-code"></i> Subject Code</label>
                            <input type="text" name="subject_code" value="{{ old('subject_code') }}" placeholder="e.g., CS101" required>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-book"></i> Subject Name</label>
                            <input type="text" name="subject_name" value="{{ old('subject_name') }}" placeholder="e.g., Introduction to Computer Science" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-sort-numeric-up"></i> Units</label>
                        <select name="units" required>
                            <option value="">Select Units</option>
                            <option value="1" {{ old('units') == 1 ? 'selected' : '' }}>1 Unit</option>
                            <option value="2" {{ old('units') == 2 ? 'selected' : '' }}>2 Units</option>
                            <option value="3" {{ old('units') == 3 ? 'selected' : '' }}>3 Units</option>
                            <option value="4" {{ old('units') == 4 ? 'selected' : '' }}>4 Units</option>
                            <option value="5" {{ old('units') == 5 ? 'selected' : '' }}>5 Units</option>
                            <option value="6" {{ old('units') == 6 ? 'selected' : '' }}>6 Units</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-align-left"></i> Description (Optional)</label>
                        <textarea name="description" rows="4" placeholder="Enter subject description...">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Subject
                        </button>
                    </div>
                </form>
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