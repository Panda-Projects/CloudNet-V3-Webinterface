<?php

use App\Helper\urlHelper;

?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="<?= urlHelper::get(); ?>/assets/styles.css" rel="stylesheet">
    <title><?= urlHelper::getConfig()["name"] ?></title>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>
        if (localStorage.theme == 'dark') {
            document.querySelector('html').classList.add('dark')
        } else {
            document.querySelector('html').classList.remove('dark')
        }
    </script>
</head>

<body class="dark:bg-gray-900 bg-gray-100">
<div class="md:flex flex-col md:flex-row md:min-h-screen md:mx-auto w-full">
    <div @click.away="open = false"
         class="flex flex-col w-full md:w-64 dark:text-gray-700 dark:bg-gray-800 text-gray-900 bg-white flex-shrink-0"
         x-data="{ open: false }">
        <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">
            <a href="#"
               class="flex items-center py-2 px-8 dark:text-gray-100 hover:dark:text-gray-200 text-gray-800 hover:text-gray-900 text-lg font-semibold">
                <svg class="text-gray-900 dark:text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="32" height="32" x="0" y="0"
                     viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"
                     xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://svgjs.com/svgjs ">
                        <path fill-rule="evenodd"
                              d="M448.779,235.5C464.04,152.252,399.905,76,316,76c-48.485,0-91.873,25.721-115.782,65.534    c-32.612-10.538-66.144-6.047-93.77,12.971c-27.611,19.007-44.101,49.101-45.436,82.016C24.118,253.902,0,290.638,0,331    c0,6.913,0.678,13.828,2.014,20.555C11.733,400.485,55.044,436,105,436h301c58.448,0,106-47.103,106-105    C512,289.686,486.935,252.393,448.779,235.5z M406,406H105c-41,0-75-33.235-75-75c0-31.25,20.537-59.52,51.104-70.345l10.65-3.772    l-0.685-11.278c-1.611-26.5,10.498-51.319,32.391-66.39c23.151-15.938,51.552-17.039,77.549-5.251l13.512,6.127l6.275-13.444    C237.992,129.806,275.362,106,316,106c57.897,0,105,47.103,105,105c0,17.126-3.613,27.495-7.608,41.224    c11.185,5.806,12.995,6.882,16.761,8.172C461.164,271.018,482,299.392,482,331C482,372.355,447.906,406,406,406z"
                              data-original="#000000" style="" class=""/>
                    </svg>
                <span class="mx-4 font-medium">CloudNet</span>
            </a>
            <button class="rounded-lg md:hidden rounded-lg focus:outline-none focus:shadow-outline"
                    @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="!open" fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                          clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <?php
        $path = strtolower(explode("/", $_SERVER['REQUEST_URI'])[1]);
        ?>

        <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
            <a class="<?= $path == "" ? "block px-4 py-2 mt-2 text-sm font-semibold dark:text-white dark:bg-gray-900 text-gray-900 bg-gray-100 rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" :
                "block px-4 py-2 mt-2 text-sm font-semibold text-gray-400 bg-transparent rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" ?>"
               href="<?= urlHelper::get(); ?>">Dashboard</a>
            <a class="<?= $path == "cluster" ? "block px-4 py-2 mt-2 text-sm font-semibold dark:text-white dark:bg-gray-900 text-gray-900 bg-gray-100 rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" :
                "block px-4 py-2 mt-2 text-sm font-semibold text-gray-400 bg-transparent rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" ?>"
               href="<?= urlHelper::get() . '/cluster'; ?>">Cluster</a>
            <a class="<?= $path == "tasks" ? "block px-4 py-2 mt-2 text-sm font-semibold dark:text-white dark:bg-gray-900 text-gray-900 bg-gray-100 rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" :
                "block px-4 py-2 mt-2 text-sm font-semibold text-gray-400 bg-transparent rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" ?>"
               href="<?= urlHelper::get() . '/tasks'; ?>">Tasks</a>
            <a class="<?= $path == "groups" ? "block px-4 py-2 mt-2 text-sm font-semibold dark:text-white dark:bg-gray-900 text-gray-900 bg-gray-100 rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" :
                "block px-4 py-2 mt-2 text-sm font-semibold text-gray-400 bg-transparent rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" ?>"
               href="<?= urlHelper::get() . '/groups'; ?>">Groups</a>
            <a class="<?= $path == "permissions" ? "block px-4 py-2 mt-2 text-sm font-semibold dark:text-white dark:bg-gray-900 text-gray-900 bg-gray-100 rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" :
                "block px-4 py-2 mt-2 text-sm font-semibold text-gray-400 bg-transparent rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" ?>"
               href="<?= urlHelper::get() . '/permissions'; ?>">Permissions</a>
            <a class="<?= $path == "players" ? "block px-4 py-2 mt-2 text-sm font-semibold dark:text-white dark:bg-gray-900 text-gray-900 bg-gray-100 rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" :
                "block px-4 py-2 mt-2 text-sm font-semibold text-gray-400 bg-transparent rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" ?>"
               href="<?= urlHelper::get() . '/players'; ?>">Players</a>
            <a class="<?= $path == "modules" ? "block px-4 py-2 mt-2 text-sm font-semibold dark:text-white dark:bg-gray-900 text-gray-900 bg-gray-100 rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" :
                "block px-4 py-2 mt-2 text-sm font-semibold text-gray-400 bg-transparent rounded-lg hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" ?>"
               href="<?= urlHelper::get() . '/modules'; ?>">Modules</a>
            <div :class="{'block': open, 'hidden': !open}"
                 class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
                <a class="flex items-center py-2 px-8 dark:text-gray-100 hover:dark:text-gray-200 text-gray-800 hover:text-gray-900"
                   href="<?= urlHelper::get() . '/logout'; ?>">
                    <svg class="text-gray-900 dark:text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" x="0" y="0"
                         viewBox="0 0 512.00533 512" style="enable-background:new 0 0 512 512" xml:space="preserve"
                         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                         xsi:schemaLocation="http://svgjs.com/svgjs ">
                            <g>
                                <path fill-rule="evenodd" xmlns="http://www.w3.org/2000/svg"
                                      d="m320 277.335938c-11.796875 0-21.332031 9.558593-21.332031 21.332031v85.335937c0 11.753906-9.558594 21.332032-21.335938 21.332032h-64v-320c0-18.21875-11.605469-34.496094-29.054687-40.554688l-6.316406-2.113281h99.371093c11.777344 0 21.335938 9.578125 21.335938 21.335937v64c0 11.773438 9.535156 21.332032 21.332031 21.332032s21.332031-9.558594 21.332031-21.332032v-64c0-35.285156-28.714843-63.99999975-64-63.99999975h-229.332031c-.8125 0-1.492188.36328175-2.28125.46874975-1.027344-.085937-2.007812-.46874975-3.050781-.46874975-23.53125 0-42.667969 19.13281275-42.667969 42.66406275v384c0 18.21875 11.605469 34.496093 29.054688 40.554687l128.386718 42.796875c4.351563 1.34375 8.679688 1.984375 13.226563 1.984375 23.53125 0 42.664062-19.136718 42.664062-42.667968v-21.332032h64c35.285157 0 64-28.714844 64-64v-85.335937c0-11.773438-9.535156-21.332031-21.332031-21.332031zm0 0"
                                      data-original="#000000" style=""/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="m505.75 198.253906-85.335938-85.332031c-6.097656-6.101563-15.273437-7.9375-23.25-4.632813-7.957031 3.308594-13.164062 11.09375-13.164062 19.714844v64h-85.332031c-11.777344 0-21.335938 9.554688-21.335938 21.332032 0 11.777343 9.558594 21.332031 21.335938 21.332031h85.332031v64c0 8.621093 5.207031 16.40625 13.164062 19.714843 7.976563 3.304688 17.152344 1.46875 23.25-4.628906l85.335938-85.335937c8.339844-8.339844 8.339844-21.824219 0-30.164063zm0 0"
                                      data-original="#000000" style=""/>
                            </g>
                        </svg>
                    <span class="mx-4 font-medium">Logout</span>
                </a>
            </div>
        </nav>
    </div>
    <div class="w-full overflow-x-hidden flex flex-col">
        <header class="grid justify-items-end w-full bg-transparent text-gray-400 p-4">
            <ul class="flex items-center flex-shrink-0 space-x-6">
                <li class="relative">
                    <button id="switchTheme"
                            class="h-10 w-10 flex justify-center items-center focus:outline-none text-yellow-500">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </li>
                <li class="relative">
                    <div x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen"
                                class=" block rounded-md p-2 focus:outline-none text-sm overflow-hidden focus:outline-none">
                            <img
                                    <?php
                                    if(isset($_SESSION["lang"])) {
                                        if ($_SESSION["lang"] == "en") {
                                            $countName = "gb";
                                        } else {
                                            $countName = $_SESSION["lang"];
                                        }
                                    } else {
                                        $_SESSION["lang"] = "de";
                                        $countName = $_SESSION["lang"];
                                    }
                                    ?>
                                    src="https://flagcdn.com/<?= $countName ?>.svg"
                                    width="30"
                                    class="rounded"
                                    alt="Germany">
                        </button>
                        <div x-show="dropdownOpen" @click="dropdownOpen = false"
                             class="fixed inset-0 h-full w-full z-10"></div>
                        <div x-show="dropdownOpen"
                             class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                            <a href="<?= urlHelper::get() . '/lang/de'; ?>"
                               class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-indigo-500 hover:text-white">
                                <img
                                        src="https://flagcdn.com/de.svg"
                                        width="30"
                                        class="rounded inline"
                                        alt="Germany"> Germany
                            </a>
                            <a href="<?= urlHelper::get() . '/lang/en'; ?>"
                               class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-indigo-500 hover:text-white">
                                <img
                                        src="https://flagcdn.com/gb.svg"
                                        width="30"
                                        class="rounded inline"
                                        alt=""> English
                            </a>
                        </div>
                    </div>
                </li>
                <li class="relative">
                    <div x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen"
                                class=" block rounded-md p-2 focus:outline-none rounded-lg text-sm overflow-hidden focus:outline-none">
                            <img class="object-cover w-8 h-8 rounded-full"
                                 src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg"
                                 alt="" aria-hidden="true"/>
                        </button>

                        <div x-show="dropdownOpen" @click="dropdownOpen = false"
                             class="fixed inset-0 h-full w-full z-10"></div>
                        <div x-show="dropdownOpen"
                             class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                            <?php
                            $name = "";
                            $json = file_get_contents('https://sessionserver.mojang.com/session/minecraft/profile/' . $_SESSION["cn3-wi-user"]);
                            if (!empty($json)) {
                                $data = json_decode($json, true);
                                if (!empty($data)) {
                                    if (isset($data['name'])) {
                                        $name = $data['name'];
                                    }
                                }
                            }
                            ?>
                            <a href="<?= urlHelper::get() . '/profile'; ?>"
                               class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-indigo-500 hover:text-white">
                                <?= $name ?>
                            </a>
                            <a href="<?= urlHelper::get() . '/profile/help'; ?>"
                               class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-indigo-500 hover:text-white">
                                Help
                            </a>
                            <a href="<?= urlHelper::get() . '/profile/settings'; ?>"
                               class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-indigo-500 hover:text-white">
                                Settings
                            </a>
                            <a href="<?= urlHelper::get() . '/logout'; ?>"
                               class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-indigo-500 hover:text-white">
                                Logout
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </header>