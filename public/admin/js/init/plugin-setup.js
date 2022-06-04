$(document).ready(function () {
  if ($('.select2').length) {
    $('.select2').select2({
      // placeholder: '---Chọn---',
      // allowClear: true
    });
  }

  if ($('.dateptimeicker').length) {
    $('.dateptimeicker').datetimepicker({ format:'d/m/Y', timepicker:false})
  }

  if ($('#date_timepicker_start').length) {
    $('#date_timepicker_start').datetimepicker({
      format:'d/m/Y',
      onShow:function( ct ){
        let maxDate = jQuery('#date_timepicker_end').val();
        maxDate = maxDate.split('/');
        this.setOptions({
          maxDate: maxDate.length > 1 ? new Date(`${maxDate[2]}-${maxDate[1]} ${maxDate[0]}`) : false
        })
      },
      timepicker:false
     });

    $('#date_timepicker_end').datetimepicker({
      format:'d/m/Y',
      onShow:function( ct ){
        let minDate = jQuery('#date_timepicker_start').val();
        minDate = minDate.split('/');
        this.setOptions({
          minDate: minDate.length > 1 ? new Date(`${minDate[2]}-${minDate[1]} ${minDate[0]}`) : false
        })
      },
      timepicker:false
    });
  }

  if ($('#date_timepicker_start_discount').length) {
    $('#date_timepicker_start_discount').datetimepicker({
      format:'d/m/Y H:i',
      onShow:function( ct ){
       this.setOptions({
        maxDate:jQuery('#date_timepicker_end_discount').val()?jQuery('#date_timepicker_end_discount').val():false
       })
      },
      timepicker:true
     });

    $('#date_timepicker_end_discount').datetimepicker({
      format:'d/m/Y H:i',
      onShow:function( ct ){
        this.setOptions({
        minDate:jQuery('#date_timepicker_start_discount').val()?jQuery('#date_timepicker_start_discount').val():false
        })
      },
      timepicker:true
    });
  }
});
