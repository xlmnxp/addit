<?php
    $page = 'users';
    include_once ('header.php');
    global $default, $language, $template;
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><?= $language->users ?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><?= $language->users ?></h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?= $language->users ?></div>
				<div class="panel-body">
					<table id="users" data-toggle="table" data-url="tables/users.php"
                           data-show-refresh="true" data-show-toggle="false" data-show-columns="false"
                           data-search="true" data-select-item-name="toolbar1" data-pagination="true"
                           data-sort-name="id" data-sort-order="desc" data-side-pagination="server">
						<thead>
                            <tr>
                                <th data-field="id" data-sortable="true"></th>
                                <th data-field="avatar" data-formatter="imageRow"></th>
                                <th data-formatter="flags"><?= $language->country ?></th>
                                <th data-field="username"  data-sortable="true"><?= $language->username ?></th>
                                <th data-field="fullname" data-sortable="true"><?= $language->fullname ?></th>
                                <th data-field="message" data-sortable="true"><?= $language->message ?></th>
                                <th data-field="id" data-formatter="editBtns"></th>
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
        function imageRow(value,row,index) {
            var image = row.avatar.indexOf('http') > -1 ? row.avatar : '<?= $default['url']; ?>' + row.avatar;
            return '<center><img height="50" width="50" src="'+image+'"/></center>';
        }

        function editBtns(value,row,index) {
            return '<a class="btn btn-primary btn-block text-left" style="margin: 2px;" onclick="editUser(\''+ escape(JSON.stringify(row)) +'\')"><svg class="glyph stroked pencil" style="height: 20px; width: 20px;"><use xlink:href="#stroked-pencil"/></svg>&nbsp;<?= $language->edit ?></a><a class="btn btn-danger btn-block text-left" style="margin: 2px;" onclick="deleteUser(\''+row.id+'\')"><svg class="glyph stroked trash" style="height: 20px; width: 20px;"><use xlink:href="#stroked-trash"/></svg>&nbsp;<?= $language->delete ?></a>'
        }

        function flags(value,row,index) {
            var flag = JSON.parse(row.data).country.toLowerCase();

            return '<center><img src="<?= $default['url']; ?>Flags/'+ flag +'.png" width="30" height="20"/></center>'
        }

        function deleteUser(id) {

            swal({
                title: '<?= $language->are_you_sure ?>',
                text: "<?= $language->you_wont_be_able_to_revert_this ?>",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                cancelButtonText: '<?= $language->cancel ?>',
                confirmButtonText: '<?= $language->confirm ?>',
                showLoaderOnConfirm: true
            }).then(function () {
                $.getJSON('delete.user.php?id='+id, function (data) {
                    if(data.status == 'success'){
                        swal(
                            '<?= $language->success ?>!',
                            '<?= $language->user_deleted_successfully ?>.',
                            'success'
                        );
                        $('#users').bootstrapTable('refresh');
                    }else{
                        swal(
                            '<?= $language->error ?>!',
                            data.message,
                            'error'
                        );
                    }
                });
            });
        }

        function editUser(data) {
            var JSONdata = JSON.parse(unescape(data));

            var labelFilter = {
                id: '',
                username: '<?= $language->username ?>',
                fullname: '<?= $language->fullname ?>',
                avatar: '<?= $language->avatar ?>',
                message: '<?= $language->message ?>',
                sex: '<?= $language->sex ?>',
                data: 'data'
            };
            var form = '<form method="post" id="editForm" action="#" onsubmit="return submitUser();">';
            Object.entries(JSONdata).forEach(function (value) {
                form += '<div class="form-group">';
                form += '<label for"'+ value[0] +'">'+ labelFilter[value[0]] +'</label>';
                if(value[0] == 'message'){
                    form += '<textarea class="form-control" id="'+ value[0] +'" name="'+ value[0] +'" placeholder="'+ value[1] +'" rows="3">'+ value[1] +'</textarea>';
                }else if(value[0] == 'sex'){
                    form += '<div class="radio"><label for="sex-0"><input type="radio" name="sex" id="sex-0" value="0" checked="checked"><?= $language->male ?></label><label for="sex-1"><input type="radio" name="sex" id="sex-1" value="1"><?= $language->female ?></label></div>';
                }else if(value[0] == 'data'){
                    var user_data = JSON.parse(eval(JSON.stringify(value[1])));
                    form += '<textarea class="form-control" id="'+ value[0] +'" name="'+ value[0] +'" placeholder="'+ JSON.stringify(value[1]) +'" rows="5" dir="ltr">'+ JSON.stringify(user_data,null,4) +'</textarea>';
                }else if(value[0] == 'id'){
                    form += '<input class="form-control" type="text" id="'+ value[0] +'" name="'+ value[0] +'" placeholder="'+ value[1] +'" value="'+ value[1] +'" disabled=disabled/>';
                }else {
                    form += '<input class="form-control" type="text" id="'+ value[0] +'" name="'+ value[0] +'" placeholder="'+ value[1] +'" value="'+ value[1] +'"/>';
                }
                form += '</div>';
            });
            form += '<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit"><svg class="glyph stroked pencil" style="height: 20px; width: 20px;"><use xlink:href="#stroked-pencil"/></svg>&nbsp;<?= $language->edit ?></button>';
            form += '</form>';

            swal({
                html: form,
                showCancelButton: true,
                cancelButtonText: '<?= $language->cancel ?>',
                showConfirmButton: false
            }).then(function () {});
        }

        function submitUser(data){
            var validateKey = /value\=\'(.*)\'/g.exec("<?= $template->validate->key ?>")[1];
            var ef = document.getElementById('editForm');
            var formData = {
                id: ef['id'].value,
                username: ef['username'].value,
                fullname: ef['fullname'].value,
                avatar: ef['avatar'].value,
                message: ef['message'].value,
                sex: ef['sex'].value,
                data: JSON.stringify(JSON.parse(ef['data'].value)),
                form_key: validateKey
            };

            post('edit.user.php',formData,'post');


            return false;
        }

        function post(path, params, method) {
            method = method || "post"; // Set method to post by default if not specified.

            // The rest of this code assumes you are not using a library.
            // It can be made less wordy if you use one.
            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", path);

            for(var key in params) {
                if(params.hasOwnProperty(key)) {
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", key);
                    hiddenField.setAttribute("value", params[key]);

                    form.appendChild(hiddenField);
                }
            }

            $.ajax({
                type: form.getAttribute('method'),
                url: form.getAttribute('action'),
                data: $(form).serialize(),
                success: function (data) {
                    swal(
                        '<?= $language->success ?>!',
                        '<?= $language->user_edited_successfully ?>.',
                        'success'
                    );
                    $('#users').bootstrapTable('refresh');
                },
                error: function (data) {
                    swal(
                        '<?= $language->error ?>!',
                        data.message,
                        'success'
                    );
                }
            });
        }
        $(function () {
            $('.search input').attr('placeholder','<?=$language->search ?>');
        })
    </script>
<?php include_once ('footer.php') ?>
