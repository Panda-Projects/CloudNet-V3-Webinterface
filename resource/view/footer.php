</div>
</div>
<script>
    if (document.getElementById('switchTheme') != null) {
        document.getElementById('switchTheme').addEventListener('click', function () {
            let htmlClasses = document.querySelector('html').classList;
            if (localStorage.theme == 'dark') {
                htmlClasses.remove('dark');
                localStorage.removeItem('theme')
            } else {
                htmlClasses.add('dark');
                localStorage.theme = 'dark';
            }
        });
    }
</script>
</body>
</html>