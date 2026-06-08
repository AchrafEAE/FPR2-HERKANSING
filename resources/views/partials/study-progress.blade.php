@php
$studyProgress = $studyProgress ?? config('portfolio.study_progress');
$totalEc = $studyProgress['total_ec'] ?? 60;
@endphp

<section class="study-progress feature-card text-left">
    <div class="study-progress__header">
        <div>
            <h2 class="study-progress__title">{{ $studyProgress['title'] }}</h2>
            <p class="study-progress__description">{{ $studyProgress['description'] }}</p>
        </div>
    </div>

    <div class="study-progress__table-wrap">
        <table class="schema">
            <tr style="background-color: white;">
                <th>Quarter</th>
                <th>Course</th>
                <th>Examens</th>
                <th>Behaalbare Studiepunten</th>
                <th>Behaalde Studiepunten</th>
            </tr>
            <tr class="completed">
                <td rowspan="3">Blok 1</td>
                <td>Program- &amp; Career Orientation</td>
                <td>Portfolio website presentation</td>
                <td>2.5 EC</td>
                <td><input type="text" id="pco" inputmode="decimal" placeholder="0"></td>
            </tr>
            <tr class="completed">
                <td>Computer Science Basics</td>
                <td>Written Exam</td>
                <td>5 EC</td>
                <td><input type="text" id="cs" inputmode="decimal" placeholder="0"></td>
            </tr>
            <tr class="completed">
                <td>Programming Basics</td>
                <td>Practical Assignment</td>
                <td>5 EC</td>
                <td><input type="text" id="pb" inputmode="decimal" placeholder="0"></td>
            </tr>
            <tr class="completed">
                <td rowspan="2">Blok 2</td>
                <td rowspan="2">Object Oriented Programming</td>
                <td>Presentation</td>
                <td>5 EC</td>
                <td><input type="text" id="OOP" inputmode="decimal" placeholder="0"></td>
            </tr>
            <tr class="completed">
                <td>Written Exam</td>
                <td>5 EC</td>
                <td><input type="text" id="WE" inputmode="decimal" placeholder="0"></td>
            </tr>
            <tr class="bezig">
                <td rowspan="4">Blok 3</td>
                <td>Business IT Consultancy Basics</td>
                <td>Individual Assignment</td>
                <td>2.5 EC</td>
                <td><input type="text" id="BICB" inputmode="decimal" placeholder="0"></td>
            </tr>
            <tr class="gefaald">
                <td rowspan="3">Framework Project 1</td>
                <td>Written Exams</td>
                <td>5 EC</td>
                <td><input type="text" id="FP1" inputmode="decimal" placeholder="0"></td>
            </tr>
            <tr class="completed">
                <td>Group Presentation</td>
                <td>2.5 EC</td>
                <td><input type="text" id="GP" inputmode="decimal" placeholder="0"></td>
            </tr>
            <tr class="completed">
                <td>Group Portfolio</td>
                <td>2.5 EC</td>
                <td><input type="text" id="GPo" inputmode="decimal" placeholder="0"></td>
            </tr>
            <tr class="bezig">
                <td rowspan="3">Blok 4</td>
                <td rowspan="3">Framework Project 2</td>
                <td>Presentation</td>
                <td>5 EC</td>
                <td><input type="text" id="FP2" inputmode="decimal" placeholder="0"></td>
            </tr>
            <tr class="bezig">
                <td>Individual featues</td>
                <td>2.5 EC</td>
                <td><input type="text" id="Po" inputmode="decimal" placeholder="0"></td>
            </tr>
            <tr class="bezig">
                <td>IT Development Portfolio.</td>
                <td>2.5 EC</td>
                <td><input type="text" id="IDPo" inputmode="decimal" placeholder="0"></td>
            </tr>
            <tr class="bezig">
                <td rowspan="2">Heel het jaar</td>
                <td>IT Personality</td>
                <td>Portfolio's</td>
                <td>2.5 EC</td>
                <td><input type="text" id="IP" inputmode="decimal" placeholder="0"></td>
            </tr>
            <tr class="completed">
                <td>Personal Professional Development: Exploration</td>
                <td>Portfolio</td>
                <td>12.5 EC</td>
                <td><input type="text" id="PPD" inputmode="decimal" placeholder="0"></td>
            </tr>
            <tr id="totaal-box" style="background-color: white;">
                <td><strong>Totaal</strong></td>
                <td>---</td>
                <td>---</td>
                <td>{{ $totalEc }} EC</td>
                <td id="total">0 EC</td>
            </tr>
        </table>
    </div>

    <div class="progress-bar-container">
        <div id="progressBar" class="progress-bar"></div>
        <div id="progressText" class="progress-text">0 / {{ $totalEc }} EC</div>
    </div>

    <div class="color-container">
        <ul>
            <li><span class="color-box" style="background-color: yellow;"></span> In Progressie</li>
            <li><span class="color-box" style="background-color: lightgray;"></span> Nog niet gestart</li>
            <li><span class="color-box" style="background-color: lightgreen;"></span> Afgerond</li>
        </ul>
    </div>
</section>

<script>
    (() => {
        const studyProgress = document.querySelector('.study-progress');

        if (!studyProgress) {
            return;
        }

        const totalMax = Number(@json($totalEc));
        const inputs = studyProgress.querySelectorAll('input[type="text"]');
        const totalText = studyProgress.querySelector('#total');
        const progressBar = studyProgress.querySelector('#progressBar');
        const progressText = studyProgress.querySelector('#progressText');

        function saveInputs() {
            inputs.forEach((input) => {
                localStorage.setItem(input.id, input.value);
            });
        }

        function loadInputs() {
            inputs.forEach((input) => {
                const savedValue = localStorage.getItem(input.id);

                if (savedValue !== null) {
                    input.value = savedValue;
                }
            });
        }

        function calculateTotal() {
            let total = 0;

            inputs.forEach((input) => {
                const value = input.value.trim();

                if (!value) {
                    return;
                }

                const ec = Number(value.replace(' EC', ''));

                if (!Number.isNaN(ec)) {
                    total += ec;
                }
            });

            totalText.textContent = `${total} EC`;

            const percentage = totalMax > 0 ? Math.min((total / totalMax) * 100, 100) : 0;
            progressBar.style.width = `${percentage}%`;
            progressBar.style.backgroundColor = total >= 45 ? 'green' : 'red';
            progressText.textContent = `${total} / ${totalMax} EC`;
        }

        inputs.forEach((input) => {
            input.addEventListener('input', () => {
                calculateTotal();
                saveInputs();
            });
        });

        loadInputs();
        calculateTotal();
    })();
</script>