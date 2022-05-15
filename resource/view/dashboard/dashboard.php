<?php

use App\Helper\urlHelper;

$nodes = urlHelper::buildDefaultRequest("cluster", "GET");

$rrdata = urlHelper::buildDefaultRequest("rrdata", "GET");

$services = 0;

$connectedNodeCount = 0;
$totalNodeCount = 0;
if (isset($nodes['nodes'])) {
    $totalNodeCount = sizeof($nodes['nodes']);
}

$memory_min = 0;
$memory_max = 0;

$cpu_used = 0;
$cpu_max = 0;

foreach ($nodes as $node) {

    $connectedNodeCount++;

    $services += $node['nodeInfoSnapshot']['currentServicesCount'];

    $memory_max += $node['nodeInfoSnapshot']['maxMemory'];
    $memory_min += $node['nodeInfoSnapshot']['usedMemory'];

    $cpu_max += 100;
    $cpu_used += min(round($node['nodeInfoSnapshot']['systemCpuUsage']), 100);
}
?>

<main class="w-full flex-grow p-6">
    <div class="py-1">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                    <!--Users-->
                    <div class="flex items-center p-4 dark:bg-gray-800 bg-white rounded-lg shadow-lg">
                        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                            <img src="assets/icons/cluster.png"/>
                        </div>
                        <div>
                            <p class="mb-2 text-base font-medium text-gray-400">Nodes</p>
                            <p class="text-xl font-semibold dark:text-white text-gray-900"><?= $connectedNodeCount ?>
                        </div>
                    </div>
                    <!-- Servers -->
                    <div class="flex items-center p-4 dark:bg-gray-800 bg-white rounded-lg shadow-lg">
                        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                            <img src="assets/icons/server.svg"/>
                        </div>
                        <div>
                            <p class="mb-2 text-base font-medium text-gray-400">Service count</p>
                            <p class="text-xl font-semibold dark:text-white text-gray-900"><?= $services ?></p>
                        </div>
                    </div>
                    <!-- CPU -->
                    <div class="flex items-center p-4 dark:bg-gray-800 bg-white rounded-lg shadow-lg">
                        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                            <img src="assets/icons/cpu.svg"/>
                        </div>
                        <div>
                            <p class="mb-2 text-base font-medium text-gray-400">CPU</p>
                            <p class="text-xl font-semibold dark:text-white text-gray-900"><?= $cpu_used ?>
                                %/<?= $cpu_max; ?>%</p>
                        </div>
                    </div>
                    <!-- Ram -->
                    <div class="flex items-center p-4 dark:bg-gray-800 bg-white rounded-lg shadow-lg">
                        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                            <img src="assets/icons/ram.svg"/>
                        </div>
                        <div>
                            <p class="mb-2 text-base font-medium text-gray-400">Ram</p>
                            <p class="text-xl font-semibold dark:text-white text-gray-900"><?= $memory_min ?>
                                MB/<?= $memory_max; ?>MB</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-2">
                    <!-- Ram Usage -->
                    <div class="min-w-0 p-4 dark:bg-gray-800 bg-white rounded-lg shadow-lg">
                        <h4 class="mb-4 font-semibold dark:text-white text-gray-900">Ram Usage</h4>
                        <canvas id="ram" width="350" height="100"></canvas>
                        <div class="flex justify-center mt-4 space-x-3 text-sm dark:text-white text-gray-900">
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 bg-green-600 rounded-full"></span>
                                <span>Usage in MB</span>
                            </div>
                        </div>
                    </div>
                    <!-- CPU Usage -->
                    <div class="min-w-0 p-4 dark:bg-gray-800 bg-white rounded-lg shadow-lg">
                        <h4 class="mb-4 font-semibold dark:text-white text-gray-900">CPU Usage</h4>
                        <canvas id="cpu" width="350" height="100"></canvas>
                        <div class="flex justify-center mt-4 space-x-3 text-sm dark:text-white text-gray-900">
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 bg-blue-600 rounded-full"></span>
                                <span>Usage in %</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-2">
                    <!-- Stats -->
                    <div class="w-full">
                        <div class="coding inverse-toggle px-5 pt-4 shadow-lg dark:text-gray-100 text-gray-900 text-sm font-mono subpixel-antialiased dark:bg-gray-800 bg-white pb-6 pt-4 rounded-lg leading-normal overflow-hidden">
                            <div class="top mb-2 flex">
                                <div class="h-3 w-3 bg-red-500 rounded-full"></div>
                                <div class="ml-2 h-3 w-3 bg-yellow-300 rounded-full"></div>
                                <div class="ml-2 h-3 w-3 bg-green-500 rounded-full"></div>
                            </div>
                            <div class="mt-4 flex">
                                <span class="text-green-400">cloudnet:~$</span>
                                <p class="flex-1 typing items-center pl-2">Registered: 6482<br></p>
                                <img class="justify-items-end" src="assets/icons/pen.svg"/>
                            </div>
                            <div class="flex">
                                <span class="text-green-400">cloudnet:~$</span>
                                <p class="flex-1 typing items-center pl-2">Highest OnlineCount: 157<br></p>
                                <img class="justify-items-end" src="assets/icons/pen.svg"/>
                            </div>
                            <div class="flex">
                                <span class="text-green-400">cloudnet:~$</span>
                                <p class="flex-1 typing items-center pl-2">Logins: 102372<br></p>
                                <img class="justify-items-end" src="assets/icons/pen.svg"/>
                            </div>
                            <div class="flex">
                                <span class="text-green-400">cloudnet:~$</span>
                                <p class="flex-1 typing items-center pl-2">Command Executions: 345272<br></p>
                                <img class="justify-items-end" src="assets/icons/pen.svg"/>
                            </div>
                        </div>
                    </div>
                    <?php if ($update->isNewVersionAvailable()) {
                    if ($update->wantsForceUpdate()) {
                        $update->installFiles();
                        $update->updateVersion();
                    }
                    ?>
                    <div class="min-w-0 p-4 text-white bg-gradient-to-br from-red-600 to-red-800 rounded-lg shadow-xs">
                        <h4 class="mb-4 font-bold">Update available!</h4>
                        <p>
                            Currently you are using an outdated CloudNet Webinterface
                            version <?= $update->getCurrentVersion() ?>!
                            The latest version is the <?= $update->getRemoteVersion() ?>
                        </p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </main>
    </div>
</main>
<?php

$cpuarraydata = "";
$cpuarrayvalue = "";
foreach ($rrdata["cpu"] as $cpu) {
    $cpuarraydata = $cpuarraydata . "'" . date("h:i", (intval($cpu["time"]) / 1000)) . "',";
    $cpuarrayvalue = $cpuarrayvalue . intval($cpu["cpu"]) . ",";
}

$memoryarraydata = "";
$memoryarrayvalue = "";
foreach ($rrdata["memory"] as $memory) {
    $memoryarraydata = $memoryarraydata . "'" . date("h:i", (intval($memory["time"]) / 1000)) . "',";
    $memoryarrayvalue = $memoryarrayvalue . $memory["memory"] . ",";
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    const linecpuConfig = {
        type: 'line',
        data: {
            labels: [<?= $cpuarraydata ?>],
            datasets: [
                {
                    label: 'Usage in %',
                    backgroundColor: '#5b96f7',
                    borderColor: '#5b96f7',
                    data: [<?= $cpuarrayvalue ?>],
                    fill: false,
                }
            ],
        },
        options: {
            responsive: true,
            legend: {
                display: false,
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true,
            },
            scales: {
                x: {
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value',
                    },
                },
                y: {
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value',
                    },
                },
            },
        },
    }

    const lineId = document.getElementById('cpu')
    if (lineId !== null) {
        window.myLine = new Chart(lineId, linecpuConfig)
    }

    const lineConfig = {
        type: 'line',
        data: {
            labels: [<?= $memoryarraydata ?>],
            datasets: [
                {
                    label: 'Usage in MB',
                    backgroundColor: '#10b981',
                    borderColor: '#10b981',
                    data: [<?= $memoryarrayvalue ?>],
                    fill: false,
                }
            ],
        },
        options: {
            responsive: true,
            legend: {
                display: false,
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true,
            },
            scales: {
                x: {
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value',
                    },
                },
                y: {
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value',
                    },
                },
            },
        },
    }

    const lineCtx = document.getElementById('ram')
    if (lineCtx !== null) {
        window.myLine = new Chart(lineCtx, lineConfig)
    }
</script>
