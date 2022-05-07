<?php

$player = \webinterface\main::buildDefaultRequest("players/". $_SESSION["cn3-wi-user"])

?>
<main class="w-full flex-grow p-6">
    <div class="py-3">
        <main class="h-full overflow-y-auto">
            <div class="container mx-auto grid">
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                        <div class="min-w-0 p-5 dark:bg-gray-800 bg-white rounded-lg shadow-lg">
                            <div class="hero container max-w-screen-lg mx-auto pb-5">
                                <img
                                    alt=""
                                    class="m-auto h-128"
                                    src="https://mc-heads.net/body/<?= $_SESSION["cn3-wi-user"] ?>"/>
                            </div>
                        </div>
                </div>

        </main>
    </div>
</main>