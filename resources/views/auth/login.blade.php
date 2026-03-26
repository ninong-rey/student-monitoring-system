<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Student Performance Monitoring System</title>
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
            position: relative;
            overflow: hidden;
        }

        /* Animated background circles */
        .circles {
            position: absolute;
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

        /* ===== SKELETON LOADER ===== */
        .skeleton-loader {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .skeleton-card {
            width: 90%;
            max-width: 400px;
            background: white;
            padding: 30px 35px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
        }

        .skeleton-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .skeleton-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            margin: 0 auto 12px;
        }

        .skeleton-title {
            width: 160px;
            height: 24px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin: 0 auto 8px;
        }

        .skeleton-subtitle {
            width: 200px;
            height: 16px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin: 0 auto;
        }

        .skeleton-field {
            height: 52px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .skeleton-button {
            width: 100%;
            height: 48px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .skeleton-link {
            width: 180px;
            height: 16px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            margin: 0 auto 20px;
        }

        .skeleton-features {
            display: flex;
            gap: 15px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #f0f0f0;
        }

        .skeleton-feature {
            flex: 1;
            height: 35px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 6px;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .login-box {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            width: 90%;
            max-width: 400px;
            padding: 30px 35px;
            position: relative;
            z-index: 2;
            display: none;
        }

        .login-box.visible {
            display: block;
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo i {
            font-size: 45px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .logo h2 {
            color: #333;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .logo p {
            color: #999;
            font-size: 13px;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 16px;
            transition: all 0.3s;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s;
            background: #f8f9fa;
            height: 48px;
        }

        .input-group input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .input-group input:focus + i {
            color: #667eea;
        }

        .error-box {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
            color: #721c24;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            animation: shake 0.5s ease;
            font-size: 14px;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .error-box i {
            margin-right: 10px;
            font-size: 18px;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
            height: 48px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
            transition: all 0.3s;
        }

        .register-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .features {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            padding-top: 15px;
            border-top: 2px solid #f0f0f0;
        }

        .feature {
            text-align: center;
            flex: 1;
        }

        .feature i {
            color: #667eea;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .feature span {
            display: block;
            color: #999;
            font-size: 11px;
        }

        @media (max-width: 480px) {
            .login-box, .skeleton-card {
                padding: 25px 20px;
            }
            
            .logo i {
                font-size: 40px;
            }
            
            .logo h2 {
                font-size: 20px;
            }
            
            .features {
                flex-wrap: wrap;
                gap: 10px;
            }
            
            .feature {
                min-width: 80px;
            }
        }
    </style>
</head>
<body>
    <ul class="circles">
        <li></li><li></li><li></li><li></li><li></li>
        <li></li><li></li><li></li><li></li><li></li>
    </ul>

    <!-- Skeleton Loader -->
    <div class="skeleton-loader" id="skeletonLoader">
        <div class="skeleton-card">
            <div class="skeleton-header">
                <div class="skeleton-avatar"></div>
                <div class="skeleton-title"></div>
                <div class="skeleton-subtitle"></div>
            </div>

            <!-- Email field -->
            <div class="skeleton-field"></div>
            
            <!-- Password field -->
            <div class="skeleton-field"></div>

            <!-- Login button -->
            <div class="skeleton-button"></div>
            
            <!-- Register link -->
            <div class="skeleton-link"></div>

            <!-- Features -->
            <div class="skeleton-features">
                <div class="skeleton-feature"></div>
                <div class="skeleton-feature"></div>
                <div class="skeleton-feature"></div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="login-box" id="loginBox">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            <h2>Welcome Back!</h2>
            <p>Student Performance Monitoring System</p>
        </div>

        @if($errors->any())
            <div class="error-box">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn-login" id="loginBtn">
                <i class="fas fa-sign-in-alt"></i>
                Login to Dashboard
            </button>
        </form>

        <div class="register-link">
            Don't have an account?
            <a href="{{ route('register') }}">Register as Teacher</a>
        </div>

        <div class="features">
            <div class="feature">
                <i class="fas fa-chart-line"></i>
                <span>Track Progress</span>
            </div>
            <div class="feature">
                <i class="fas fa-calculator"></i>
                <span>Auto Compute</span>
            </div>
            <div class="feature">
                <i class="fas fa-mobile-alt"></i>
                <span>Mobile Ready</span>
            </div>
        </div>
    </div>

    <script>
        // Show skeleton loader immediately
        const skeleton = document.getElementById("skeletonLoader");
        const content = document.getElementById("loginBox");
        
        // Hide skeleton and show content after a short delay
        setTimeout(() => {
            skeleton.style.display = 'none';
            content.classList.add('visible');
        }, 1500); // 1.5 second delay

        // Form submit loading
        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';
            btn.disabled = true;
        });
    </script>
</body>
</html>