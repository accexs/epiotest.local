@extends('layouts.master')

@section('content')
<div class="container" ng-controller="recipeController">
	<div class="row">
		<div class="col-md-4 col-md-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">
				@if (Auth::guest())
					<p>Bienvenido al sistema de recipes, inicie sesión o cree una cuenta nueva para comenzar</p>
					
				@else
					<h4>Saludos {{ Auth::user()->name }} administre aqui sus récipes</h4>
					<div class="text-center">
						<button class="btn btn-success" type="button" ng-click="modalRecipe('create')">Crear récipe</button>
					</div>
				@endif
				</div>
			</div>
		</div>
		@if (!Auth::guest())
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading text-center">
						<h4>Récipes creados</h4>
					</div>
					<div class="panel-body">
						<table class="table table-bordered table-responsive text-center">
							<thead>
								<tr>
									<th class="text-center">
										Nombre paciente
									</th>
									<th class="text-center">
										Fecha creación
									</th>
								</tr>
							</thead>
							<tbody ng-repeat="recipe in recipes">
								<tr>
									<td>
										<% recipe.name + " " + recipe.lastname %>
									</td>
									<td>
										<% recipe.created_at | date:'dd-MM-yyyy' %>
									</td>
									<td>
										<button class="btn btn-info" ng-click="modalRecipe('edit',recipe.id)">Detalle</button>
										<button class="btn btn-danger" ng-click="confirmDelete(recipe.id)">Eliminar</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		@endif
	</div>
	<!--modal for registration and login-->
	<div class="modal fade" id=regModal tabindex="-1" role="dialog" aria-labelledby="regModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h3 class="modal-title" id="regModalLabel"> <% formTitle %></h3>
				</div>

				<div class="modal-body">
					<form name="regForm" class="form-horizontal" novalidate ng-submit="submitUser(mode, id)" enctype="multipart/form-data">
						<div class="row">
							<div class="form-group error" ng-show="mode != 'login'">
								<label for="name" class="col-md-4 control-label">Nombre</label>
								<div class="col-md-4">
									<input class="form-control" type="text" name="name" value="<% name %>" ng-model="userData.name" required>
									<p class="help-inline col-md-offset-3" ng-show="regForm.name.$invalid">Se requiere el nombre</p>
								</div>
							</div>
							<div class="form-group error">
								<label for="email" class="col-md-4 control-label">Email</label>
								<div class="col-md-4">
									<input class="form-control" type="email" name="email" value="<% email %>" ng-model="userData.email" required>
									<p class="help-inline col-md-offset-3" ng-show="regForm.email.$invalid">Se requiere el email</p>
								</div>
							</div>
							<div class="form-group error">
								<label for="password" class="col-md-4 control-label">Password</label>
								<div class="col-md-4">
									<input class="form-control" type="password" name="password" value="" ng-model="userData.password" required>
									<p class="col-md-offset-3" ng-show="regForm.password.$invalid">Se requiere un password</p>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary" id="btm-save" ng-disabled="regForm.$invalid"><% submitBtn %></button>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
	<!--end modal-->

	<!--modal for create recipe-->
	<div class="modal fade" id="recipeModal" tabindex="-1" role="dialog" aria-lbelledby="recipeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="recipeModalLabel"> <% formTitle %> </h3>
				</div>

				<div class="modal-body">
					<form name="recipeForm" class="form-horizontal" novalidate="" ng-submit="submitRecipe(mode,id)" enctype="multipart/form-data">
						<div class="">
						<div class="panel panel-info panel-body">
							<div class="panel-heading">
								<h4>Información del paciente</h4>	
							</div>
							<br>
							<div class="form-group error">
								<label for="name" class="col-md-4 control-label">Nombre</label>
								<div class="col-md-4">
									<input class="form-control" type="text" name="name" value=" <% name %> " ng-model="recipeData.name" required>
									<p class="col-md-offset-3" ng-show="recipeForm.name.$invalid"><small>Nombre es requerido</small></p>
								</div>
							</div>
							<div class="form-group error">
								<label for="lastname" class="col-md-4 control-label">Apellido</label>
								<div class="col-md-4">
									<input class="form-control" type="text" name="lastname" value=" <% lastname %> " ng-model="recipeData.lastname" required>
									<p class="col-md-offset-3" ng-show="recipeForm.lastname.$invalid"><small>Apellido es requerido</small></p>
								</div>
							</div>
							<div class="form-group error">
								<label for="ci" class="col-md-4 control-label"># Cédula</label>
								<div class="col-md-4">
									<input class="form-control" type="text" name="ci" value=" <% ci %> " ng-model="recipeData.ci" required>
									<p class="col-md-offset-3" ng-show="recipeForm.ci.$invalid"><small>Se requiere la cédula</small></p>
								</div>
							</div>
							<div class="form-group error">
								<label for="bdate" class="col-md-4 control-label">Fecha nacimiento</label>
								<div class="col-md-4">
									<input class="form-control datepicker" type="text" name="bdate" value=" <% bdate %> " ng-model="recipeData.bdate" required placeholder="Click para seleccionar">
									<p class="col-md-offset-3" ng-show="recipeForm.bdate.$invalid"><small>Se requiere la fecha</small></p>
								</div>
							</div>
							<div class="form-group error">
								<label for="email" class="col-md-4 control-label">Email</label>
								<div class="col-md-4">
									<input class="form-control" type="email" name="email" value="<% email %>" ng-model="recipeData.email" required>
									<p class="help-inline col-md-offset-3" ng-show="recipeForm.email.$invalid">Se requiere el email</p>
								</div>
							</div>
						</div>
							<div class="form-group error">
							    <label for="meds" class="col-md-4 control-label">Medicamentos y descripción</label>
							    <div class="col-md-6">
							        <textarea ui-tinymce class="form-control" type="text" name="meds" value=" <% meds %> " ng-model="recipeData.meds" required></textarea>
							        <p class="col-md-offset-3" ng-show="recipeForm.meds.$invalid" class="help-inline">Información requerida.</p>
							    </div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info" ng-click="sendRecipe()">Enviar por correo</button>
							    <button type="submit" class="btn btn-primary" id="btn-save" ng-disabled="recipeForm.$invalid">Guardar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--end modal-->

	<!--modal del confirmation-->
	<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="myModalLabel"> Confirmar eliminación </h3>
				</div>
				<div class="modal-body">
					<div class="text-center">
						<button ng-click="deleteRecipe(tempId)" class="btn btn-danger" id="btn-save">Eliminar</button>
						<button ng-click="cancelDelete()" class="btn btn-primary" id="btn-save">Cancelar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end modal-->
	        
</div>
@endsection

@section('scripts')
	<script src="js/bootstrap-datepicker.min.js"></script>
	<script src="js/bootstrap-datepicker.es.min.js"></script>
	<script type="text/javascript">
        // When the document is ready
        $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: "yyyy-mm-dd",
                language: "es"
            });  
        
        });
    </script>
@endsection