{* profile_form.tpl 管理员编辑界面 *}
{$cfg = [
	title          => $lang.page.profile,
	baigoValidator => "true",
	baigoSubmit    => "true",
	str_url        => "{$smarty.const.BG_URL_ADMIN}ctl.php?mod=profile&act_get=info"
]}

{include "include/admin_head.tpl" cfg=$cfg}

	<li><a href="{$smarty.const.BG_URL_ADMIN}ctl.php?mod=profile&act_get=info">{$lang.page.profile}</a></li>
	<li>{$lang.page.pass}</li>

	{include "include/admin_left.tpl" cfg=$cfg}

	<form name="profile_form" id="profile_form" autocomplete="off">

		<input type="hidden" name="token_session" value="{$common.token_session}">
		<input type="hidden" name="act_post" value="pass">

		<div class="row">
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<label class="control-label">{$lang.label.username}</label>
							<input type="text" name="admin_name" id="admin_name" value="{$tplData.adminLogged.admin_name}" readonly class="form-control">
						</div>

						<div class="form-group">
							<div id="group_admin_pass">
								<label class="control-label">{$lang.label.passOld}<span id="msg_admin_pass">*</span></label>
								<input type="password" name="admin_pass" id="admin_pass" class="validate form-control">
							</div>
						</div>

						<div class="form-group">
							<div id="group_admin_pass_new">
								<label class="control-label">{$lang.label.passNew}<span id="msg_admin_pass_new">*</span></label>
								<input type="password" name="admin_pass_new" id="admin_pass_new" class="validate form-control">
							</div>
						</div>

						<div class="form-group">
							<div id="group_admin_pass_confirm">
								<label class="control-label">{$lang.label.passConfirm}<span id="msg_admin_pass_confirm">*</span></label>
								<input type="password" name="admin_pass_confirm" id="admin_pass_confirm" class="validate form-control">
							</div>
						</div>

						<div class="form-group">
							<button type="button" id="go_form" class="btn btn-primary">{$lang.btn.save}</button>
						</div>
					</div>
				</div>
			</div>

			{include "include/profile_left.tpl" cfg=$cfg}
		</div>
	</form>

{include "include/admin_foot.tpl" cfg=$cfg}

	<script type="text/javascript">
	var opts_validator_form = {
		admin_pass: {
			length: { min: 1, max: 0 },
			validate: { type: "str", format: "text", group: "group_admin_pass" },
			msg: { id: "msg_admin_pass", too_short: "{$alert.x020205}" }
		},
		admin_pass_new: {
			length: { min: 1, max: 0 },
			validate: { type: "str", format: "text", group: "group_admin_pass_new" },
			msg: { id: "msg_admin_pass_new", too_short: "{$alert.x020213}" }
		},
		admin_pass_confirm: {
			length: { min: 1, max: 0 },
			validate: { type: "confirm", target: "admin_pass_new", group: "group_admin_pass_confirm" },
			msg: { id: "msg_admin_pass_confirm", too_short: "{$alert.x020211}", not_match: "{$alert.x020211}" }
		}
	};
	var opts_submit_form = {
		ajax_url: "{$smarty.const.BG_URL_ADMIN}ajax.php?mod=profile",
		btn_text: "{$lang.btn.ok}",
		btn_close: "{$lang.btn.close}",
		btn_url: "{$cfg.str_url}"
	};

	$(document).ready(function(){
		var obj_validator_form = $("#profile_form").baigoValidator(opts_validator_form);
		var obj_submit_form = $("#profile_form").baigoSubmit(opts_submit_form);
		$("#go_form").click(function(){
			if (obj_validator_form.validateSubmit()) {
				obj_submit_form.formSubmit();
			}
		});
	})
	</script>

{include "include/html_foot.tpl" cfg=$cfg}
