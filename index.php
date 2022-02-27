<?php 
$tmpText = file_get_contents('tmpfile.php');
$defText = "&#x3C;?php\n\n\n\n?&#x3E;";
?>

<!doctype html>
<head>
	<title>I'lm PHP Editor</title>
	<meta charset="utf-8"/>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="lib/codemirror.css">
	<script src="lib/codemirror.js"></script>

	<script src="addon/edit/matchbrackets.js"></script>
	<script src="addon/edit/closetag.js"></script>
	<script src="addon/edit/closebrackets.js"></script>
	<script src="addon/display/rulers.js"></script>

	<link rel="stylesheet" href="theme/darcula.css">

	<script src="mode/htmlmixed/htmlmixed.js"></script>
	<script src="mode/xml/xml.js"></script>
	<script src="mode/javascript/javascript.js"></script>
	<script src="mode/css/css.js"></script>
	<script src="mode/clike/clike.js"></script>
	<script src="mode/php/php.js"></script>
	<style>
	  .CodeMirror {font-size: 18px;border-top: 1px solid black; border-bottom: 1px solid black;}
	  .output {white-space: pre-wrap;font-size: 20px;color: #333;padding: 20px 50px;min-height: 200px;background: #f0f0f0;}
	  .chkbox-options{margin: 2px 0}
	</style>
</head>
	<body>
	<h2>PHP Editor</h2>
	<form method="post" id="editorForm">
	<textarea id="code" name="code" autofocus><?php echo $tmpText ?: $defText ?></textarea>
	<div class="chkbox-options">
		<label>
			<input type="checkbox" name="use_conn" value="1" checked />
			Use mysql connection
		</label>
	</div>
	<div class="chkbox-options">
		<label>
			<input type="checkbox" name="use_bootstrap" value="1" />
			Use bootstrap
		</label>
	</div>
	<div class="chkbox-options">
		<label>
			<input type="checkbox" name="use_jquery" value="1" />
			Use jquery
		</label>
	</div>
	<input type="submit" id="submitbtn" value="Run" />
	</form>

	<h4>Output:</h4>
	<div class="output"</div>

	<script>
		var rulers = [];
		for (var i = 1; i <= 100; i++) {
			rulers.push({color: "#555", column: i*4, lineStyle: "dashed"});
		}
	  
		var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
			lineNumbers: true,
			theme: 'darcula',
			matchBrackets: true,
			autoCloseBrackets: true,
			autoCloseTags: true,
			styleActiveLine: true,
			mode: "application/x-httpd-php",
			indentUnit: 4,
			rulers: rulers,
			indentWithTabs: true
		});
		editor.setCursor({line: 1, ch: 5})
		editor.setOption("extraKeys", {
			"Ctrl-Enter" : function(cm) {
				$("#submitbtn").click();
			}
		});
	</script><script>
		$(document).ready(function(){
			$("#editorForm").on("submit", function(e){
				e.preventDefault();
				
				$.ajax({
					type: 'POST',
					url: 'ajax.php',
					data: $(this).serialize(),
					success: function(data) {
						$(".output").html(data);
						console.log(data);
					}
				});
			});
		});
	</script>
</body>