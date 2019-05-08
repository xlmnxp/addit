<?php
    $page = 'users';
    include_once ('header.php');
    global $default, $language, $template;
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
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
					<table id="users" class="table table-striped" data-toggle="table" data-url="tables/users.php"
                           data-show-refresh="true" data-show-toggle="true" data-show-columns="false"
                           data-search="true" data-select-item-name="toolbar1" data-pagination="true"
                           data-sort-name="id" data-sort-order="desc" data-side-pagination="server" data-escape="true">
						<thead>
                            <tr>
                                <th data-field="id" data-sortable="true"></th>
                                <th data-field="avatar" data-formatter="imageRow"></th>
                                <th data-formatter="flags"><b><?= $language->country ?></b>&nbsp;</th>
                                <th data-field="username"  data-sortable="true"><b><?= $language->username ?></b>&nbsp;</th>
                                <th data-field="fullname" data-sortable="true"><b><?= $language->fullname ?></b>&nbsp;</th>
                                <th data-field="message" data-sortable="true"><b><?= $language->message ?></b>&nbsp;</th>
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
        var countries = JSON.parse('<?= json_encode(getCountries(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?>'.replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t"));
        var categories = JSON.parse('<?= getCategories() ?>'.replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t"));

        function imageRow(value,row,index) {
            var image = row.avatar.indexOf('http') > -1 ? row.avatar : '<?= $default['url']; ?>' + row.avatar;
            return '<center><img height="50" width="50" src="'+image+'"/></center>';
        }

        function editBtns(value,row,index) {
            return '<center><a class="btn btn-primary btn-block text-left" onclick="editUser(\''+ escape(JSON.stringify(row)) +'\')"><svg class="glyph stroked pencil" style="height: 20px; width: 20px;"><use xlink:href="#stroked-pencil"/></svg>&nbsp;<?= $language->edit ?></a><a class="btn btn-danger btn-block text-left" onclick="deleteUser(\''+row.id+'\')"><svg class="glyph stroked trash" style="height: 1.5em;width: 1.5em;margin:2px;"><use xlink:href="#stroked-trash"/></svg>&nbsp;<?= $language->delete ?></a></center>'
        }

        function flags(value,row,index) {
            var flag = row.country.toLowerCase();

            return '<center><img src="<?= $default['url']; ?>public/images/flags/'+ flag +'.png" width="30" height="20"/></center>'
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
                        $('button[name="refresh"]').click();
                    }else{
                        swal(
                            '<?= $language->error ?>!',
                            data.message,
                            'error'
                        );
                    }
                }, function (data) {
                    swal(
                        '<?= $language->error ?>!',
                        data.message,
                        'success'
                    );
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
                country: '<?= $language->country ?>',
                category: '<?= $language->category ?>',
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
                }else if(value[0] == 'country'){
                    form += '<select class="form-control" id="'+ value[0] +'" name="'+ value[0] +'">';
                    for (let index = 0; index < Object.keys(countries).length; index++) {
                        const country = countries[Object.keys(countries)[index]];
                        form += '<option value="'+Object.keys(countries)[index]+'" '+ (Object.keys(countries)[index] == value[1] ? 'selected' : '') +'>'+country+'</option>';
                    }
                    form += '</select>';
                }else if(value[0] == 'category'){
                    form += '<select class="form-control" id="'+ value[0] +'" name="'+ value[0] +'">';
                    for (let index = 0; index < categories.length; index++) {
                        const category = categories[index];
                        form += '<option value="'+category.id+'" '+ (category.id == value[1] ? 'selected' : '') +'>'+category.name+'</option>';
                    }
                    form += '</select>';
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
            form += '<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit"><svg class="glyph stroked pencil" style="height: 1.5em;width: 1.5em;margin:2px;"><use xlink:href="#stroked-pencil"/></svg>&nbsp;<?= $language->edit ?></button>';
            form += '</form>';

            swal({
                html: form,
                showCancelButton: true,
                cancelButtonText: '<?= $language->cancel ?>',
                showConfirmButton: false
            });
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
                    $('button[name="refresh"]').click();
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
            var isMobile = (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) { return true } else {return false} })(navigator.userAgent||navigator.vendor||window.opera);
            if(isMobile){
                $('button[title="Toggle"]').click();
            }
        });
    </script>
<?php include_once ('footer.php') ?>
