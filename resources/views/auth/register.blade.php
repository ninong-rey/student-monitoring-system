<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Student Performance Monitoring System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        /* Animated circles */
        .circles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .circles li {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.2);
            animation: animate 25s linear infinite;
            bottom: -150px;
        }

        .circles li:nth-child(1) { left: 25%; width: 80px; height: 80px; animation-delay: 0s; }
        .circles li:nth-child(2) { left: 10%; width: 20px; height: 20px; animation-delay: 2s; animation-duration: 12s; }
        .circles li:nth-child(3) { left: 70%; width: 20px; height: 20px; animation-delay: 4s; }
        .circles li:nth-child(4) { left: 40%; width: 60px; height: 60px; animation-delay: 0s; animation-duration: 18s; }
        .circles li:nth-child(5) { left: 65%; width: 20px; height: 20px; animation-delay: 0s; }
        .circles li:nth-child(6) { left: 75%; width: 110px; height: 110px; animation-delay: 3s; }
        .circles li:nth-child(7) { left: 35%; width: 150px; height: 150px; animation-delay: 7s; }
        .circles li:nth-child(8) { left: 50%; width: 25px; height: 25px; animation-delay: 15s; animation-duration: 45s; }
        .circles li:nth-child(9) { left: 20%; width: 15px; height: 15px; animation-delay: 2s; animation-duration: 35s; }
        .circles li:nth-child(10) { left: 85%; width: 150px; height: 150px; animation-delay: 0s; animation-duration: 11s; }

        @keyframes animate {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; border-radius: 0; }
            100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; border-radius: 50%; }
        }

        /* ===== MODERN SKELETON ===== */
        .skeleton-loader {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* Card - Exactly matching register-box */
        .skeleton-card {
    width: 90%;
    max-width: 700px;
    background: white;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 2;
    max-height: 90vh;   /* match register-box */
    overflow-y: auto;   /* allow scrolling */
}

        /* Header - Exactly matching logo area */
        .skeleton-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .skeleton-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            margin: 0 auto 15px;
        }

        .skeleton-title {
            width: 200px;
            height: 32px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin: 0 auto 10px;
        }

        .skeleton-subtitle {
            width: 250px;
            height: 20px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin: 0 auto;
        }

        /* Roles - Exactly matching role selector */
        .skeleton-role {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            justify-content: center;
        }

        .skeleton-role-item {
            flex: 1;
            max-width: 200px;
            height: 94px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 10px;
        }

        /* Full width fields */
        .skeleton-field-full {
            height: 74px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        /* Form fields with labels */
        .skeleton-field {
            height: 74px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 10px;
        }

        .skeleton-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        /* Password strength indicator */
        .skeleton-strength-container {
            margin: 5px 0 20px;
        }

        .skeleton-strength {
            height: 5px;
            width: 100%;
            background: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .skeleton-strength-bar {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        .skeleton-strength-text {
            width: 180px;
            height: 14px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin-top: 5px;
        }

        /* Button */
        .skeleton-button {
            width: 100%;
            height: 52px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 12px;
            margin-top: 20px;
        }

        /* Login link */
        .skeleton-login-link {
            width: 200px;
            height: 20px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin: 25px auto 0;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .register-box {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            width: 90%;
            max-width: 700px;
            padding: 40px;
            position: relative;
            z-index: 2;
            max-height: 90vh;
            overflow-y: auto;
            display: none;
        }

        .register-box.visible {
            display: block;
        }

        .register-box::-webkit-scrollbar {
            width: 8px;
        }

        .register-box::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .register-box::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo i {
            font-size: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .logo h2 {
            color: #333;
            font-size: 24px;
            font-weight: 600;
            height: 32px;
            line-height: 32px;
        }

        .logo p {
            color: #999;
            font-size: 14px;
            height: 20px;
            line-height: 20px;
        }

        .role-selector {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            justify-content: center;
        }

        .role-option {
            flex: 1;
            max-width: 200px;
        }

        .role-option input[type="radio"] {
            display: none;
        }

        .role-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 18px 20px;
            background: #f8f9fa;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            height: 94px;
            box-sizing: border-box;
        }

        .role-option input[type="radio"]:checked + label {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%);
        }

        .role-option label i {
            font-size: 28px;
            margin-bottom: 8px;
            color: #667eea;
        }

        .role-option label span {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            display: block;
            color: #555;
            font-weight: 500;
            margin-bottom: 6px;
            font-size: 13px;
            height: 18px;
            line-height: 18px;
        }

        .form-group label i {
            color: #667eea;
            margin-right: 5px;
            font-size: 13px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s;
            background: #f8f9fa;
            height: 44px;
            box-sizing: border-box;
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .teacher-fields {
            transition: all 0.3s;
        }

        .teacher-fields.hidden {
            opacity: 0.5;
            pointer-events: none;
        }

        .error-box {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
            color: #721c24;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .error-box ul {
            margin-left: 20px;
            margin-top: 10px;
        }

        .password-strength {
            margin-top: 5px;
            height: 5px;
            background: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s;
        }

        .strength-bar.weak {
            width: 33.33%;
            background: #dc3545;
        }

        .strength-bar.medium {
            width: 66.66%;
            background: #ffc107;
        }

        .strength-bar.strong {
            width: 100%;
            background: #28a745;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
            margin-top: 20px;
            height: 52px;
            box-sizing: border-box;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 14px;
            height: 20px;
            line-height: 20px;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
            transition: all 0.3s;
        }

        .login-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .form-group.full-width {
                grid-column: span 1;
            }
            
            .register-box {
                padding: 30px 20px;
            }

            .role-selector {
                flex-direction: column;
                align-items: center;
            }

            .role-option {
                max-width: 100%;
                width: 100%;
            }

            .skeleton-row {
                grid-template-columns: 1fr;
            }

            .skeleton-role {
                flex-direction: column;
                align-items: center;
            }

            .skeleton-role-item {
                max-width: 100%;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <ul class="circles">
        <li></li><li></li><li></li><li></li><li></li>
        <li></li><li></li><li></li><li></li><li></li>
    </ul>

    <!-- Modern Skeleton Loader -->
    <div class="skeleton-loader" id="skeletonLoader">
        <div class="skeleton-card">
            <div class="skeleton-header">
                <div class="skeleton-avatar"></div>
                <div class="skeleton-title"></div>
                <div class="skeleton-subtitle"></div>
            </div>

            <div class="skeleton-role">
                <div class="skeleton-role-item"></div>
                <div class="skeleton-role-item"></div>
            </div>

            <!-- Full Name field -->
            <div class="skeleton-field-full"></div>
            
            <!-- Email and Employee ID row -->
            <div class="skeleton-row">
                <div class="skeleton-field"></div>
                <div class="skeleton-field"></div>
            </div>

            <!-- Phone and Department row -->
            <div class="skeleton-row">
                <div class="skeleton-field"></div>
                <div class="skeleton-field"></div>
            </div>

            <!-- Password and Confirm Password row -->
            <div class="skeleton-row">
                <div class="skeleton-field"></div>
                <div class="skeleton-field"></div>
            </div>

            <!-- Password strength indicator -->
            <div class="skeleton-strength-container">
                <div class="skeleton-strength">
                    <div class="skeleton-strength-bar" style="width: 0%;"></div>
                </div>
                <div class="skeleton-strength-text"></div>
            </div>

            <!-- Register button -->
            <div class="skeleton-button"></div>
            
            <!-- Login link -->
            <div class="skeleton-login-link"></div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="register-box" id="registerBox">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            <h2>Create Account</h2>
            <p>Join as Teacher or Administrator</p>
        </div>

        @if($errors->any())
            <div class="error-box">
                <i class="fas fa-exclamation-circle"></i>
                <strong>Please fix the following errors:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <!-- Role Selection -->
            <div class="role-selector">
                <div class="role-option">
                    <input type="radio" name="role" id="role_teacher" value="teacher" checked>
                    <label for="role_teacher">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Teacher</span>
                    </label>
                </div>
                <div class="role-option">
                    <input type="radio" name="role" id="role_admin" value="admin">
                    <label for="role_admin">
                        <i class="fas fa-user-tie"></i>
                        <span>Administrator</span>
                    </label>
                </div>
            </div>
            
            <div class="form-group full-width">
                <label><i class="fas fa-user"></i> Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" required>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-id-card"></i> Employee ID</label>
                    <input type="text" name="employee_id" value="{{ old('employee_id') }}" placeholder="EMP-2024-001">
                </div>
            </div>

            <div class="form-row teacher-fields" id="teacherFields">
                <div class="form-group">
                    <label><i class="fas fa-phone"></i> Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+63 123 456 7890">
                </div>

                <div class="form-group">
                    <label><i class="fas fa-building"></i> Department</label>
                    <select name="department">
                        <option value="">Select Department</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Information Technology">Information Technology</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Business">Business</option>
                        <option value="Education">Education</option>
                        <option value="Arts & Sciences">Arts & Sciences</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-lock"></i> Confirm Password</label>
                    <input type="password" name="password_confirmation" id="confirmPassword" placeholder="••••••••" required>
                </div>
            </div>

            <div class="form-group full-width">
                <div class="password-strength">
                    <div class="strength-bar" id="strengthBar"></div>
                </div>
                <small style="color: #999; display: block; margin-top: 5px;">
                    Password must be at least 8 characters with uppercase, lowercase, number and special character
                </small>
            </div>

            <button type="submit" class="btn-register" id="registerBtn">
                <i class="fas fa-user-plus"></i>
                Create Account
            </button>
        </form>

        <div class="login-link">
            Already have an account?
            <a href="{{ route('login') }}">Login here</a>
        </div>
    </div>

    <script>
        // Show skeleton loader immediately
        const skeleton = document.getElementById("skeletonLoader");
        const content = document.getElementById("registerBox");
        
        // Hide skeleton and show content after a short delay (simulating loading)
        setTimeout(() => {
            skeleton.style.display = 'none';
            content.classList.add('visible');
        }, 1500); // 1.5 second delay - adjust as needed

        // Password strength checker
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const strengthBar = document.getElementById('strengthBar');
        
        password.addEventListener('input', checkStrength);
        confirmPassword.addEventListener('input', checkMatch);
        
        function checkStrength() {
            const value = password.value;
            let strength = 0;
            
            if (value.length >= 8) strength++;
            if (value.match(/[a-z]+/)) strength++;
            if (value.match(/[A-Z]+/)) strength++;
            if (value.match(/[0-9]+/)) strength++;
            if (value.match(/[$@#&!]+/)) strength++;
            
            strengthBar.className = 'strength-bar';
            
            if (value.length === 0) {
                strengthBar.style.width = '0%';
            } else if (strength <= 2) {
                strengthBar.classList.add('weak');
            } else if (strength <= 4) {
                strengthBar.classList.add('medium');
            } else {
                strengthBar.classList.add('strong');
            }
        }
        
        function checkMatch() {
            if (confirmPassword.value.length > 0) {
                if (password.value === confirmPassword.value) {
                    confirmPassword.style.borderColor = '#28a745';
                } else {
                    confirmPassword.style.borderColor = '#dc3545';
                }
            } else {
                confirmPassword.style.borderColor = '#e0e0e0';
            }
        }

        // Role selection toggle for teacher fields
        const teacherRadio = document.getElementById('role_teacher');
        const adminRadio = document.getElementById('role_admin');
        const teacherFields = document.getElementById('teacherFields');
        const employeeIdInput = document.querySelector('input[name="employee_id"]');
        const phoneInput = document.querySelector('input[name="phone"]');
        const departmentSelect = document.querySelector('select[name="department"]');

        function toggleTeacherFields() {
            if (adminRadio.checked) {
                teacherFields.classList.add('hidden');
                employeeIdInput.required = false;
                phoneInput.required = false;
                departmentSelect.required = false;
            } else {
                teacherFields.classList.remove('hidden');
                employeeIdInput.required = true;
                phoneInput.required = true;
                departmentSelect.required = true;
            }
        }

        teacherRadio.addEventListener('change', toggleTeacherFields);
        adminRadio.addEventListener('change', toggleTeacherFields);
        toggleTeacherFields();

        // Form submit loading
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                alert('Passwords do not match!');
                return;
            }
            
            const btn = document.getElementById('registerBtn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Account...';
            btn.disabled = true;
        });
    </script>
</body>
</html>