<?php

use App\Helper\urlHelper;

$players = urlHelper::buildDefaultRequest("players")

?>
<main class="w-full flex-grow p-6">
    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                    <?php foreach ($players as $player) { ?>
                        <a href="<?= urlHelper::get() . "/players/" . $player["uuid"] ?>">
                            <div class="min-w-0 p-5 dark:bg-gray-800 bg-white rounded-lg shadow-lg">
                                <div class="hero container max-w-screen-lg mx-auto pb-5">
                                    <img
                                            alt=""
                                            class="m-auto h-64"
                                            src="https://mc-heads.net/body/<?= $player["uuid"] ?>"/>
                                </div>
                                <h4 class="mb-4 font-semibold text-blue-500 text-center"><?= $player["name"] ?></h4>
                                <div class="flex">
                                    <p class="flex-1 dark:text-white text-gray-900 text-center p-2"><?php

                                        foreach ($player["groups"] as $group) {
                                            echo '<span class="text-sm text-center text-white mx-1 h-6 w-16 bg-blue-500 rounded-full py-1 px-2">' . $group["group"] . '</span>';
                                        }
                                        ?></p>
                                </div>
                                <div class="flex">
                                    <p class="flex-1 dark:text-white text-gray-900 text-center p-2"><?php
                                        if ($player["status"] === "Offline") {
                                            echo '<span class="text-sm text-center mx-1 text-white h-6 w-16 bg-gray-500 rounded-full py-1 px-2">Offline</span>';
                                        } else {
                                            echo '<span class="text-sm text-center mx-1 text-white h-6 w-16 bg-green-500 rounded-full py-1 px-2">Online</span>';
                                            echo '<span class="text-sm text-center mx-1 text-white h-6 w-16 bg-green-500 rounded-full py-1 px-2">' . $player["server"] . '</span>';
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="flex">
                                    <span class="text-gray-400">•</span>
                                    <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">
                                        <?= _LAST_LOGIN ?>: <?= date("H:i:s d.m.y", intval($player["lastlogin"]) / 1000) ?></p>
                                </div>
                                <div class="flex">
                                    <span class="text-gray-400">•</span>
                                    <p class="flex-1 dark:text-white text-gray-900 items-center pl-2">
                                        <?= _FIRST_LOGIN ?>: <?= date("H:i:s d.m.y", intval($player["firstlogin"]) / 1000) ?></p>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
        </main>
    </div>
</main>