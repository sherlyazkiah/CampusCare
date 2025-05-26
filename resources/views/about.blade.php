<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Campus Care - About</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-green-600 via-emerald-400 to-teal-300 text-white min-h-screen flex flex-col">

    <!-- Header -->
    <nav class="bg-white/20 backdrop-blur-sm fixed w-full top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-end items-center">
            <a href="{{ route('user.dashboard') }}"
                class="bg-white text-gray-700 hover:bg-gray-100 font-semibold px-4 py-2 rounded-full shadow transition duration-300">
                ← Back
            </a>
        </div>
    </nav>

    <!-- Spacer so content doesn't hide behind fixed navbar -->
    <div class="h-20"></div>

    <!-- Hero Section -->
    <section class="w-full py-5 px-6 flex flex-col items-center justify-center max-w-6xl mx-auto text-center">
        <div class="flex flex-col md:flex-row items-center space-x-0 md:space-x-6 space-y-6 md:space-y-0">
            <img src="{{ asset('image/logoc.png') }}" alt="Logo" class="h-28 w-28 md:h-36 md:w-36" />
            <span class="text-4xl md:text-5xl font-extrabold text-emerald-900 drop-shadow-lg">Campus Care</span>
        </div>
        <h1 class="text-3xl md:text-0xl font-extrabold text-emerald-800 drop-shadow-lg leading-snug">
            For Help You to Make Your Campus Comfortable
        </h1>
    </section>

    <!-- Main Content -->
    <main class="flex-grow w-full px-6">
        <article
            class="bg-white/20 backdrop-blur-md rounded-3xl shadow-lg p-8 md:p-14 max-w-6xl mx-auto text-gray-900 dark:text-white">

            <h2 class="text-4xl font-extrabold mb-6 text-gray-700 drop-shadow-sm">CAMPUS CARE: Building a Responsive and Caring Campus</h2>
            <p class="text-sm text-gray-500 mb-8">Posted by Team Campus Care • 2025</p>

            <!-- Our Philosophy -->
            <section class="mb-12 bg-white/50 rounded-xl p-8 shadow-inner border border-gray-300">
                <h3 class="text-3xl font-semibold text-gray-700 mb-4">Our Philosophy</h3>
                <p class="mb-5 text-gray-800">
                    <strong>CAMPUS CARE</strong> is more than just a team name — it’s a philosophy. We believe that a clean,
                    functional, and responsive campus supports academic success and a better quality of life for all students and staff.
                </p>
                <p class="mb-5 text-gray-800">
                    Our initiative encourages everyone to see facility reporting as an act of responsibility — not a hassle.
                </p>
                <div class="bg-white border-l-4 border-gray-400 p-5 rounded-md mb-8 shadow-sm">
                    <p class="font-semibold text-gray-700 mb-3 text-lg">CARE Principles:</p>
                    <ul class="list-disc list-inside space-y-2 text-gray-700 text-base">
                        <li><strong>C – Collaborate:</strong> We partner across departments and stakeholders.</li>
                        <li><strong>A – Act:</strong> We respond with speed and care.</li>
                        <li><strong>R – Respond:</strong> We document, structure, and solve.</li>
                        <li><strong>E – Enhance:</strong> We constantly improve through technology.</li>
                    </ul>
                </div>
                <p class="italic text-gray-600 text-lg text-center">“A caring campus is a thriving campus.”</p>
            </section>

            <!-- What We Do -->
            <section class="mb-12 bg-white/50 rounded-xl p-8 shadow-inner border border-gray-200">
                <h3 class="text-3xl font-semibold text-gray-700 mb-5">What We Do</h3>
                <p class="mb-5 text-gray-800 text-lg leading-relaxed">
                    We are the development team behind the Campus Facility Reporting and Maintenance System. Our mission is to
                    create a smart, efficient, and transparent platform for students and staff to report campus infrastructure issues.
                </p>
                <ul class="list-disc list-inside text-gray-700 space-y-2 text-base mb-6">
                    <li>User-friendly interface for easy reporting</li>
                    <li>Track issues with complete documentation</li>
                    <li>Automated priority analysis using DSS (Decision Support System)</li>
                    <li>Seamless feedback and resolution updates</li>
                </ul>
                <p class="text-gray-800 text-lg">
                    We believe technology can empower communities — and our system is built to make campus care collaborative and continuous.
                </p>
            </section>

            <!-- Meet the Team -->
            <section
                class="bg-gradient-to-r from-gray-100 via-gray-200 to-gray-300 rounded-xl p-8 shadow-inner border border-gray-400">
                <h3 class="text-3xl font-semibold text-gray-700 mb-8 text-center">Meet the Team</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 max-w-5xl mx-auto">
                    @php
                    $team = [
                    ['name' => 'Bayu', 'role' => 'Frontend Developer', 'desc' => 'Builds responsive UIs and smooth user flows.', 'image' => 'bayu.jpg'],
                    ['name' => 'Sherly', 'role' => 'Frontend Developer', 'desc' => 'Designs intuitive interfaces with UX in mind.', 'image' => 'sherly.jpg'],
                    ['name' => 'Majid', 'role' => 'Backend Developer', 'desc' => 'Manages logic and data architecture.', 'image' => 'majid.jpg'],
                    ['name' => 'Tegar', 'role' => 'Backend Developer', 'desc' => 'Optimizes database and server efficiency.', 'image' => 'tegar.jpg']
                    ];
                    @endphp

                    @php
                    $fallbackImage = asset('image/logocampus.png');
                    @endphp

                    @foreach ($team as $member)
                    <div
                        class="bg-white rounded-xl p-6 flex flex-col items-center text-center shadow-md hover:shadow-lg transition transform hover:-translate-y-1">
                        <img src="{{ asset('image/' . $member['image']) }}"
                            onerror="this.onerror=null;this.src='{{ $fallbackImage }}';"
                            alt="{{ $member['name'] }}"
                            class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow mb-4" />
                        <h4 class="font-semibold text-gray-800 text-xl">{{ $member['name'] }}</h4>
                        <span class="text-sm text-gray-600 mb-3">{{ $member['role'] }}</span>
                        <p class="text-gray-600 text-sm">{{ $member['desc'] }}</p>
                    </div>
                    @endforeach

                </div>
            </section>
        </article>
    </main>

    <!-- Footer -->
    <footer
        class="bg-white/90 text-gray-600 border-t border-gray-300 py-6 text-center text-sm shadow-inner mt-auto select-none">
        &copy; 2025 Campus Care. All rights reserved.
    </footer>

</body>

</html>