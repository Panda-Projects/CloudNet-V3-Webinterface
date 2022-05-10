<?php

use App\Helper\urlHelper;

?>
<main class="w-full flex-grow p-6">
    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <h6 class="mb-4 font-semibold dark:text-white text-gray-900">Console
                    for <?= $service['configuration']['serviceId']['taskName'] . "-" . $service['configuration']['serviceId']['taskServiceId'] ?></h6>
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-1">
                    <!-- Command input -->
                    <div class="w-full">
                        <div class="coding inverse-toggle px-5 pt-4 shadow-lg text-gray-100 dark:bg-gray-800 bg-white pb-6 pt-4 rounded-lg leading-normal overflow-hidden">
                            <form method="post">
                                <input name="action" value="sendCommand" type="hidden">
                                <input name="csrf" value="<?= $_SESSION['csrf'] ?>" type="hidden">
                                <div class="top mb-2 flex">
                                    <h4 class="mb-2 font-semibold dark:text-white text-gray-900">Send command</h4>
                                </div>
                                <div class="flex-1 flex flex-col md:flex-row text-sm font-mono subpixel-antialiased">
                                    <div class="w-full flex-1 mx-2">
                                        <input placeholder="Command"
                                               id="command-input"
                                               name="command"
                                               class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600">
                                    </div>
                                </div>
                                <button type="button"
                                        id="execute-command"
                                        class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                    Execute
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Create text output node -->
                    <div class="w-full">
                        <div class="coding inverse-toggle px-5 pt-4 shadow-lg text-gray-100 dark:bg-gray-800 bg-white pb-6 pt-4 rounded-lg leading-normal overflow-hidden">
                            <div id="socket_event"></div>

                            <?php
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => urlHelper::provideUrl("services/" . $service_name . "/log"),
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 5,
                                CURLOPT_CUSTOMREQUEST => 'GET',
                                CURLOPT_POSTFIELDS => '',
                                CURLOPT_HTTPHEADER => array(
                                    'Accept: application/json',
                                    'Authorization: Basic ' . $_SESSION['cn3-wi-access_token'],
                                    'Cookie: ' . $_SESSION["cn3-wi-cookie"]
                                ),
                            ));

                            $response = curl_exec($curl);
                            curl_close($curl);

                            $newlines = preg_split("/\r\n|\n|\r/", $response);

                            foreach ($newlines as $newline) {
                                echo '<div class="dark:text-gray-200 text-gray-800 text-sm">' . $newline . '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</main>