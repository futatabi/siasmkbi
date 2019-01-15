<h3 class="header smaller lighter blue">
	Penilaian Basis Sikap
</h3>									
<div class="clearfix">
	<div class="table-header header-color-dark form-inline">Deskripsi Penilaian Sikap Siswa Semester 
		<?php 
			echo $kodesmt 
		?>
	</div>
	<textarea name="sikap" class="span6 limited autosize-transition " id="form-field-9" data-maxlength="160">
		<?php 
			echo $row[$sikap]; 
		?>
	</textarea>
</div>