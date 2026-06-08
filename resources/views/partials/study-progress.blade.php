@php
$studyProgress = $studyProgress ?? config('portfolio.study_progress');
$totalEc = $studyProgress['total_ec'] ?? 60;
$studyResults = $studyResults ?? [];
@endphp

<section class="study-progress feature-card text-left"
    @if($isOwner ?? false)
        data-save-url="{{ route('study-results.store') }}"
        data-csrf="{{ csrf_token() }}"
    @endif
>
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
                <td><input type="text" id="pco" name="study_results[pco]" value="{{ $studyResults['pco'] ?? '' }}"></td>
            </tr>
            <tr class="completed">
                <td>Computer Science Basics</td>
                <td>Written Exam</td>
                <td>5 EC</td>
                <td><input type="text" id="cs" name="study_results[cs]" value="{{ $studyResults['cs'] ?? '' }}"></td>
            </tr>
            <tr class="completed">
                <td>Programming Basics</td>
                <td>Practical Assignment</td>
                <td>5 EC</td>
                <td><input type="text" id="pb" name="study_results[pb]" value="{{ $studyResults['pb'] ?? '' }}"></td>
            </tr>
            <tr class="completed">
                <td rowspan="2">Blok 2</td>
                <td rowspan="2">Object Oriented Programming</td>
                <td>Presentation</td>
                <td>5 EC</td>
                <td><input type="text" id="OOP" name="study_results[OOP]" value="{{ $studyResults['OOP'] ?? '' }}"></td>
            </tr>
            <tr class="completed">
                <td>Written Exam</td>
                <td>5 EC</td>
                <td><input type="text" id="WE" name="study_results[WE]" value="{{ $studyResults['WE'] ?? '' }}"></td>
            </tr>
            <tr class="bezig">
                <td rowspan="4">Blok 3</td>
                <td>Business IT Consultancy Basics</td>
                <td>Individual Assignment</td>
                <td>2.5 EC</td>
                <td><input type="text" id="BICB" name="study_results[BICB]" value="{{ $studyResults['BICB'] ?? '' }}"></td>
            </tr>
            <tr class="gefaald">
                <td rowspan="3">Framework Project 1</td>
                <td>Written Exams</td>
                <td>5 EC</td>
                <td><input type="text" id="FP1" name="study_results[FP1]" value="{{ $studyResults['FP1'] ?? '' }}"></td>
            </tr>
            <tr class="completed">
                <td>Group Presentation</td>
                <td>2.5 EC</td>
                <td><input type="text" id="GP" name="study_results[GP]" value="{{ $studyResults['GP'] ?? '' }}"></td>
            </tr>
            <tr class="completed">
                <td>Group Portfolio</td>
                <td>2.5 EC</td>
                <td><input type="text" id="GPo" name="study_results[GPo]" value="{{ $studyResults['GPo'] ?? '' }}"></td>
            </tr>
            <tr class="bezig">
                <td rowspan="3">Blok 4</td>
                <td rowspan="3">Framework Project 2</td>
                <td>Presentation</td>
                <td>2.5 EC</td>
                <td><input type="text" id="FP2" name="study_results[FP2]" value="{{ $studyResults['FP2'] ?? '' }}"></td>
            </tr>
            <tr class="bezig">
                <td>Individual featues</td>
                <td>2.5 EC</td>
                <td><input type="text" id="Po" name="study_results[Po]" value="{{ $studyResults['Po'] ?? '' }}"></td>
            </tr>
            <tr class="bezig">
                <td>IT Development Portfolio.</td>
                <td>5 EC</td>
                <td><input type="text" id="IDPo" name="study_results[IDPo]" value="{{ $studyResults['IDPo'] ?? '' }}"></td>
            </tr>
            <tr class="bezig">
                <td rowspan="2">Heel het jaar</td>
                <td>IT Personality</td>
                <td>Portfolio's</td>
                <td>2.5 EC</td>
                <td><input type="text" id="IP" name="study_results[IP]" value="{{ $studyResults['IP'] ?? '' }}"></td>
            </tr>
            <tr class="completed">
                <td>Personal Professional Development: Exploration</td>
                <td>Portfolio</td>
                <td>12.5 EC</td>
                <td><input type="text" id="PPD" name="study_results[PPD]" value="{{ $studyResults['PPD'] ?? '' }}"></td>
            </tr>
            <tr id="totaal-box" style="background-color: white;">
                <td><strong>Totaal</strong></td>
                <td>---</td>
                <td>---</td>
                <td>60 EC</td>
                <td id="total"></td>
            </tr>
        </table>
    </div>

    <div class="progress-bar-container">
        <div id="progressBar" class="progress-bar"></div>
        <div id="progressText" class="progress-text">0 / {{ $totalEc }} EC</div>
    </div>

    <div id="save-status" style="margin-top: 10px; font-size: 0.9em; height: 1.2em;"></div>
</section>

<script>
    (() => {
        const studyProgress = document.querySelector('.study-progress');

        if (!studyProgress) {
            return;
        }

        const saveUrl = studyProgress.dataset.saveUrl;
        const csrfToken = studyProgress.dataset.csrf;
        const totalMax = Number(@json($totalEc));
        const inputs = studyProgress.querySelectorAll('input[type="text"]');
        const totalText = studyProgress.querySelector('#total');
        const progressBar = studyProgress.querySelector('#progressBar');
        const progressText = studyProgress.querySelector('#progressText');
        const saveStatus = studyProgress.querySelector('#save-status');

        let saveTimeout = null;

        function saveToServer(courseCode, value) {
            saveStatus.textContent = 'Opslaan...';
            saveStatus.style.color = 'gray';

            fetch(saveUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    course_code: courseCode,
                    earned_ec: value
                })
            })
            .then(response => {
                if (!response.ok) throw new Error('Netwerkrespons was niet ok');
                return response.json();
            })
            .then(data => {
                saveStatus.textContent = 'Opgeslagen in database';
                saveStatus.style.color = 'green';
                setTimeout(() => {
                    if (saveStatus.textContent === 'Opgeslagen in database') {
                        saveStatus.textContent = '';
                    }
                }, 2000);
            })
            .catch(error => {
                console.error('Error:', error);
                saveStatus.textContent = 'Fout bij opslaan!';
                saveStatus.style.color = 'red';
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

                if (!saveUrl) return;

                if (saveTimeout) clearTimeout(saveTimeout);

                saveTimeout = setTimeout(() => {
                    saveToServer(input.id, input.value);
                }, 1000);
            });
        });

        calculateTotal();
    })();
</script>
