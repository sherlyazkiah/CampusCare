<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Team Campus Care</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="text-gray-800">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <a href="/" class="flex items-center space-x-3">
                    <img src="{{ asset('image/logoc.png') }}" alt="Logo" class="h-10 w-10" />
                    <span class="text-2xl font-bold text-blue-700">Campus Care</span>
                </a>
                <a href="{{ route('user.dashboard') }}"
                    class="text-gray-600 hover:text-blue-600 font-medium transition">Back</a>
            </div>
        </nav>

        <!-- Philosophy -->
        <section class="py-16 bg-white">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h2 class="text-4xl font-bold text-blue-700 mb-6">Team Philosophy</h2>
                <p class="text-lg text-gray-700 mb-6">
                    <strong>CAMPUS CARE</strong> is more than just a name — it reflects our shared commitment to creating
                    a campus that is well-maintained, orderly, and responsive to the evolving needs of the academic
                    community.
                </p>
                <p class="text-lg text-gray-700 mb-6">
                    We believe that reporting and repairing campus facilities should not be seen as a burden, but as a
                    shared act of care — a way for everyone to contribute to a safe, comfortable, and productive learning
                    environment.
                </p>
                <div class="text-left max-w-2xl mx-auto mb-6 bg-blue-50 p-6 rounded-xl shadow-sm">
                    <p class="font-semibold text-blue-800 mb-2">The word CARE in our name defines the principles that
                        guide our work:</p>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li><strong>C – Collaborate:</strong> Building strong collaboration between students, lecturers,
                            staff, technicians, and facility managers.</li>
                        <li><strong>A – Act:</strong> Taking swift action on facility issues to ensure uninterrupted
                            campus activities.</li>
                        <li><strong>R – Respond:</strong> Delivering responses that are structured, transparent, and
                            solution-focused.</li>
                        <li><strong>E – Enhance:</strong> Continuously enhancing campus infrastructure through digital
                            systems and efficient monitoring.</li>
                    </ul>
                </div>
                <p class="text-lg text-gray-700 font-medium">
                    A caring campus is a thriving campus — and we are here to take part in that care, together.
                </p>
            </div>
        </section>

        <!-- Description -->
        <section class="py-16 bg-blue-50">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h2 class="text-4xl font-bold text-blue-700 mb-6">Team Description</h2>
                <p class="text-lg text-gray-700 mb-6">
                    CAMPUS CARE is the development team behind the Campus Facility Reporting and Maintenance Management
                    System, created with the mission to foster a campus environment that is safe, comfortable, and
                    conducive to learning.
                </p>
                <p class="text-lg text-gray-700 mb-6">
                    Our system is designed to simplify and streamline the facility issue reporting process for students,
                    lecturers, and administrative staff alike.
                </p>
                <ul class="list-disc list-inside text-left text-gray-700 max-w-2xl mx-auto mb-6 space-y-1">
                    <li>An accessible and user-friendly reporting platform.</li>
                    <li>A structured, documented, and efficient follow-up mechanism.</li>
                    <li>Priority repair recommendations powered by a Decision Support System (DSS).</li>
                    <li>Full transparency throughout the repair process—from initial report to technician resolution.
                    </li>
                </ul>
                <p class="text-lg text-gray-700 font-medium">
                    The name <strong>CAMPUS CARE</strong> represents our belief that a healthy campus is a shared
                    responsibility. Through the thoughtful use of technology, we aim to build a more responsive,
                    transparent, and collaborative campus environment for everyone.
                </p>
            </div>
        </section>

        <!-- Team Members -->
        <main class="flex-grow py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-4xl font-bold text-center text-blue-700 mb-12">The Team</h2>
                <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                    @php
                    $team = [
                    [ 'name' => 'Bayu', 'role' => 'Frontend Developer', 'desc' => 'Specialist in responsive and interactive interfaces', 'image' => 'bayu.jpg' ],
                    [ 'name' => 'Sherly', 'role' => 'Frontend Developer', 'desc' => 'Expert in UI/UX design and frontend systems', 'image' => 'sherly.jpg' ],
                    [ 'name' => 'Majid', 'role' => 'Backend Developer', 'desc' => 'Skilled in server-side logic and APIs', 'image' => 'majid.jpg' ],
                    [ 'name' => 'Tegar', 'role' => 'Backend Developer', 'desc' => 'Focused on database and system performance', 'image' => 'tegar.jpg' ]
                    ];
                    @endphp

                    @foreach ($team as $member)
                    <div class="bg-white border border-blue-100 rounded-xl shadow-md p-6 text-center hover:shadow-xl hover:border-blue-300 transition duration-300">
                        @if(file_exists(public_path('image/' . $member['image'])))
                        <img src="{{ asset('image/' . $member['image']) }}" alt="{{ $member['name'] }}"
                            class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-2 border-blue-200" />
                        @else
                        <img src="{{ asset('image/logocampus.png') }}" alt="{{ $member['name'] }}"
                            class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-2 border-blue-200" />
                        @endif
                        <h3 class="text-xl font-semibold text-blue-700 mb-1">{{ $member['name'] }}</h3>
                        <p class="text-blue-500 font-medium mb-2">{{ $member['role'] }}</p>
                        <p class="text-sm text-gray-600">{{ $member['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t mt-12">
            <div class="max-w-7xl mx-auto px-6 py-4 text-center text-gray-500 text-sm">
                © 2024 <span class="font-semibold text-blue-600">Campus Care</span>. All rights reserved.
            </div>
        </footer>
    </div>
</body>

</html>