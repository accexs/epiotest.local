<div>
	<h2>Récipe médico</h2>
	<div>
		<p><strong>Nombre:</strong>{{ $name }}</p>
		<p><strong>Apellido:</strong>{{ $lastname }}</p>
		<p><strong>Ci:</strong>{{ $ci }}</p>
		<p><strong>Fecha de nacimiento:</strong>{{ $bdate }}</p>
	</div>
	<div>
		<h3>Medicamentos y prescripción</h3>
		{{ $meds }}
	</div>
</div>