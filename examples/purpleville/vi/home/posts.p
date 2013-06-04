{{#posts}}
<div class="well">
	<div class="pull-right">
		<i style="font-size:12px;">{{author}} - {{date}}</i>
	</div>

	<h3>{{title}}</h3>
	
	<p>
		{{content}}
	</p>

	<p>
		{{#tags}}
			<span class="label label-info">{{.}}</span>
		{{/tags}}
	</p>
</div>
{{/posts}}