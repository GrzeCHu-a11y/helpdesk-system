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
        <h2>Panel</h2><span><?php echo $_SESSION["USER_DATA"]["username"] ?></span>
        <br><br>

        <div class="parent">
            <div class="div1">
                <h6>Aktywne zgłoszenia</h6>
                <p><?php echo $viewParams["numOfAllTickets"] ?></p>
            </div>
            <div class="div2">
                <h6>Zamknięte zgłoszenia</h6>
                <p><?php echo $viewParams["numOfClosedTickets"] ?></p>
            </div>
            <div class="div3">
                <h6>Średni czas roziwązywania zgłoszenia</h6>
                <p>00:00</p>
            </div>
            <div class="div4">
                <?php if (isset($_SESSION["PARAMS_FROM_WORK_FORM"])) : ?>
                    <h6>Zarejstrowano</h6>
                    <p> <?php echo $_SESSION["PARAMS_FROM_WORK_FORM"]["start"] ?></p>
                <?php elseif (!isset($_SESSION["PARAMS_FROM_WORK_FORM"])) : ?>
                    <h6>Zarejestruj czas pracy!</h6>
                    <p>00:00</p>
                <?php endif; ?>
            </div>

            <div class="div5">
                <div class="chart-container">
                    <h6 class="text-center">Priorytety Zgłoszeń</h6>
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
        const ticketsData = <?php echo $viewParams["ticketPriorityData"]["values"]; ?>;
        const ticketsLabels = <?php echo $viewParams["ticketPriorityData"]["labels"]; ?>;
        const issueData = <?php echo $viewParams["ticketIssuesData"]['values']; ?>;
        const issueLabels = <?php echo $viewParams["ticketIssuesData"]['labels']; ?>;

        // Konfiguracja wykresu słupkowego
        const ticketsCtx = document.getElementById('ticketsChart').getContext('2d');
        const ticketsChart = new Chart(ticketsCtx, {
            type: 'bar',
            data: {
                labels: ticketsLabels,
                datasets: [{
                    label: 'Priorytety Zgłoszeń',
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