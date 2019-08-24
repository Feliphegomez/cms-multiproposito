
<style scope="compose-inbox">
.compose .compose-body .editor-wrapper {
	min-height: calc(10vh);
	max-height: calc(50vh);
}
</style>
<div id="compose-inbox" class="compose col-md-8 col-xs-11">
	<div class="compose-header">
		Nuevo Mensaje para el Equipo Monteverde LTDA
		<button type="button" class="close compose-close">
			<span>×</span>
		</button>
	</div>
	<template  v-if="enabled == true">
	</template>
	<template  v-else>
		<template  v-if="!session.user || !session.user.id">
			<h4>¿Deseas contactarnos?</h4>
			<div class="compose-body">
				<div class="form-horizontal form-label-left input_mask">

				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Nombres">
					<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
				  </div>

				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<input type="text" class="form-control" id="inputSuccess3" placeholder="Primer Apellido">
					<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
				  </div>

				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Segundo Apellido">
					<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
				  </div>

				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<input type="text" class="form-control" id="inputSuccess5" placeholder="email">
					<span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
				  </div>

				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<input type="text" class="form-control" id="inputSuccess5" placeholder="Phone">
					<span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
				  </div>

				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<input type="text" class="form-control" id="inputSuccess5" placeholder="mobile">
					<span class="fa fa-mobile form-control-feedback right" aria-hidden="true"></span>
				  </div>

				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<input type="password" class="form-control" id="inputSuccess5" placeholder="Escriba una contraseña">
					<span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
				  </div>

				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<input type="password" class="form-control" id="inputSuccess5" placeholder="Verifique su contraseña">
					<span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
				  </div>

				  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" class="flat"> Confirmo que leí y Acepto los <a>terminos y condiciones</a> y las <a>póliticas</a> del portal.
						</label>
					</div>
				  </div>
				  <div class="ln_solid"></div>
				</div>
			</div>
			<div class="compose-footer">
				<button type="button" class="btn btn-md btn-default" @click="slideToggle">
					Cerrar
				</button>
				<button class="btn btn-md btn-success" type="button">
					Entiendo
				</button>
			</div>
		</template>
		<template  v-else>
			<div class="compose-body">
				<div id="alerts"></div>
				<div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
					<div class="btn-group">
						<a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
						<ul class="dropdown-menu"></ul>
					</div>
					<div class="btn-group">
						<a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a data-edit="fontSize 5"><p style="font-size:17px">Huge</p></a></li>
							<li><a data-edit="fontSize 3"><p style="font-size:14px">Normal</p></a></li>
							<li><a data-edit="fontSize 1"><p style="font-size:11px">Small</p></a></li>
						</ul>
					</div>

					<div class="btn-group">
						<a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
						<a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
						<a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
						<a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
					</div>

					<div class="btn-group">
						<a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
						<a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
						<a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
						<a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
					</div>

					<div class="btn-group">
						<a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
						<a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
						<a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
						<a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
					</div>

					<div class="btn-group">
						<a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
						<div class="dropdown-menu input-append">
							<input class="span2" placeholder="URL" type="text" data-edit="createLink" />
							<button class="btn" type="button">Add</button>
						</div>
						<a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
					</div>

					<div class="btn-group">
						<a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
						<input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
					</div>

					<div class="btn-group">
						<a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
						<a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
					</div>
				</div>
				
				<div id="editor" class="editor-wrapper"></div>
			</div>
			
			<div class="compose-footer">
				<button type="button" class="btn btn-md btn-default" @click="slideToggle">
					Cerrar
				</button>
				<button @click="sendMessage" id="send" class="btn btn-sm btn-success" type="button">Enviar Mensaje</button>
			</div>
		</template>
	</template>
</div>