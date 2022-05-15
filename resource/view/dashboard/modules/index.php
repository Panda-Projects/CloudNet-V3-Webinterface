<?php

use App\Helper\urlHelper;

$modules = urlHelper::buildDefaultRequest("modules")

?>
<main class="w-full flex-grow p-6">
    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                    <?php foreach ($modules as $module) {

                        if ($module["name"] == "CloudNet-SyncProxy") {
                            ?><a href="<?= urlHelper::get() ?>/modules/syncproxy"><?php
                        }
                        if ($module["name"] == "CloudNet-Signs") {
                        ?><a href="<?= urlHelper::get() ?>/modules/signs"><?php
                            }
                        ?>
                        <div class="min-w-0 p-4 dark:bg-gray-800 bg-white rounded-lg shadow-lg">
                            <h4 class="mb-4 font-semibold text-blue-500"><?= $module["name"] ?></h4>
                            <div class="flex">
                                <p class="flex-1 dark:text-white text-gray-900 text-center p-5"><?= $module["description"] ?></p>
                            </div>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">
                                    Group: <?= $module["group"] ?></p>
                            </div>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">
                                    Version: <?= $module["version"] ?></p>
                            </div>
                        </div>
                        <?php
                        if ($module["name"] == "CloudNet-SyncProxy" || $module["name"] == "CloudNet-Signs") {
                            ?></a><?php
                        }
                    } ?>
                </div>
            </div>
        </main>
    </div>
</main>