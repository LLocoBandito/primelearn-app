<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IT Interest & Talent Test | PRIME LEARN</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Base Styles */
        body {
            background: #f7f9fc;
            font-family: system-ui, -apple-system, sans-serif;
            color: #1f2937;
            min-height: 100vh;
        }

        /* Question Card */
        .question-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            padding: 2.5rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .question-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Choice Options */
        .choice {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px 20px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #ffffff;
            font-size: 1.125rem;
        }

        .choice:hover {
            border-color: #3b82f6;
            background: #eff6ff;
            transform: translateX(4px);
        }

        input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        input[type="radio"]:checked + .choice {
            border-color: #2563eb;
            background: #dbeafe;
            font-weight: 500;
        }

        /* Progress Bar */
        .progress {
            height: 8px;
            background: #e5e7eb;
            border-radius: 999px;
            overflow: hidden;
            margin-bottom: 3rem;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(to right, #3b82f6, #2563eb);
            width: 0%;
            transition: width 0.4s ease;
        }

        /* Buttons */
        .btn {
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-prev {
            background: #f3f4f6;
            color: #4b5563;
        }

        .btn-next {
            background: #2563eb;
            color: white;
        }

        .btn-submit {
            background: #16a34a;
            color: white;
        }
    </style>
</head>
<body class="text-gray-800">

    <section class="max-w-3xl mx-auto py-16 px-6">
        <header class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">IT Interest & Talent Test</h1>
            <p class="text-lg text-gray-600">Answer each question honestly to discover your ideal career path in Information Technology</p>
        </header>

        <div class="progress">
            <div id="bar" class="progress-bar"></div>
        </div>

        <form id="form" method="POST" action="{{ route('peminatan.store') }}">
            @csrf
            
            <div class="step">
                <div class="question-card">
                    <span class="text-sm font-medium text-blue-600">Software Developer (1/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        1. I enjoy the process of building logic / efficient algorithms to solve problems.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q1_dev" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q1_dev" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q1_dev" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q1_dev" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-blue-600">Software Developer (2/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        2. I don't mind spending hours debugging and solving one very difficult coding problem.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q2_dev" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q2_dev" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q2_dev" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q2_dev" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-blue-600">Software Developer (3/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        3. I am interested in learning Data Structures (e.g., linked list, tree) and algorithm efficiency (Big O notation).
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q3_dev" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q3_dev" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q3_dev" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q3_dev" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-blue-600">Software Developer (4/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        4. I am interested in Object-Oriented Programming (OOP) concepts like Classes, Inheritance, and Polymorphism.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q4_dev" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q4_dev" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q4_dev" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q4_dev" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-blue-600">Software Developer (5/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        5. I prefer building behind-the-scenes functionality (**backend**) rather than the visual interface (**frontend**) of an application.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q5_dev" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q5_dev" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q5_dev" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q5_dev" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>
            
            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-green-600">Network & Security (1/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        6. I am interested in understanding how networks, servers, and IT Infrastructure work.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q6_net" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q6_net" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q6_net" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q6_net" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-green-600">Network & Security (2/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        7. I am curious about how to protect systems and data from cyber attacks (hacking and malware).
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q7_net" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q7_net" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q7_net" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q7_net" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-green-600">Network & Security (3/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        8. I enjoy configuring, managing, and maintaining server operating systems (such as Linux or Windows Server).
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q8_net" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q8_net" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q8_net" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q8_net" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-green-600">Network & Security (4/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        9. I am interested in learning advanced network protocols (Deep TCP/IP) and firewall/VPN concepts.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q9_net" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q9_net" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q9_net" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q9_net" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-green-600">Network & Security (5/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        10. I am interested in exploring security vulnerabilities and performing ethical penetration testing.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q10_net" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q10_net" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q10_net" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q10_net" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>
            
            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-red-600">Data & AI (1/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        11. I am interested in Artificial Intelligence (AI), Machine Learning, and how predictive models function.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q11_data" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q11_data" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q11_data" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q11_data" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-red-600">Data & AI (2/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        12. I enjoy analyzing patterns, trends, and statistics from large datasets.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q12_data" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q12_data" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q12_data" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q12_data" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-red-600">Data & AI (3/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        13. I believe my math and statistics skills are good enough to be applied to data-driven problem solving.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q13_data" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q13_data" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q13_data" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q13_data" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-red-600">Data & AI (4/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        14. I enjoy presenting complex data through easy-to-understand charts or dashboards (data visualization).
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q14_data" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q14_data" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q14_data" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q14_data" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-red-600">Data & AI (5/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        15. I am interested in cloud computing technologies (AWS, Azure) for storing and processing big data.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q15_data" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q15_data" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q15_data" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q15_data" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-yellow-600">UI/UX (1/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        16. I care deeply about visual appearance and the ease of use (User Experience) of a digital product.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q16_uiux" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q16_uiux" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q16_uiux" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q16_uiux" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-yellow-600">UI/UX (2/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        17. I like creating prototypes, sketches, or wireframes for User Interface (UI) designs.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q17_uiux" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q17_uiux" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q17_uiux" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q17_uiux" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-yellow-600">UI/UX (3/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        18. I enjoy combining creativity with logic to create beautiful and functional digital solutions.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q18_uiux" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q18_uiux" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q18_uiux" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q18_uiux" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-yellow-600">UI/UX (4/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        19. I enjoy conducting user research (interviews, surveys) to identify user needs and pain points when using apps.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q19_uiux" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q19_uiux" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q19_uiux" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q19_uiux" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="step hidden">
                <div class="question-card">
                    <span class="text-sm font-medium text-yellow-600">UI/UX (5/5)</span>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-8 leading-relaxed">
                        20. I am more interested in creating intuitive user flows than writing complex code.
                    </h2>
                    <div class="space-y-4">
                        <label class="block"><input type="radio" name="q20_uiux" value="4" required><div class="choice">Strongly Agree</div></label>
                        <label class="block"><input type="radio" name="q20_uiux" value="3"><div class="choice">Agree</div></label>
                        <label class="block"><input type="radio" name="q20_uiux" value="2"><div class="choice">Somewhat Agree</div></label>
                        <label class="block"><input type="radio" name="q20_uiux" value="1"><div class="choice">Disagree</div></label>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mt-12">
                <button type="button" id="prev" class="btn btn-prev hidden">← Back</button>
                <div class="flex space-x-4">
                    <button type="button" id="next" class="btn btn-next" disabled>Next →</button>
                    <button type="submit" id="submit" class="btn btn-submit hidden" disabled>View Results</button>
                </div>
            </div>

        </form>
    </section>

    <script>
        const steps = document.querySelectorAll('.step');
        const bar = document.getElementById('bar');
        const prevBtn = document.getElementById('prev');
        const nextBtn = document.getElementById('next');
        const submitBtn = document.getElementById('submit');
        const form = document.getElementById('form');

        let currentStep = 0;
        const totalQuestions = steps.length;

        function updateProgress() {
            const progress = ((currentStep + 1) / totalQuestions) * 100;
            bar.style.width = progress + '%';
        }

        function showStep(n) {
            steps.forEach((step, i) => {
                step.classList.toggle('hidden', i !== n);
            });

            prevBtn.classList.toggle('hidden', n === 0);
            nextBtn.classList.toggle('hidden', n === steps.length - 1);
            submitBtn.classList.toggle('hidden', n !== steps.length - 1);

            updateProgress();
            checkAnswerAndToggleButtons(n);
        }

        function checkAnswerAndToggleButtons(stepIndex) {
            const hasAnswer = steps[stepIndex].querySelector('input[type=radio]:checked');
            
            if (stepIndex < steps.length - 1) {
                nextBtn.disabled = !hasAnswer;
                submitBtn.disabled = true;
            } else {
                nextBtn.disabled = true;
                submitBtn.disabled = !hasAnswer;
            }
        }

        nextBtn.onclick = () => {
            const selected = steps[currentStep].querySelector('input[type=radio]:checked');
            if (!selected) {
                alert('Please select an answer first.');
                return;
            }
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        };

        prevBtn.onclick = () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        };

        form.addEventListener('change', (e) => {
            if (e.target.type === 'radio' && e.target.closest('.step') === steps[currentStep]) {
                checkAnswerAndToggleButtons(currentStep);
            }
        });

        showStep(0);
    </script>

</body>
</html>