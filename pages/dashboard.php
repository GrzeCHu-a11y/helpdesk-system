<?php

declare(strict_types=1);

$ticketsResolved = [
    'Monday' => 5,
    'Tuesday' => 8,
    'Wednesday' => 6,
    'Thursday' => 7,
    'Friday' => 4,
];

$issueTypes = [
    'Network Issues' => 30,
    'Hardware Failures' => 15,
    'Software Bugs' => 25,
    'User Errors' => 10,
    'Other' => 20,
];

$ticketsDataJson = json_encode(array_values($ticketsResolved));
$ticketsLabelsJson = json_encode(array_keys($ticketsResolved));
$issueDataJson = json_encode(array_values($issueTypes));
$issueLabelsJson = json_encode(array_keys($issueTypes));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <section>
        <h2>Panel</h2><span><?php echo $_SESSION["username"] ?></span>
        <br><br>

        <div class="parent">
            <div class="div1">
                <h6>Rozwiązane tickety</h6>
                <p>67</p>
            </div>
            <div class="div2">
                <h6>Rozwiązane tickety</h6>
                <p>67</p>
            </div>
            <div class="div3">
                <h6>Rozwiązane tickety</h6>
                <p>67</p>
            </div>
            <div class="div4">
                <h6>Rozwiązane tickety</h6>
                <p>67</p>
            </div>

            <div class="div5">
                <div class="chart-container">
                    <h6 class="text-center">Rozwiązane Tickety w Tygodniu</h6>
                    <canvas id="ticketsChart"></canvas>
                </div>
            </div>
            <div class="div6">
                <div class="chart-container">
                    <h6 class="text-center">Najczęstsze Usterki</h6>
                    <canvas id="issuesChart"></canvas>
                </div>
            </div>
        </div>

    </section>
    <script>
        const ticketsData = <?php echo $ticketsDataJson; ?>;
        const ticketsLabels = <?php echo $ticketsLabelsJson; ?>;
        const issueData = <?php echo $issueDataJson; ?>;
        const issueLabels = <?php echo $issueLabelsJson; ?>;

        // Konfiguracja wykresu słupkowego
        const ticketsCtx = document.getElementById('ticketsChart').getContext('2d');
        const ticketsChart = new Chart(ticketsCtx, {
            type: 'bar',
            data: {
                labels: ticketsLabels,
                datasets: [{
                    label: 'Rozwiązane Tickety',
                    data: ticketsData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Konfiguracja wykresu radarowego
        const issuesCtx = document.getElementById('issuesChart').getContext('2d');
        const issuesChart = new Chart(issuesCtx, {
            type: 'radar',
            data: {
                labels: issueLabels,
                datasets: [{
                    label: 'Najczęstsze Usterki',
                    data: issueData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.raw;
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>