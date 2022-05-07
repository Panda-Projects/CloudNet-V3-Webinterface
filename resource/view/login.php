<div class="w-full h-screen flex items-center justify-center">
    <form class="w-full md:w-1/3 bg-white rounded-lg" method="post">
        <input name="action" value="login" type="hidden">
        <input name="csrf" value="<?= $_SESSION['csrf_token'] ?>" type="hidden">
        <div class="flex font-bold justify-center mt-6">
            <img class="h-20 w-20"
                 src="<?= \App\Helper\urlHelper::get(); ?>/assets/logo.svg" alt="logo">
        </div>
        <h2 class="text-3xl text-center text-gray-700 mb-4">CloudNet Webinterface</h2>
        <div class="px-12 pb-10">
            <div class="w-full mb-2">
                <div class="flex items-center">
                    <i class='ml-3 fill-current text-gray-400 text-xs z-10 fas fa-user'></i>
                    <input type='text' placeholder="Username" name="username"
                           class="-mx-6 px-8  w-full border rounded px-3 py-2 text-gray-700 focus:outline-none"/>
                </div>
            </div>
            <div class="w-full mb-2">
                <div class="flex items-center">
                    <i class='ml-3 fill-current text-gray-400 text-xs z-10 fas fa-lock'></i>
                    <input type='password' placeholder="Password" name="password" autocomplete="off"
                           class="-mx-6 px-8 w-full border rounded px-3 py-2 text-gray-700 focus:outline-none"/>
                </div>
            </div>
            <br/>
            <button type="submit"
                    class="w-full py-2 rounded-full bg-green-600 text-gray-100  focus:outline-none">Login
            </button>
    </form>
</div>
