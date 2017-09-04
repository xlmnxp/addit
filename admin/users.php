<?php
    include_once ('header.php');
    global $default, $language;
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Users</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Users</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Users</div>
				<div class="panel-body">
					<table id="users" data-toggle="table" data-url="tables/users.php"  data-show-refresh="true" data-show-toggle="false" data-show-columns="false" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="id" data-sort-order="desc" data-side-pagination="server">
						<thead>
						<tr>
							<th data-field="id" data-sortable="true"></th>
                            <th data-field="avatar" data-formatter="imagerow"></th>
                            <th data-formatter="flags"><?= $language->country ?></th>
							<th data-field="username"  data-sortable="true"><?= $language->username ?></th>
                            <th data-field="fullname" data-sortable="true"><?= $language->fullname ?></th>
                            <th data-field="message" data-sortable="true"><?= $language->message ?></th>
							<th data-field="id" data-formatter="editbtns"></th>
						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>

	</div><!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap-table.js"></script>
	<script>
        function imagerow(value,row,index) {
            var image = row.avatar.indexOf('http') > -1 ? row.avatar : '<?= $default['url']; ?>' + row.avatar;
            return '<center><img height="50" width="50" src="'+image+'"/></center>';
        }

        function editbtns(value,row,index) {
            return '<a class="btn btn-primary" style="margin: 2px;" href="edit?id='+row.id+'"><?= $language->edit ?></a><a class="btn btn-danger" style="margin: 2px;" href="delete?id='+row.id+'"><?= $language->delete?></a><a class="btn btn-warning" style="margin: 2px;" href="https://www.snapchat.com/add/'+row.username+'" target="_blank"><?= $language->follow ?></a>'
        }

        function flags(value,row,index) {
            var flag = JSON.parse(row.data).country.toLowerCase();

            return '<center> <img src="<?= $default['url']; ?>Flags/'+ flag +'.png" width="30" height="20"/> </center>'
        }
    </script>
<?php include_once ('footer.php') ?>
