<?php

use App\Helper\MessageHelper;

if (isset($_GET["action"])) {
    ?>
    <div x-data="{ showModal : true }">
        <!-- Modal Background -->
        <div
            class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
            x-show="showModal"
            id="my-modal"
        ></div>
        <div x-show="showModal"
             class="fixed text-gray-600 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0"
             x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <!-- Modal -->
            <div x-show="showModal"
                 class="dark:bg-gray-800 dark:text-white text-center bg-white rounded-xl shadow-2xl p-6 sm:w-8/12 mx-10"
                 @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform"
                 x-transition:enter-start="opacity-0 scale-90 translate-y-1"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease duration-100 transform"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-90 translate-y-1">

                <?php if ($_GET["success"] === "true") { ?>
                    <div class="hero container max-w-screen-lg mx-auto p-5">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             id="Capa_1" x="0px" y="0px" viewBox="0 0 507.506 507.506"
                             fill="currentColor"
                             class="mx-auto h-32 text-green-400"
                             height="512">
                            <g>
                                <path d="M163.865,436.934c-14.406,0.006-28.222-5.72-38.4-15.915L9.369,304.966c-12.492-12.496-12.492-32.752,0-45.248l0,0   c12.496-12.492,32.752-12.492,45.248,0l109.248,109.248L452.889,79.942c12.496-12.492,32.752-12.492,45.248,0l0,0   c12.492,12.496,12.492,32.752,0,45.248L202.265,421.019C192.087,431.214,178.271,436.94,163.865,436.934z"/>
                            </g>
                        </svg>
                    </div>
                    <span class="font-bold block text-3xl mb-3"><?= MessageHelper::getMessage("successmodal") ?></span>
                <?php } else { ?>
                    <div class="hero container max-w-screen-lg mx-auto p-5">
                        <svg class="mx-auto h-32 text-red-400" fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="512"
                             height="512">
                            <path d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm0,22A10,10,0,1,1,22,12,10.011,10.011,0,0,1,12,22Z"/>
                            <path d="M12,5a1,1,0,0,0-1,1v8a1,1,0,0,0,2,0V6A1,1,0,0,0,12,5Z"/>
                            <rect x="11" y="17" width="2" height="2" rx="1"/>
                        </svg>
                    </div>
                    <span class="font-bold block text-3xl mb-3 p-5"><?= MessageHelper::getMessage("errormodal") ?></span>
                <?php } ?>

                <span class="font-bold block text-xl mb-3"><?= MessageHelper::getMessage($_GET["message"]) ?></span>

                <!-- Buttons -->
                <div class="text-right space-x-5 mt-5">
                    <button @click="showModal = !showModal"
                            class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo"><?= MessageHelper::getMessage("closemodal") ?></button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>