<?php

use App\Helper\urlHelper;

$groups = urlHelper::buildDefaultRequest("groups", "GET");
?>
<main class="w-full flex-grow p-6">
    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                    <!-- Groups start -->
                    <?php foreach ($groups as $group) { ?>
                        <div class="min-w-0 p-4 dark:bg-gray-800 bg-white rounded-lg shadow-lg">
                            <h4 class="mb-4 font-semibold text-blue-500"><?= $group["name"] ?></h4>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">Templates:
                                    <br><?php
                                    if (!empty($group["templates"])) {
                                        foreach ($group["templates"] as $template) {
                                            echo "» " . $template["storage"] . ":" . $template["name"] . "/" . $template["prefix"] . "<br>";
                                        }
                                    } else {
                                        echo "» ";
                                    }
                                    ?></p>
                            </div>
                            <div class="flex">
                                <span class="text-gray-400">•</span>
                                <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">Environment:
                                    <?php
                                    if (!empty($group["targetEnvironments"])) {
                                        echo $group["targetEnvironments"][0];
                                    } else {
                                        echo "";
                                    }
                                    ?><br></p>
                            </div>
                            <div class="flex justify-center mt-4 space-x-3 text-sm text-white">
                                <div class="flex items-center">
                                    <a href="<?= urlHelper::get() ?>/groups/<?= $group["name"] ?>/delete" type="button"
                                            class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                        <?= _DELETE ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Groups end-->
                    <?php } ?>
                </div>
            </div>
        </main>
    </div>
    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-1">
                    <!-- Create Group -->
                    <div class="w-full">
                        <div class="coding inverse-toggle px-5 pt-4 shadow-lg text-gray-100 dark:bg-gray-800 bg-white pb-6 pt-4 rounded-lg leading-normal overflow-hidden">
                            <div class="top mb-2 flex">
                                <h4 class="mb-2 font-semibold dark:text-white text-gray-900"><?= _CREATE_GROUP ?></h4>
                            </div>
                            <div class="flex-1 flex flex-col md:flex-row text-sm font-mono subpixel-antialiased">
                                <div class="w-full flex-1 mx-2">
                                    <input placeholder="Name"
                                           class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600">
                                </div>
                                <div class="w-full flex-1 mx-2">
                                    <input placeholder="Storage"
                                           class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600">
                                </div>
                                <div class="w-full flex-1 mx-2">
                                    <input placeholder="Prefix"
                                           class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600">
                                </div>
                                <div class="w-full flex-1 mx-2">
                                    <input placeholder="Environment"
                                           class="my-2 p-2 dark:bg-gray-900 bg-gray-100 flex border dark:border-gray-900 border-gray-100 rounded px-2 appearance-none outline-none w-full dark:text-white text-gray-900 focus:ring-2 focus:ring-blue-600">
                                </div>
                            </div>
                            <button type="button"
                                    class="h-10 bg-blue-500 text-white rounded-md px-4 py-2 m-2 hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                <?= _CREATE ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</main>