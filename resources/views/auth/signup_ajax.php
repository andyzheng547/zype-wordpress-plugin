<div id="zype-modal-signup" class='zype-form'>
  <div class="content-wrap signup-wrap user-action-wrap zype-form-center">
    <div class="main-heading inner-heading">
      <h1 class="title zype-title">Create my login</h1>
    </div>
    <div class="user-wrap">
      <div class="holder-main">
        <div class="row">
          <div class="">
            <form action="<?php echo admin_url('admin-ajax.php') ?>" class="user-form nice-form" id="zype_signup_form_ajax" method="post">
              <input type="hidden" name="action" value="zype_sign_up_ajax">
              <div class="error-section"><?php echo $zype_message; ?></div>
              <div class="field-section">
                <div class="zype_flash_messages"></div>
                <div class="form-group required-row zype-input-wrap">
                  <input placeholder="Name" type="text" class="required zype-input-text" id="first-name" name="name" <?php if(isset($zype_signup_name)){?> value=<?php echo $zype_signup_name; ?><?php } ?>>
                </div>
                <div class="form-group required-row zype-input-wrap">
                  <input placeholder="Email" type="email" class="required-email zype-input-text" id="email-signup" name="email" <?php if(isset($zype_signup_email)){?> value=<?php echo $zype_signup_email; ?><?php } ?>>
                </div>
                <div class="form-group required-row zype-input-wrap">
                  <input placeholder="Password" type="password" class="required zype-input-text" id="password-signup" name="password">
                </div>
                <?php if (isset($terms_link) && $terms_link): ?>
                  <div class="signup-note">By clicking Create My Login, you agree to our <a href="<?php echo esc_url($terms_link) ?>" target="_blank">Terms of Service</a></div>
                <?php endif; ?>
                <button type="submit" class="zype-button">Create my login</button>
                <p class="to-sign-in">
                  Already have an account?
                  <a href="<?php echo get_permalink() . "?zype_auth_type=login" ?>" class="zype_auth_markup" data-type="login" data-id="0" data-root-parent-id="<?php echo $root_parent; ?>">
                    Sign In
                  </a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  (function($) {
    $(document).ready(function() {
      var rootParentId = "#<?php echo $root_parent ?>";
      var zypeAjaxFormPath = [rootParentId, "#zype_signup_form_ajax"].join(' ');;
      var zypeSubmitButtonFormPath = [zypeAjaxFormPath, 'button.zype-button[type="submit"]'].join(' ');
      var zypeErrorSectionFormPath = [zypeAjaxFormPath, '.error-section'].join(' ');
      var zypeSpinnerFormPath = [zypeAjaxFormPath, '.zype-spinner'].join(' ');

      var zypeAjaxForm = $(zypeAjaxFormPath);

      zypeAjaxForm.ajaxForm({
        beforeSubmit: function() {
          $(zypeSubmitButtonFormPath).append('<i class="zype-spinner"></i>');
          $(zypeErrorSectionFormPath).html("");
        },
        success: function(data) {
          $(zypeSpinnerFormPath).remove();
          data = $.parseJSON(data);
          if (data.status == true) {
              var planDiv = $(".subscribe-button-content #plans")
              if (planDiv.length > 0) {
                planDiv.show();
                $('.zype-form').hide();
              }
          } else {
              $(zypeSubmitButtonFormPath).prop('disabled', false);
              if (data.errors) {
                  $(zypeErrorSectionFormPath).html(data.errors.join(","));
              } else {
                  $(zypeErrorSectionFormPath).html('Something went wrong...');
              }
          }
        }
      });
   });
  })(jQuery);
</script>
