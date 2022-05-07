<?php

use App\Helper\urlHelper;

$groups = urlHelper::buildDefaultRequest("permissions")

?>
<main class="w-full flex-grow p-6">
    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                    <?php foreach ($groups as $group) { ?>
                        <div class="min-w-0 p-5 dark:bg-gray-800 bg-white rounded-lg shadow-lg">
                            <h4 class="mb-4 font-semibold text-blue-500 text-center"><?= $group["name"] ?></h4>
                            <div class="flex">
                                <p class="flex-1 dark:text-white text-gray-900 text-center p-2"></p>
                            </div>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">Erster
                                    Erstellt: <?= date("H:i:s d.m.y", intval($group["createdTime"]) / 1000) ?></p>
                            </div>
                            <div class="flex justify-center mt-4 space-x-3 text-sm text-white">
                                <div class="flex items-center">
                                    <a href="/permissions/<?= $group['name']; ?>"
                                       class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">Show</a>
                                    <a href="/permissions/<?= $group['name']; ?>/delete"
                                       class="h-10 bg-red-500 text-white rounded-md px-4 py-2 m-2 hover:bg-red-700 focus:outline-none focus:shadow-outline">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
        </main>
    </div>
</main>