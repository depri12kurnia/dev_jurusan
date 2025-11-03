<!DOCTYPE html>
<html lang="id">

<head>
    <?php $this->load->view('layouts/parts_user/head'); ?>
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