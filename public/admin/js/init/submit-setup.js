$(document).ready(function () {
  $('form').on('submit',function() {
    admin.showLoader();
    let btnSubmit = $(this).find('[type="submit"]');
        btnSubmit.attr('disabled', true)
                 .html('<i class="fa fa-spinner fa-pulse fa-fw"></i> ' + btnSubmit.text());
  });
})
