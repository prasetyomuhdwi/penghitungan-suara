<!DOCTYPE html>
<html lang="en">
<div class="flash-data" data-type="<?= $this->session->flashdata('type'); ?>" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?= $title ?></title>
	<link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico?v=') . time() ?>">
	<link href="<?= base_url() ?>assets/dist/css/style.min.css" rel="stylesheet">
</head>