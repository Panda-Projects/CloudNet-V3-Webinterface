<?php

use App\Helper\urlHelper;

?>
<main class="w-full flex-grow p-6">
    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-1">
                    <div class="w-full">
                        <h6 class="mb-4 font-semibold dark:text-white text-gray-900"><?= $task['task']['name']; ?></h6>
                        <div class="coding inverse-toggle px-5 pt-4 shadow-lg text-gray-100 dark:bg-gray-800 bg-white pb-6 pt-4 rounded-lg leading-normal overflow-hidden">
                            <div class="top mb-2 flex">
                                <h4 class="mb-2 font-semibold dark:text-white text-gray-900">All services of
                                    task <?= $task['task']['name']; ?></h4>
                            </div>
                            <?php foreach ($services as $service) { ?>
                                <div class="flex-1 flex flex-col md:flex-row text-sm font-mono subpixel-antialiased">
                                    <li class="flex flex-row mb-2">
                                        <div class="w-full flex-3 mx-2">
                                            <div class="dark:bg-gray-900 bg-gray-100 rounded-md flex items-center p-4">
                                                <div class="flex flex-col rounded-md w-10 h-10 justify-center items-center mr-4">
                                                    <img src="/assets/icons/nether.gif"/></div>
                                                <div class="flex-1 pl-1 mr-16">
                                                    <div class="font-semibold dark:text-white text-gray-900"><?= $service['configuration']['serviceId']['taskName'] . "-" . $service['configuration']['serviceId']['taskServiceId'] ?>
                                                        on <?= $service['configuration']['serviceId']['nodeUniqueId'] ?>
                                                        | <?= $service['address']['host'] . ":" . $service['address']['port']; ?></div>
                                                    <?php if ($service['configuration']['processConfig']['environment'] == "MINECRAFT_SERVER") { ?>
                                                        <div class="dark:text-gray-200 text-gray-800 text-sm"><?= $service['properties'] != null ? $service['properties']['Motd'] : "" ?></div>
                                                        <div class="dark:text-gray-200 text-gray-800 text-sm">
                                                            Static: <?= ($service['configuration']['staticService']) ? "true" : "false"; ?>
                                                            |
                                                            AutoDeleteOnStop: <?= ($service['configuration']['autoDeleteOnStop']) ? "true" : "false"; ?>
                                                            |
                                                            Groups:
                                                            <?php
                                                            $groups = "";
                                                            foreach ($service['configuration']['groups'] as $group) {
                                                                $groups .= $group . ", ";
                                                            }
                                                            echo substr($groups, 0, -2);
                                                            ?> |
                                                            Environment: <?= $service['configuration']['processConfig']['environment'] ?>
                                                        </div>
                                                    <?php } else if ($service['configuration']['processConfig']['environment'] == "BUNGEECORD") { ?>
                                                        <div class="dark:text-gray-200 text-gray-800 text-sm"><?= $service['properties']['Version'] ?></div>
                                                        <div class="dark:text-gray-200 text-gray-800 text-sm">
                                                            Node: <?= $service['configuration']['serviceId']['nodeUniqueId'] ?>
                                                            |
                                                            Static: <?= ($service['configuration']['staticService']) ? "true" : "false"; ?>
                                                            |
                                                            AutoDeleteOnStop: <?= ($service['configuration']['autoDeleteOnStop']) ? "true" : "false"; ?>
                                                            |
                                                            Groups:
                                                            <?php
                                                            $groups = "";
                                                            foreach ($service['configuration']['groups'] as $group) {
                                                                $groups .= $group . ", ";
                                                            }
                                                            echo substr($groups, 0, -2);
                                                            ?> |
                                                            Environment: <?= $service['configuration']['processConfig']['environment'] ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="dark:text-gray-200 text-gray-800 text-xs"><?= ($service['properties'] != null ? $service['properties']['Online-Count'] : "0") . "/" . ($service['properties'] != null ? $service['properties']['Max-Players'] : "0") ?></div>

                                                <?php if ($service['lifeCycle'] == "RUNNING") { ?>
                                                    <div class="flex flex-col rounded-md w-4 h-4 justify-center items-center mx-3 mr-4">
                                                        <svg class="text-green-600" version="1.1" fill="currentColor"
                                                             id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                             viewBox="0 0 512.012 512.012"
                                                             style="enable-background:new 0 0 512.012 512.012;"
                                                             xml:space="preserve"><path fill-rule="evenodd"
                                                                                        d="M102.694,330.764c-5.664-2.624-12.32-1.696-17.088,2.368l-64,54.72c-3.552,3.04-5.6,7.488-5.6,12.16v96c0,8.832,7.168,16,16,16h64c8.832,0,16-7.168,16-16v-150.72C112.006,339.052,108.358,333.388,102.694,330.764z"/>
                                                            <path fill-rule="evenodd"
                                                                  d="M230.694,221.004c-5.632-2.624-12.32-1.696-17.088,2.368l-64,54.72c-3.552,3.04-5.6,7.488-5.6,12.16v205.76c0,8.832,7.168,16,16,16h64c8.832,0,16-7.168,16-16v-260.48C240.006,229.292,236.358,223.596,230.694,221.004z"/>
                                                            <path fill-rule="evenodd"
                                                                  d="M358.694,111.244c-5.664-2.624-12.32-1.696-17.088,2.368l-64,54.72c-3.552,3.04-5.6,7.488-5.6,12.16v315.52c0,8.832,7.168,16,16,16h64c8.832,0,16-7.168,16-16v-370.24C368.006,119.532,364.39,113.868,358.694,111.244z"/>
                                                            <path fill-rule="evenodd"
                                                                  d="M486.694,1.484c-5.632-2.624-12.352-1.728-17.088,2.368l-64,54.72c-3.552,3.04-5.6,7.488-5.6,12.16v425.28c0,8.832,7.168,16,16,16h64c8.832,0,16-7.168,16-16v-480C496.006,9.772,492.39,4.076,486.694,1.484z"/></svg>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="flex flex-col rounded-md w-4 h-4 justify-center items-center mx-3 mr-4">
                                                        <svg class="text-red-600" version="1.1" fill="currentColor"
                                                             id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                             viewBox="0 0 512.012 512.012"
                                                             style="enable-background:new 0 0 512.012 512.012;"
                                                             xml:space="preserve"><path fill-rule="evenodd"
                                                                                        d="M102.694,330.764c-5.664-2.624-12.32-1.696-17.088,2.368l-64,54.72c-3.552,3.04-5.6,7.488-5.6,12.16v96c0,8.832,7.168,16,16,16h64c8.832,0,16-7.168,16-16v-150.72C112.006,339.052,108.358,333.388,102.694,330.764z"/>
                                                            <path fill-rule="evenodd"
                                                                  d="M230.694,221.004c-5.632-2.624-12.32-1.696-17.088,2.368l-64,54.72c-3.552,3.04-5.6,7.488-5.6,12.16v205.76c0,8.832,7.168,16,16,16h64c8.832,0,16-7.168,16-16v-260.48C240.006,229.292,236.358,223.596,230.694,221.004z"/>
                                                            <path fill-rule="evenodd"
                                                                  d="M358.694,111.244c-5.664-2.624-12.32-1.696-17.088,2.368l-64,54.72c-3.552,3.04-5.6,7.488-5.6,12.16v315.52c0,8.832,7.168,16,16,16h64c8.832,0,16-7.168,16-16v-370.24C368.006,119.532,364.39,113.868,358.694,111.244z"/>
                                                            <path fill-rule="evenodd"
                                                                  d="M486.694,1.484c-5.632-2.624-12.352-1.728-17.088,2.368l-64,54.72c-3.552,3.04-5.6,7.488-5.6,12.16v425.28c0,8.832,7.168,16,16,16h64c8.832,0,16-7.168,16-16v-480C496.006,9.772,492.39,4.076,486.694,1.484z"/></svg>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php if ($service['lifeCycle'] == "RUNNING") { ?>
                                        <div class="flex items-center p-4">
                                            <a href="<?= urlHelper::get() . '/tasks/' . $task_name . '/' . $service['configuration']['serviceId']['uniqueId'] . '/console'; ?>"
                                               class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">Console</a>

                                            <form method="post">
                                                <input name="action" value="stopService" type="hidden">
                                                <input name="service_id" value="<?= $service['configuration']['serviceId']['uniqueId']; ?>" type="hidden">
                                                <input name="csrf" value="<?= $_SESSION['csrf'] ?>" type="hidden">
                                                <button type="submit"
                                                        class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                                    Stop
                                                </button>
                                            </form>
                                        </div>
                                    <?php } else { ?>
                                        <div class="flex items-center p-4">
                                            <form method="post">
                                                <input name="action" value="startService" type="hidden">
                                                <input name="service_id" value="<?= $service['configuration']['serviceId']['uniqueId']; ?>" type="hidden">
                                                <input name="csrf" value="<?= $_SESSION['csrf'] ?>" type="hidden">
                                                <button type="submit"
                                                        class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                                    Start
                                                </button>
                                            </form>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="coding inverse-toggle px-5 pt-4 shadow-lg text-gray-100 dark:bg-gray-800 bg-white pb-6 pt-4 rounded-lg leading-normal overflow-hidden">
                            <div class="top mb-2 flex">
                                <h4 class="mb-2 font-semibold dark:text-white text-gray-900">Start</h4>
                            </div>

                            <form method="post">
                                <input name="action" value="createService" type="hidden">
                                <input name="csrf" value="<?= $_SESSION['csrf'] ?>" type="hidden">
                                <div class="flex-1 flex flex-col md:flex-row text-sm font-mono subpixel-antialiased">
                                    <div class="w-full flex-1 mx-2">
                                        <input placeholder="Count" type="number" name="count"
                                               id="Count-input"
                                               class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600">

                                        <label class="inline-flex items-center mt-3">
                                            <input type="checkbox" name="start" class="form-checkbox h-5 w-5"
                                                   checked><span
                                                    class="ml-2 dark:text-white text-gray-900">Start on create</span>
                                        </label>

                                    </div>
                                </div>
                                <button type="submit"
                                        id="execute-command"
                                        class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                    Execute
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</main>