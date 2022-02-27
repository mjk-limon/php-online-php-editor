<?php
$rustart = microtime(true);

if (isset($_POST['use_conn'])) $conn = new mysqli("localhost", "root", "adminlimon");
if (isset($_POST['use_bootstrap'])) echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />';
if (isset($_POST['use_jquery'])) echo '<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>';
if (isset($_POST['use_bootstrap'])) echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$_tmp  = fopen("tmpfile.php", 'w');
	fwrite($_tmp, $_POST['code']);
	fseek($_tmp, 0);
	require stream_get_meta_data($_tmp)['uri'];
	fclose($_tmp);
}

$execution_time = (microtime(true) - $rustart) * 1000;
echo "<div style=\"font-size:14px;margin-top:20px;\"><hr/>";
echo "This process used " . $execution_time . " ms for its computations\n";
echo "</div>";
