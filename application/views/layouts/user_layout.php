<!DOCTYPE html>
<html lang="id">

<head>
    <?php $this->load->view('layouts/parts_user/head'); ?>
    <!-- Google Analytics -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1X45C3K6T8"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-1X45C3K6T8');
    </script>
    <!-- End Google Analytics -->


</head>

<body>
    <?php $this->load->view('layouts/parts_user/navbar'); ?>

    <!-- Main Content -->
    <main class="main-content">
        <?php
        if (isset($content)) {
            $this->load->view($content, isset($data) ? $data : array());
        } else {
            echo $content_for_layout ?? '';
        }
        ?>
    </main>

    <?php $this->load->view('layouts/parts_user/footer'); ?>
    <?php $this->load->view('layouts/parts_user/js'); ?>
</body>

</html>