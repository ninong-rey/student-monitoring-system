<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $class->class_name }} Grades - Teacher Dashboard</title>
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

        .class-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .class-info h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .class-info p {
            opacity: 0.9;
            font-size: 14px;
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

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        .btn-warning {
            background: #ffc107;
            color: #333;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .table-container {
            overflow-x: auto;
            margin-top: 20px;
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
            position: sticky;
            top: 0;
        }

        td {
            padding: 10px 15px;
            border-bottom: 1px solid #f0f0f0;
            color: #666;
            font-size: 13px;
        }

        tr:hover td {
            background: #f8f9ff;
        }

        .score-input {
            width: 70px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
        }

        .score-input:focus {
            outline: none;
            border-color: #667eea;
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

        .assessment-badge {
            background: #e9ecef;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            margin-right: 5px;
            display: inline-block;
            margin-bottom: 5px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 15px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            animation: slideUp 0.3s;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .modal-header h3 {
            color: #333;
            font-size: 18px;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #999;
        }

        .close-modal:hover {
            color: #333;
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

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-group input:focus, .form-group select:focus {
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
            flex-wrap: wrap;
        }

        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
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
            <a href="{{ route('teacher.dashboard') }}" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('teacher.classes.index') }}" class="menu-item">
                <i class="fas fa-school"></i>
                <span>My Classes</span>
            </a>
            <a href="{{ route('teacher.students.index') }}" class="menu-item">
                <i class="fas fa-users"></i>
                <span>My Students</span>
            </a>
            <a href="{{ route('teacher.grades.index') }}" class="menu-item active">
                <i class="fas fa-chart-line"></i>
                <span>Grades</span>
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

            <!-- Class Info -->
            <div class="class-info">
                <h2><i class="fas fa-school"></i> {{ $class->class_name }} - Section {{ $class->section }}</h2>
                <p><i class="fas fa-book"></i> {{ $class->subject->subject_name }} | <i class="fas fa-calendar"></i> {{ $class->academic_year }} | <i class="fas fa-clock"></i> {{ $class->semester }}</p>
            </div>

            <!-- Action Bar -->
            <div class="action-bar">
                <button onclick="openAddScoreModal()" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Add Assessment
                </button>
                <button onclick="openCalculateModal()" class="btn btn-success">
                    <i class="fas fa-calculator"></i> Calculate Grades
                </button>
                <a href="{{ route('teacher.grades.export', $class) }}" class="btn btn-warning">
                    <i class="fas fa-download"></i> Export Grades
                </a>
                <a href="{{ route('teacher.grades.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Back to Classes
                </a>
            </div>

            <!-- Assessment Types Summary -->
            @if($assessmentTypes->isNotEmpty())
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-tasks"></i> Assessment Components</h3>
                    </div>
                    <div class="stats-grid">
                        @foreach($assessmentTypes as $type)
                            <div class="stats-card">
                                <h4 style="color: #667eea; margin-bottom: 10px; text-transform: capitalize;">
                                    {{ $type->assessment_type }}s
                                </h4>
                                <p style="font-size: 24px; font-weight: bold;">{{ $type->count }}</p>
                                <p style="color: #999; font-size: 12px;">assessments</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Grades Table -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-chart-line"></i> Student Grades</h3>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                @foreach($assessmentTypes as $type)
                                    <th>{{ ucfirst($type->assessment_type) }}</th>
                                @endforeach
                                <th>Prelim</th>
                                <th>Midterm</th>
                                <th>Final</th>
                                <th>Average</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                                <tr>
                                    <td>{{ $student->student_id }}</td>
                                    <td>{{ $student->last_name }}, {{ $student->first_name }}</td>
                                    
                                    @foreach($assessmentTypes as $type)
                                        <td>
                                            @php
                                                $scores = $student->scores->where('assessment_type', $type->assessment_type);
                                                $average = $scores->avg(function($score) {
                                                    return ($score->score / $score->max_score) * 100;
                                                });
                                            @endphp
                                            @if($average)
                                                <span class="badge {{ $average >= 75 ? 'badge-success' : 'badge-danger' }}">
                                                    {{ number_format($average, 1) }}%
                                                </span>
                                            @else
                                                <span class="badge badge-warning">No scores</span>
                                            @endif
                                        </td>
                                    @endforeach
                                    
                                    @php
                                        $grade = $student->grades->first();
                                    @endphp
                                    
                                    <td>{{ $grade->prelim_grade ?? '—' }}</td>
                                    <td>{{ $grade->midterm_grade ?? '—' }}</td>
                                    <td>{{ $grade->final_grade ?? '—' }}</td>
                                    <td>
                                        @if($grade && $grade->average_grade)
                                            <strong>{{ number_format($grade->average_grade, 1) }}</strong>
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td>
                                        @if($grade && $grade->remarks)
                                            <span class="badge {{ $grade->remarks == 'Passed' ? 'badge-success' : 'badge-danger' }}">
                                                {{ $grade->remarks }}
                                            </span>
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td>
                                        <button onclick="openStudentScoresModal({{ $student->id }})" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ 8 + $assessmentTypes->count() }}" style="text-align: center;">
                                        No students in this class
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Score Modal -->
    <div id="addScoreModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Assessment</h3>
                <button class="close-modal" onclick="closeAddScoreModal()">&times;</button>
            </div>
            <form action="{{ route('teacher.scores.store') }}" method="POST">
                @csrf
                <input type="hidden" name="class_id" value="{{ $class->id }}">
                
                <div class="form-group">
                    <label>Assessment Type</label>
                    <select name="assessment_type" required>
                        <option value="">Select Type</option>
                        <option value="quiz">Quiz</option>
                        <option value="exam">Exam</option>
                        <option value="project">Project</option>
                        <option value="assignment">Assignment</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Assessment Name</label>
                    <input type="text" name="assessment_name" placeholder="e.g., Midterm Exam" required>
                </div>

                <div class="form-group">
                    <label>Score (all students will get this score initially)</label>
                    <input type="number" name="score" step="0.01" value="0" required>
                </div>

                <div class="form-group">
                    <label>Max Score</label>
                    <input type="number" name="max_score" step="0.01" value="100" required>
                </div>

                <div class="form-group">
                    <label>Percentage Weight (%)</label>
                    <input type="number" name="percentage" step="0.01" placeholder="e.g., 20" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-save"></i> Save Assessment
                </button>
            </form>
        </div>
    </div>

    <!-- Calculate Grades Modal -->
    <div id="calculateModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Calculate Grades</h3>
                <button class="close-modal" onclick="closeCalculateModal()">&times;</button>
            </div>
            <form action="{{ route('teacher.grades.calculate', $class) }}" method="POST">
                @csrf
                
                <p style="margin-bottom: 20px; color: #666;">
                    Select which grading period to calculate:
                </p>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="prelim" value="1" checked>
                        Calculate Prelim Grade
                    </label>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="midterm" value="1" checked>
                        Calculate Midterm Grade
                    </label>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="final" value="1" checked>
                        Calculate Final Grade
                    </label>
                </div>

                <button type="submit" class="btn btn-success" style="width: 100%;">
                    <i class="fas fa-calculator"></i> Calculate Grades
                </button>
            </form>
        </div>
    </div>

    <script>
        function openAddScoreModal() {
            document.getElementById('addScoreModal').classList.add('active');
        }

        function closeAddScoreModal() {
            document.getElementById('addScoreModal').classList.remove('active');
        }

        function openCalculateModal() {
            document.getElementById('calculateModal').classList.add('active');
        }

        function closeCalculateModal() {
            document.getElementById('calculateModal').classList.remove('active');
        }

        function openStudentScoresModal(studentId) {
            alert('View scores for student ID: ' + studentId + ' - This feature is coming soon!');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const addModal = document.getElementById('addScoreModal');
            const calcModal = document.getElementById('calculateModal');
            
            if (event.target === addModal) {
                addModal.classList.remove('active');
            }
            if (event.target === calcModal) {
                calcModal.classList.remove('active');
            }
        }
    </script>
</body>
</html>